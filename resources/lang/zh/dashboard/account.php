<?php

return [
    'email' => [
        'title' => '更新您的邮箱',
        'updated' => '您的邮箱地址已更新。',
    ],
    'password' => [
        'title' => '更改您的密码',
        'requirements' => '您的新密码长度应至少为 8 个字符。',
        'updated' => '您的密码已更新。',
    ],
    'two_factor' => [
        'button' => '配置双重验证',
        'disabled' => '您的帐户已禁用双重验证。 登录时将不再提示您提供令牌。',
        'enabled' => '您的帐户已启用双重验证！ 从现在开始，登录时，您将需要提供您设备上生成的令牌。',
        'invalid' => '提供的令牌无效。',
        'setup' => [
            'title' => '设置双重验证',
            'help' => '无法扫码？ 将以下代码输入到您的应用程序中：',
            'field' => '输入令牌',
        ],
        'disable' => [
            'title' => '禁用双重验证',
            'field' => '输入令牌',
        ],
    ],
];
