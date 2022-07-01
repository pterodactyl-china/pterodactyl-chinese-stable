<?php

namespace Pterodactyl\Console\Commands\Maintenance;

use Carbon\CarbonImmutable;
use InvalidArgumentException;
use Illuminate\Console\Command;
use Pterodactyl\Repositories\Eloquent\BackupRepository;

class PruneOrphanedBackupsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'p:maintenance:prune-backups {--prune-age=}';

    /**
     * @var string
     */
    protected $description = '将最近“n”分钟内未完成的所有备份标记为失败.';

    public function handle(BackupRepository $repository)
    {
        $since = $this->option('prune-age') ?? config('backups.prune_age', 360);
        if (!$since || !is_digit($since)) {
            throw new InvalidArgumentException('The "--prune-age" 参数必须是大于 0 的值.');
        }

        $query = $repository->getBuilder()
            ->whereNull('completed_at')
            ->where('created_at', '<=', CarbonImmutable::now()->subMinutes($since)->toDateTimeString());

        $count = $query->count();
        if (!$count) {
            $this->info('没有孤立的备份被标记为失败.');

            return;
        }

        $this->warn("Marking {$count} 上次未标记为已完成的备份 {$since} 失败的分钟数.");

        $query->update([
            'is_successful' => false,
            'completed_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);
    }
}
