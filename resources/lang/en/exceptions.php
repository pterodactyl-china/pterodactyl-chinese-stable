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
    'daemon_connection_failed' => '与后端节点服务器通信错误，信息: HTTP/:code . 此错误已被记录.',
    'node' => [
        'servers_attached' => '此节点服务器下有服务器实例，无法继续进行删除操作.',
        'daemon_off_config_updated' => '节点服务器配置 <strong>已更新</strong>, 但与节点服务器通讯失败无法自动同步更改. 你需要手动更改后端服务器 Wings 程序配置 (config.yml) 以应用此更改.',
    ],
    'allocations' => [
        'server_using' => '此服务器实例正在使用此网络分配，故此网络分配无法被删除.',
        'too_many_ports' => '不支持一次在单个范围内添加超过 1000 个端口.',
        'invalid_mapping' => '为 :port 提供的映射无效，无法处理.',
        'cidr_out_of_range' => 'CIDR 子网掩码只允许 /25 和 /32 之间的掩码.',
        'port_out_of_range' => '分配的端口必须在 1024 - 65535 之间.',
    ],
    'nest' => [
        'delete_has_servers' => '无法删除与服务器实例关联的预设组.',
        'egg' => [
            'delete_has_servers' => '无法删除与服务器关联的预设.',
            'invalid_copy_id' => '选择用于复制脚本的预设不存在，或者正在复制其本身.',
            'must_be_child' => '此预设的“复制设置于”指令必须是所选预设组的子选项.',
            'has_children' => '这个预设是一个或多个其他预设的父预设。 请在删除此预设之前删除这些子预设.',
        ],
        'variables' => [
            'env_not_unique' => '环境变量 :name 不可与其他环境变量同名.',
            'reserved_name' => '环境变量 :name 受保护，不能分配给变量.',
            'bad_validation_rule' => '输入验证规则 ":rule" 无效.',
        ],
        'importer' => [
            'json_error' => '尝试解析 JSON 文件时出错: :error.',
            'file_error' => '提供的 JSON 文件无效.',
            'invalid_json_provided' => '提供的 JSON 文件不是可以识别的格式.',
        ],
    ],
    'subusers' => [
        'editing_self' => '不允许编辑您自己的子用户帐户.',
        'user_is_owner' => '您不能将服务器所有者添加为此服务器的子用户.',
        'subuser_exists' => '具有该电子邮件地址的用户已被分配为此服务器的子用户.',
    ],
    'databases' => [
        'delete_has_databases' => '无法删除链接了活动数据库的数据库主机服务器.',
    ],
    'tasks' => [
        'chain_interval_too_long' => '链式任务的最大间隔时间为 15 分钟.',
    ],
    'locations' => [
        'has_nodes' => '此节点服务器组下有节点服务器，无法继续进行删除操作.',
    ],
    'users' => [
        'node_revocation_failed' => '重置节点服务器超级密钥失败 <a href=":link">节点服务器 #:node</a>. :error',
    ],
    'deployment' => [
        'no_viable_nodes' => '找不到满足自动部署要求的节点服务器.',
        'no_viable_allocations' => '未找到满足自动部署要求的网络分配.',
    ],
    'api' => [
        'resource_not_found' => '此服务器上不存在请求的资源.',
    ],
];
