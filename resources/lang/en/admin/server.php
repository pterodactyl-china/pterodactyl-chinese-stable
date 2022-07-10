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
    'exceptions' => [
        'no_new_default_allocation' => '您正在尝试删除此服务器的默认网络分配，但此服务器实例仅此一个网络分配.',
        'marked_as_failed' => '此服务器实例在上次安装过程中安装失败，无法切换到此状态.',
        'bad_variable' => '变量 :name 验证错误.',
        'daemon_exception' => '与后端节点服务器通信错误，信息: HTTP/:code . 此错误已被记录. (request id: :request_id)',
        'default_allocation_not_found' => '请求的默认网络分配未在目标服务器实例可用网络分配中找到.',
    ],
    'alerts' => [
        'startup_changed' => '服务器实例启动配置已成功更新，若其关联的预设组或预设也被更改，那么服务器目前可能在重新安装状态.',
        'server_deleted' => '服务器实例已成功删除.',
        'server_created' => '服务器实例创建成功，请等待后端节点服务器片刻以进行服务器实例安装程序.',
        'build_updated' => '服务器实例构建信息已成功更新，一些更改可能需要服务器实例重新启动才会被应用.',
        'suspension_toggled' => '服务器冻结状态已更新为 :status.',
        'rebuild_on_boot' => '服务器实例状态已被更新为需要 Docker 容器重建，此操作将在服务器下次重启时进行.',
        'install_toggled' => '服务器实例安装状态已更改.',
        'server_reinstalled' => '服务器实例已进入重新安装队列.',
        'details_updated' => '服务器实例详细信息已更新.',
        'docker_image_updated' => '已成功设置服务器实例默认使用 Docker 镜像，这将在服务器下次重启时生效.',
        'node_required' => '创建服务器实例必须为其分配节点服务器.',
        'transfer_nodes_required' => '转移服务器实例必须有至少两个后端节点服务器.',
        'transfer_started' => '服务器实例转移已开始处理.',
        'transfer_not_viable' => '所选节点服务器可用存储空间不足，无法进行转移操作.',
    ],
];
