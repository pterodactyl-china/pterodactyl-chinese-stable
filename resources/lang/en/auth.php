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
    'sign_in' => '登入以继续',
    'go_to_login' => '返回登入',
    'failed' => '账号或密码错误，登入失败.',

    'forgot_password' => [
        'label' => '忘记密码?',
        'label_help' => '输入阁下的电子邮箱地址以接受关于重置账户密码的电子邮件.',
        'button' => '重置密码',
    ],

    'reset_password' => [
        'button' => '重置并登入',
    ],

    'two_factor' => [
        'label' => '动态口令',
        'label_help' => '此账户已启用动态口令认证，请输入由阁下的 TOTP 动态口令软件生成的动态口令以继续.',
        'checkpoint_failed' => '此动态口令无效.',
    ],

    'throttle' => '您的 IP 有暴力破解嫌疑，请在 :seconds 秒后再尝试登入.',
    'password_requirements' => '密码至少为 8 为字符长度.',
    '2fa_must_be_enabled' => '阁下需要为你的账户启用动态口令认证以继续进行使用.',
];
