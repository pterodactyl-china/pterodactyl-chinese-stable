<?php

namespace Pterodactyl\Console\Commands\Node;

use Pterodactyl\Models\Node;
use Illuminate\Console\Command;

class NodeConfigurationCommand extends Command
{
    protected $signature = 'p:node:configuration
                            {node : The ID or UUID of the node to return the configuration for.}
                            {--format=yaml : The output format. Options are "yaml" and "json".}';

    protected $description = '显示指定节点的配置.';

    public function handle()
    {
        $column = ctype_digit((string) $this->argument('node')) ? 'id' : 'uuid';

        /** @var \Pterodactyl\Models\Node $node */
        $node = Node::query()->where($column, $this->argument('node'))->firstOr(function () {
            $this->error('所选节点不存在.');

            exit(1);
        });

        $format = $this->option('format');
        if (!in_array($format, ['yaml', 'yml', 'json'])) {
            $this->error('指定的格式无效。有效选项是“yaml”和“json”.');

            exit(1);
        }

        if ($format === 'json') {
            $this->output->write($node->getJsonConfiguration(true));
        } else {
            $this->output->write($node->getYamlConfiguration());
        }

        $this->output->newLine();

        return 0;
    }
}
