<?php

namespace Pterodactyl\Console\Commands;

use Closure;
use Illuminate\Console\Command;
use Pterodactyl\Console\Kernel;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Helper\ProgressBar;

class UpgradeCommand extends Command
{
    protected const DEFAULT_URL = 'https://github.com/pterodactyl/panel/releases/%s/panel.tar.gz';

    /** @var string */
    protected $signature = 'p:upgrade
        {--user= : 运行 PHP 的用户。所有文件将由该用户拥有.}
        {--group= : PHP 在其下运行的组。所有文件都将归该组所有.}
        {--url= : 要下载的特定存档.}
        {--release= : 从 GitHub 下载特定的翼手龙版本。留空以使用最新版本.}
        {--skip-download : 如果设置没有存档将被下载.}';

    /** @var string */
    protected $description = '从 GitHub 下载 Pterodactyl 的新存档，然后执行正常的升级命令.';

    /**
     * Executes an upgrade command which will run through all of our standard
     * commands for Pterodactyl and enable users to basically just download
     * the archive and execute this and be done.
     *
     * This places the application in maintenance mode as well while the commands
     * are being executed.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $skipDownload = $this->option('skip-download');
        if (!$skipDownload) {
            $this->output->warning('此命令不验证下载资产的完整性。请确保您信任下载源，然后再继续。如果您不希望下载存档，请使用 --skip-download 标志指明，或对以下问题回答“否”.');
            $this->output->comment('Download Source (set with --url=):');
            $this->line($this->getUrl());
        }

        if (version_compare(PHP_VERSION, '7.4.0') < 0) {
            $this->error('无法执行自升级过程。所需的最低 PHP 版本是 7.4.0，您有 [' . PHP_VERSION . '].');
        }

        $user = 'www-data';
        $group = 'www-data';
        if ($this->input->isInteractive()) {
            if (!$skipDownload) {
                $skipDownload = !$this->confirm('您想下载并解压最新版本的存档文件吗?', true);
            }

            if (is_null($this->option('user'))) {
                $userDetails = posix_getpwuid(fileowner('public'));
                $user = $userDetails['name'] ?? 'www-data';

                if (!$this->confirm("您的网络服务器用户已被检测为 <fg=blue>[{$user}]:</> 这个对吗", true)) {
                    $user = $this->anticipate(
                        '请输入运行您的网络服务器进程的用户名。这因系统而异，但通常是“www-data”、“nginx”或“apache”.',
                        [
                            'www-data',
                            'nginx',
                            'apache',
                        ]
                    );
                }
            }

            if (is_null($this->option('group'))) {
                $groupDetails = posix_getgrgid(filegroup('public'));
                $group = $groupDetails['name'] ?? 'www-data';

                if (!$this->confirm("您的网络服务器组已被检测为 <fg=blue>[{$group}]:</> 这个对吗", true)) {
                    $group = $this->anticipate(
                        '请输入运行您的网络服务器进程的组的名称。通常这与您的用户相同.',
                        [
                            'www-data',
                            'nginx',
                            'apache',
                        ]
                    );
                }
            }

            if (!$this->confirm('您确定要为您的面板运行升级过程吗？')) {
                $this->warn('升级过程被用户终止.');

                return;
            }
        }

        ini_set('output_buffering', 0);
        $bar = $this->output->createProgressBar($skipDownload ? 9 : 10);
        $bar->start();

        if (!$skipDownload) {
            $this->withProgress($bar, function () {
                $this->line("\$upgrader> curl -L \"{$this->getUrl()}\" | tar -xzv");
                $process = Process::fromShellCommandline("curl -L \"{$this->getUrl()}\" | tar -xzv");
                $process->run(function ($type, $buffer) {
                    $this->{$type === Process::ERR ? 'error' : 'line'}($buffer);
                });
            });
        }

        $this->withProgress($bar, function () {
            $this->line('$upgrader> php artisan down');
            $this->call('down');
        });

        $this->withProgress($bar, function () {
            $this->line('$upgrader> chmod -R 755 storage bootstrap/cache');
            $process = new Process(['chmod', '-R', '755', 'storage', 'bootstrap/cache']);
            $process->run(function ($type, $buffer) {
                $this->{$type === Process::ERR ? 'error' : 'line'}($buffer);
            });
        });

        $this->withProgress($bar, function () {
            $command = ['composer', 'install', '--no-ansi'];
            if (config('app.env') === 'production' && !config('app.debug')) {
                $command[] = '--optimize-autoloader';
                $command[] = '--no-dev';
            }

            $this->line('$upgrader> ' . implode(' ', $command));
            $process = new Process($command);
            $process->setTimeout(10 * 60);
            $process->run(function ($type, $buffer) {
                $this->line($buffer);
            });
        });

        /** @var \Illuminate\Foundation\Application $app */
        $app = require __DIR__ . '/../../../bootstrap/app.php';
        /** @var \Pterodactyl\Console\Kernel $kernel */
        $kernel = $app->make(Kernel::class);
        $kernel->bootstrap();
        $this->setLaravel($app);

        $this->withProgress($bar, function () {
            $this->line('$upgrader> php artisan view:clear');
            $this->call('view:clear');
        });

        $this->withProgress($bar, function () {
            $this->line('$upgrader> php artisan config:clear');
            $this->call('config:clear');
        });

        $this->withProgress($bar, function () {
            $this->line('$upgrader> php artisan migrate --force --seed');
            $this->call('migrate', ['--force' => true, '--seed' => true]);
        });

        $this->withProgress($bar, function () use ($user, $group) {
            $this->line("\$upgrader> chown -R {$user}:{$group} *");
            $process = Process::fromShellCommandline("chown -R {$user}:{$group} *", $this->getLaravel()->basePath());
            $process->setTimeout(10 * 60);
            $process->run(function ($type, $buffer) {
                $this->{$type === Process::ERR ? 'error' : 'line'}($buffer);
            });
        });

        $this->withProgress($bar, function () {
            $this->line('$upgrader> php artisan queue:restart');
            $this->call('queue:restart');
        });

        $this->withProgress($bar, function () {
            $this->line('$upgrader> php artisan up');
            $this->call('up');
        });

        $this->newLine(2);
        $this->info('面板已成功升级。请确保您还更新了任何后端实例: https://pterodactyl.io/wings/1.0/upgrading.html');
    }

    protected function withProgress(ProgressBar $bar, Closure $callback)
    {
        $bar->clear();
        $callback();
        $bar->advance();
        $bar->display();
    }

    protected function getUrl(): string
    {
        if ($this->option('url')) {
            return $this->option('url');
        }

        return sprintf(self::DEFAULT_URL, $this->option('release') ? 'download/v' . $this->option('release') : 'latest/download');
    }
}
