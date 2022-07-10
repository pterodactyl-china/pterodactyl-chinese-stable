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
    'permissions' => [
        'websocket_*' => '允许用户访问服务器实例的 Websocket.',
        'control_console' => '允许用户向服务器实例控制台传入指令.',
        'control_start' => '允许用户启动服务器实例.',
        'control_stop' => '允许用户停止服务器实例.',
        'control_restart' => '允许用户重启服务器实例.',
        'control_kill' => '允许用户强制停止服务器实例.',
        'user_create' => '允许用户为服务器实例创建新子用户.',
        'user_read' => '允许用户查看其他与此服务器实例关联的用户.',
        'user_update' => '允许用户编辑其他与此服务器实例关联的用户.',
        'user_delete' => '允许用户删除其他与此服务器实例关联的用户.',
        'file_create' => '允许用户创建新文件和新路径.',
        'file_read' => '允许用户查看服务器实例的文件及其内容.',
        'file_update' => '允许用户更新服务器实例的文件.',
        'file_delete' => '允许用户删除服务器实例的文件或路径.',
        'file_archive' => '允许用户压缩文件和解压压缩文件.',
        'file_sftp' => '允许用户使用 SFTP 执行以上所有操作.',
        'allocation_read' => '允许用户查看服务器实例网络分配设置.',
        'allocation_update' => '允许用户编辑服务器实例网络分配设置.',
        'database_create' => '允许用户为服务器实例创建新数据库.',
        'database_read' => '允许用户查看服务器实例下的数据库.',
        'database_update' => '允许用户编辑服务器实例下的数据库. 如果用户没有 "View Password" 权限则此用户无法更改其密码.',
        'database_delete' => '允许用户删除服务器实例下的数据库.',
        'database_view_password' => '允许用户查看服务器实例下的数据库密码.',
        'schedule_create' => '允许用户为服务器实例创建新的计划任务.',
        'schedule_read' => '允许用户查看服务器实例下的计划任务.',
        'schedule_update' => '允许用户编辑服务器实例下的计划任务.',
        'schedule_delete' => '允许用户删除服务器实例下的计划任务.',
    ],
];
