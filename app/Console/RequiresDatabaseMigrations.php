<?php

namespace Pterodactyl\Console;

/**
 * @mixin \Illuminate\Console\Command
 */
trait RequiresDatabaseMigrations
{
    /**
     * Checks if the migrations have finished running by comparing the last migration file.
     */
    protected function hasCompletedMigrations(): bool
    {
        /** @var \Illuminate\Database\Migrations\Migrator $migrator */
        $migrator = $this->getLaravel()->make('migrator');

        $files = $migrator->getMigrationFiles(database_path('migrations'));

        if (!$migrator->repositoryExists()) {
            return false;
        }

        if (array_diff(array_keys($files), $migrator->getRepository()->getRan())) {
            return false;
        }

        return true;
    }

    /**
     * Throw a massive error into the console to hopefully catch the users attention and get
     * them to properly run the migrations rather than ignoring all of the other previous
     * errors...
     */
    protected function showMigrationWarning()
    {
        $this->getOutput()->writeln('<options=bold>
| @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ |
|                                                                              |
|                               您的数据库尚未正确迁移!                          |
|                                                                              |
| @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ |</>

您必须运行以下命令才能完成数据库迁移:

  <fg=green;options=bold>php artisan migrate --step --force</>

如果不修复您的问题，您将无法按预期使用翼龙面板
数据库状态通过运行上面的命令.
');

        $this->getOutput()->error('在继续之前，您必须更正上述错误.');
    }
}
