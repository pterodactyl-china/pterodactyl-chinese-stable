<?php

/**
 * Pterodactyl - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 *
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */

namespace Pterodactyl\Console\Commands\Node;

use Illuminate\Console\Command;
use Pterodactyl\Services\Nodes\NodeCreationService;

class MakeNodeCommand extends Command
{
    /**
     * @var \Pterodactyl\Services\Nodes\NodeCreationService
     */
    protected $creationService;

    /**
     * @var string
     */
    protected $signature = 'p:node:make
                            {--name= : A name to identify the node.}
                            {--description= : A description to identify the node.}
                            {--locationId= : A valid locationId.}
                            {--fqdn= : The domain name (e.g node.example.com) to be used for connecting to the daemon. An IP address may only be used if you are not using SSL for this node.}
                            {--public= : Should the node be public or private? (public=1 / private=0).}
                            {--scheme= : Which scheme should be used? (Enable SSL=https / Disable SSL=http).}
                            {--proxy= : Is the daemon behind a proxy? (Yes=1 / No=0).}
                            {--maintenance= : Should maintenance mode be enabled? (Enable Maintenance mode=1 / Disable Maintenance mode=0).}
                            {--maxMemory= : Set the max memory amount.}
                            {--overallocateMemory= : Enter the amount of ram to overallocate (% or -1 to overallocate the maximum).}
                            {--maxDisk= : Set the max disk amount.}
                            {--overallocateDisk= : Enter the amount of disk to overallocate (% or -1 to overallocate the maximum).}
                            {--uploadSize= : Enter the maximum upload filesize.}
                            {--daemonListeningPort= : Enter the wings listening port.}
                            {--daemonSFTPPort= : Enter the wings SFTP listening port.}
                            {--daemonBase= : Enter the base folder.}';

    /**
     * @var string
     */
    protected $description = '通过 CLI 在系统上创建一个新节点.';

    /**
     * Handle the command execution process.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    public function handle(NodeCreationService $creationService)
    {
        $this->creationService = $creationService;

        $data['name'] = $this->option('name') ?? $this->ask('输入一个用于区分此节点与其他节点的简短标识符');
        $data['description'] = $this->option('description') ?? $this->ask('输入描述以标识节点');
        $data['location_id'] = $this->option('locationId') ?? $this->ask('输入一个有效的位置 ID');
        $data['fqdn'] = $this->option('fqdn') ?? $this->ask('输入一个用于连接到守护进程的域名(如 node.example.com )。只有在不对此节点使用 SSL 的情况下，才可以使用 IP 地址');
        if (!filter_var(gethostbyname($data['fqdn']), FILTER_VALIDATE_IP)) {
            $this->error('提供的域名 或 IP 地址不能解析为有效的 IP 地址.');

            return;
        }
        $data['public'] = $this->option('public') ?? $this->confirm('这个节点应该是公开的吗？请注意，将节点设置为私有您将拒绝自动部署到该节点的能力.', true);
        $data['scheme'] = $this->option('scheme') ?? $this->anticipate(
            '请为 SSL 输入 https 或为非 SSL 连接输入 http',
            ['https', 'http'],
            'https'
        );
        if (filter_var($data['fqdn'], FILTER_VALIDATE_IP) && $data['scheme'] === 'https') {
            $this->error('需要解析为公共 IP 地址的完全限定域名才能为此节点使用 SSL.');

            return;
        }
        $data['behind_proxy'] = $this->option('proxy') ?? $this->confirm('你的域名是代理服务器吗？');
        $data['maintenance_mode'] = $this->option('maintenance') ?? $this->confirm('是否应该启用维护模式？');
        $data['memory'] = $this->option('maxMemory') ?? $this->ask('输入最大内存量');
        $data['memory_overallocate'] = $this->option('overallocateMemory') ?? $this->ask('输入要超额分配的内存量，-1将禁用检查，0将阻止创建新服务器');
        $data['disk'] = $this->option('maxDisk') ?? $this->ask('输入磁盘空间的最大值');
        $data['disk_overallocate'] = $this->option('overallocateDisk') ?? $this->ask('输入要超额分配的内存量，-1将禁用检查，0将阻止创建新服务器');
        $data['upload_size'] = $this->option('uploadSize') ?? $this->ask('输入最大文件大小上传', '100');
        $data['daemonListen'] = $this->option('daemonListeningPort') ?? $this->ask('进入后端监听端口', '8080');
        $data['daemonSFTP'] = $this->option('daemonSFTPPort') ?? $this->ask('进入后端SFTP监听端口', '2022');
        $data['daemonBase'] = $this->option('daemonBase') ?? $this->ask('输入基本文件夹', '/var/lib/pterodactyl/volumes');

        $node = $this->creationService->handle($data);
        $this->line('成功地在位置上创建了一个新节点 ' . $data['location_id'] . ' 名字 ' . $data['name'] . ' 并且有一个 id ' . $node->id . '.');
    }
}
