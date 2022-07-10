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
    'location' => [
        'no_location_found' => '找不到与提供的标识码匹配的服务器组.',
        'ask_short' => '节点服务器组标识码',
        'ask_long' => '节点服务器组描述',
        'created' => '成功新建节点服务器组 (:name) 其 ID 为 :id.',
        'deleted' => '成功删除对应的节点服务器组.',
    ],
    'user' => [
        'search_users' => '请输入用户名,用户 ID,或者用户邮箱地址',
        'select_search_user' => '要删除的用户 ID (输入 \'0\' 重新搜索)',
        'deleted' => '用户已成功删除.',
        'confirm_delete' => '确定删除此用户吗?',
        'no_users_found' => '未找到与提供的信息匹配的用户.',
        'multiple_found' => '使用提供的信息找到多个帐户，由于 --no-interaction 参数而无法删除用户.',
        'ask_admin' => '目标用户是否为管理用户?',
        'ask_email' => '电子邮件地址',
        'ask_username' => '用户名',
        'ask_name_first' => '姓',
        'ask_name_last' => '名',
        'ask_password' => '密码',
        'ask_password_tip' => '如果您想创建一个随机密码的账户并通过通过电子邮件发送给用户，请重新运行此命令 (CTRL+C) 并加上 `--no-password` 参数.',
        'ask_password_help' => '密码长度必须至少为 8 个字符，并且至少包含一个大写字母和数字.',
        '2fa_help_text' => [
            '此命令将会关闭已开启动态口令认证的用户的动态口令认证功能，请在用户丢失动态口令认证令牌且无法使用恢复代码时使用此指令.',
            '如果你不小心按出来这个命令，请按下 CTRL+C 组合键退出.',
        ],
        '2fa_disabled' => '电子邮件地址为 :email 的用户下动态口令认证已被关闭.',
    ],
    'schedule' => [
        'output_line' => '为第一个任务分配工作 `:schedule` (:hash).',
    ],
    'maintenance' => [
        'deleting_service_backup' => '删除服务备份文件 :file.',
    ],
    'server' => [
        'rebuild_failed' => '位于节点服务器 ":node" ，ID 为 ":name" (#:id) 的重建请求已失败，返回信息: :message',
        'reinstall' => [
            'failed' => '位于节点服务器 ":node" ，ID 为 ":name" (#:id) 的重新安装请求已失败，返回信息: :message',
            'confirm' => '您即将针对一组服务器重新安装，确定吗?',
        ],
        'power' => [
            'confirm' => '你即将对 :count 个服务器进行电源操作 :action . 你确定吗?',
            'action_failed' => '位于节点服务器 ":node" ，ID 为 ":name" (#:id) 的电源操作请求已失败，返回信息: :message',
        ],
    ],
    'environment' => [
        'mail' => [
            'ask_smtp_host' => 'SMTP 服务器地址 (例如. smtp.gmail.com)',
            'ask_smtp_port' => 'SMTP 服务器端口',
            'ask_smtp_username' => 'SMTP 用户名',
            'ask_smtp_password' => 'SMTP 密码',
            'ask_mailgun_domain' => 'Mailgun 域名',
            'ask_mailgun_endpoint' => 'Mailgun 节点',
            'ask_mailgun_secret' => 'Mailgun Secret',
            'ask_mandrill_secret' => 'Mandrill Secret',
            'ask_postmark_username' => 'Postmark API 密钥',
            'ask_driver' => '应该使用哪个驱动程序来发送电子邮件?',
            'ask_mail_from' => '发件人地址',
            'ask_mail_name' => '发件人',
            'ask_encryption' => '加密方式',
        ],
    ],
];
