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
    'email' => [
        'title' => '更新电子邮箱地址',
        'updated' => '电子邮箱地址已更新.',
    ],
    'password' => [
        'title' => '更改账户密码',
        'requirements' => '新密码至少 8 字符.',
        'updated' => '账户密码已更新.',
    ],
    'two_factor' => [
        'button' => '配置动态口令认证',
        'disabled' => '动态口令认证已关闭，阁下登录时再也不需要输入动态口令了.',
        'enabled' => '动态口令认证已启用，阁下每次登录都需要输入一次由您的令牌设备生成的随机动态口令以进行登录.',
        'invalid' => '此动态口令无效.',
        'setup' => [
            'title' => '设置动态口令认证',
            'help' => '无法扫描二维码？在您的 TOTP 应用上输入以下指令:',
            'field' => '输入动态口令',
        ],
        'disable' => [
            'title' => '关闭动态口令认证',
            'field' => '输入动态口令',
        ],
    ],
];
