<?php
/**
 * Pterodactyl CHINA - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 * Simplified Chinese Translation Copyright (c) 2021 - 2022 Ice Ling <iceling@ilwork.cn>
 *
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */

return [
    'validation' => [
        'fqdn_not_resolvable' => '提供的域名或 IP 无法解析( Unknown Hostname Error ).',
        'fqdn_required_for_ssl' => '启用 SSL 连接需要填写目标节点服务器域名.',
    ],
    'notices' => [
        'allocations_added' => '已为此节点服务器新建网络分配.',
        'node_deleted' => '成功删除此节点服务器.',
        'location_required' => '新建新节点服务器前请新建节点服务器组.',
        'node_created' => '已成功创建节点服务器. 你可点击 \'守护进程设置\' 标签页来取得并运行自动部署命令. <strong>创建新服务器实例前请至少为节点服务器新建一个网络分配.</strong>',
        'node_updated' => '节点服务器信息已更新. 如果更改了任何节点服务器守护程序设置，您需要重新启动 Wings 程序才能使这些更改生效.',
        'unallocated_deleted' => '删除 <code>:ip</code> 下所有未分配的端口.',
    ],
];
