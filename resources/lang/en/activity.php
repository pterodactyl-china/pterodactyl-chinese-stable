<?php
 /**
 * Pterodactyl CHINA - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 * Simplified Chinese Translation Copyright (c) 2021 - 2022 Ice Ling <iceling@ilwork.cn>
 *
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */
 
/**
 * Contains all of the translation strings for different activity log
 * events. These should be keyed by the value in front of the colon (:)
 * in the event name. If there is no colon present, they should live at
 * the top level.
 */

return [
    'auth' => [
        'fail' => '登入失败',
        'success' => '成功登入',
        'password-reset' => '重置密码',
        'reset-password' => '请求重置密码',
        'checkpoint' => '被要求输入动态口令',
        'recovery-token' => '使用了动态口令恢复代码',
        'token' => '正确输入了动态口令',
        'ip-blocked' => '来自 IP 地址的请求被阻止于 :identifier',
    ],
    'user' => [
        'account' => [
            'email-changed' => '电子邮件地址已从 :old 更改为 :new',
            'password-changed' => '更改密码',
        ],
        'api-key' => [
            'create' => '创建新 API 密钥 :identifier',
            'delete' => '删除 API 密钥 :identifier',
        ],
        'ssh-key' => [
            'create' => '添加 SSH 私钥 :fingerprint to account',
            'delete' => '删除 SSH 私钥 :fingerprint from account',
        ],
        'two-factor' => [
            'create' => '启用动态口令认证',
            'delete' => '停用动态口令认证',
        ],
    ],
    'server' => [
        'reinstall' => '重新安装服务器实例',
        'backup' => [
            'download' => '下载备份 :name ',
            'delete' => '删除备份 :name ',
            'restore' => '使用 :name 备份对服务器实例进行回档操作 (删除的文件: :truncate)',
            'restore-complete' => '使用 :name 备份成功对服务器实例回档',
            'restore-failed' => '使用 :name 备份回档失败',
            'start' => '开始新备份 :name',
            'complete' => '标记 :name 备份状态为完成',
            'fail' => '标记 :name 备份状态为失败',
            'lock' => '锁定备份 :name ',
            'unlock' => '解锁备份 :name ',
        ],
        'database' => [
            'create' => '创建数据库 :name',
            'rotate-password' => '为数据库 :name 重新生成密码',
            'delete' => '删除数据库 :name',
        ],
        'file' => [
            'compress_one' => '压缩 :directory:file',
            'compress_other' => '压缩了 :count 个文件于 :directory',
            'read' => '查看了 :file 文件内容',
            'copy' => '创建了 :file 的副本',
            'create-directory' => '于 :directory 创建新目录 :name ',
            'decompress' => '解压 :files 于 :directory',
            'delete_one' => '删除了 :directory:files.0',
            'delete_other' => '删除了 :count 个文件于 :directory',
            'download' => '下载了文件 :file',
            'pull' => '从 :url 下载了文件至 :directory',
            'rename_one' => '重命名了 :directory:files.0.from 其新文件名为 :directory:files.0.to',
            'rename_other' => '重命名了 :count 个文件于 :directory',
            'write' => '为 :file 写入了新内容',
            'upload' => '开始上传文件',
        ],
        'allocation' => [
            'create' => '添加网络分配 :allocation 至服务器实例',
            'notes' => '更新了网络分配 :allocation 备注 ":old" 至 ":new"',
            'primary' => '设置网络分配 :allocation 为服务器实例首选网络',
            'delete' => '删除网络分配 :allocation ',
        ],
        'schedule' => [
            'create' => '创建名称为 :name 的计划任务',
            'update' => '更新了名称为 :name 的计划任务',
            'execute' => '手动运行了名称为 :name 的计划任务',
            'delete' => '删除了名称为 :name 的计划任务',
        ],
        'task' => [
            'create' => '创建了新 ":action" 任务于计划 :name ',
            'update' => '编辑了 ":action" 任务于计划 :name ',
            'delete' => '为 :name 计划删除了一个任务',
        ],
        'settings' => [
            'rename' => '重命名服务器实例名称 :old 至 :new',
        ],
        'startup' => [
            'edit' => '更改 :variable 变量从 ":old" 至 ":new"',
            'image' => '为服务器实例更改了使用的 Docker 镜像从 :old 至 :new',
        ],
        'subuser' => [
            'create' => '添加 :email 作为服务器实例的子用户',
            'update' => '更新了 :email 的子用户权限',
            'delete' => '删除 :email 作为服务器实例的子用户',
        ],
    ],
];
