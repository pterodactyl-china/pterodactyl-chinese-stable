<?php

namespace Pterodactyl\Console\Commands\Environment;

use DateTimeZone;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel;
use Pterodactyl\Traits\Commands\EnvironmentWriterTrait;

class AppSettingsCommand extends Command
{
    use EnvironmentWriterTrait;

    public const CACHE_DRIVERS = [
        'redis' => 'Redis (recommended)',
        'memcached' => 'Memcached',
        'file' => 'Filesystem',
    ];

    public const SESSION_DRIVERS = [
        'redis' => 'Redis (recommended)',
        'memcached' => 'Memcached',
        'database' => 'MySQL Database',
        'file' => 'Filesystem',
        'cookie' => 'Cookie',
    ];

    public const QUEUE_DRIVERS = [
        'redis' => 'Redis (recommended)',
        'database' => 'MySQL Database',
        'sync' => 'Sync',
    ];

    /**
     * @var \Illuminate\Contracts\Console\Kernel
     */
    protected $command;

    /**
     * @var string
     */
    protected $description = '配置面板的基本环境设置.';

    /**
     * @var string
     */
    protected $signature = 'p:environment:setup
                            {--new-salt : Whether or not to generate a new salt for Hashids.}
                            {--author= : The email that services created on this instance should be linked to.}
                            {--url= : The URL that this Panel is running on.}
                            {--timezone= : The timezone to use for Panel times.}
                            {--cache= : The cache driver backend to use.}
                            {--session= : The session driver backend to use.}
                            {--queue= : The queue driver backend to use.}
                            {--redis-host= : Redis host to use for connections.}
                            {--redis-pass= : Password used to connect to redis.}
                            {--redis-port= : Port to connect to redis over.}
                            {--settings-ui= : Enable or disable the settings UI.}';

    /**
     * @var array
     */
    protected $variables = [];

    /**
     * AppSettingsCommand constructor.
     */
    public function __construct(Kernel $command)
    {
        parent::__construct();

        $this->command = $command;
    }

    /**
     * Handle command execution.
     *
     * @throws \Pterodactyl\Exceptions\PterodactylException
     */
    public function handle()
    {
        if (empty(config('hashids.salt')) || $this->option('new-salt')) {
            $this->variables['HASHIDS_SALT'] = str_random(20);
        }

        $this->output->comment('提供此面板导出的预设应来自的电子邮件地址。这应该是一个有效的电子邮件地址.');
        $this->variables['APP_SERVICE_AUTHOR'] = $this->option('author') ?? $this->ask(
            '预设作者电子邮件',
            config('pterodactyl.service.author', 'unknown@unknown.com')
        );

        if (!filter_var($this->variables['APP_SERVICE_AUTHOR'], FILTER_VALIDATE_EMAIL)) {
            $this->output->error('提供的服务作者电子邮件无效.');

            return 1;
        }

        $this->output->comment('应用程序URL必须以https://或 http://开头，具体取决于您是否使用SSL。如果您不包括该方案，您的电子邮件和其他内容将链接到错误的位置.');
        $this->variables['APP_URL'] = $this->option('url') ?? $this->ask(
            '应用程序URL',
            config('app.url', 'http://example.org')
        );

        $this->output->comment('时区应该匹配 PHP 支持的时区之一。如果您不确定，请参考 http://php.net/manual/en/timezones.php.');
        $this->variables['APP_TIMEZONE'] = $this->option('timezone') ?? $this->anticipate(
            '应用程序时区',
            DateTimeZone::listIdentifiers(DateTimeZone::ALL),
            config('app.timezone')
        );

        $selected = config('cache.default', 'redis');
        $this->variables['CACHE_DRIVER'] = $this->option('cache') ?? $this->choice(
            '缓存驱动程序',
            self::CACHE_DRIVERS,
            array_key_exists($selected, self::CACHE_DRIVERS) ? $selected : null
        );

        $selected = config('session.driver', 'redis');
        $this->variables['SESSION_DRIVER'] = $this->option('session') ?? $this->choice(
            '会话驱动程序',
            self::SESSION_DRIVERS,
            array_key_exists($selected, self::SESSION_DRIVERS) ? $selected : null
        );

        $selected = config('queue.default', 'redis');
        $this->variables['QUEUE_CONNECTION'] = $this->option('queue') ?? $this->choice(
            '队列驱动程序',
            self::QUEUE_DRIVERS,
            array_key_exists($selected, self::QUEUE_DRIVERS) ? $selected : null
        );

        if (!is_null($this->option('settings-ui'))) {
            $this->variables['APP_ENVIRONMENT_ONLY'] = $this->option('settings-ui') == 'true' ? 'false' : 'true';
        } else {
            $this->variables['APP_ENVIRONMENT_ONLY'] = $this->confirm('启用基于UI的设置编辑器?', true) ? 'false' : 'true';
        }

        // Make sure session cookies are set as "secure" when using HTTPS
        if (strpos($this->variables['APP_URL'], 'https://') === 0) {
            $this->variables['SESSION_SECURE_COOKIE'] = 'true';
        }

        $this->checkForRedis();
        $this->writeToEnvironment($this->variables);

        $this->info($this->command->output());
    }

    /**
     * Check if redis is selected, if so, request connection details and verify them.
     */
    private function checkForRedis()
    {
        $items = collect($this->variables)->filter(function ($item) {
            return $item === 'redis';
        });

        // Redis was not selected, no need to continue.
        if (count($items) === 0) {
            return;
        }

        $this->output->note('您已经为一个或多个选项选择了Redis驱动程序，请在下面提供有效的连接信息。在大多数情况下，您可以使用提供的默认值，除非您修改了设置.');
        $this->variables['REDIS_HOST'] = $this->option('redis-host') ?? $this->ask(
            'Redis主机',
            config('database.redis.default.host')
        );

        $askForRedisPassword = true;
        if (!empty(config('database.redis.default.password'))) {
            $this->variables['REDIS_PASSWORD'] = config('database.redis.default.password');
            $askForRedisPassword = $this->confirm('似乎已经为Redis定义了密码，是否要更改?');
        }

        if ($askForRedisPassword) {
            $this->output->comment('默认情况下，Redis服务器实例没有密码，因为它在本地运行，外部世界无法访问。如果是这种情况，只需按enter键而不输入值.');
            $this->variables['REDIS_PASSWORD'] = $this->option('redis-pass') ?? $this->output->askHidden(
                'Redis密码'
            );
        }

        if (empty($this->variables['REDIS_PASSWORD'])) {
            $this->variables['REDIS_PASSWORD'] = 'null';
        }

        $this->variables['REDIS_PORT'] = $this->option('redis-port') ?? $this->ask(
            'Redis端口',
            config('database.redis.default.port')
        );
    }
}
