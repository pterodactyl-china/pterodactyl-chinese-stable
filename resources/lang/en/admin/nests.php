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
    'notices' => [
        'created' => '新预设组, :name, 已被成功创建.',
        'deleted' => '成功删除目标预设组.',
        'updated' => '成功更新预设组配置文件.',
    ],
    'eggs' => [
        'notices' => [
            'imported' => '成功导入预设并更新其关联服务器启动命令变量.',
            'updated_via_import' => '此预设已使用上传的文件配置.',
            'deleted' => '成功删除目标预设.',
            'updated' => '预设配置已成功更新.',
            'script_updated' => '预设安装脚本已更新，其将在安装服务器时运行.',
            'egg_created' => '新预设已成功创建，你需要重启所有运行中的后端服务器以应用更改.',
        ],
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => '启动命令变量 ":variable" 已被删除，你需要对关联的服务器进行重建操作以同步更改.',
            'variable_updated' => '启动命令变量 ":variable" 已更新. 你需要对关联的服务器进行重建操作以同步更改.',
            'variable_created' => '新启动变量已成功创建并关联至预设.',
        ],
    ],
];
