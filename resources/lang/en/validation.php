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
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' :attribute 必须被接受.',
    'active_url' => ' :attribute 不是有效的 URL.',
    'after' => ' :attribute 必须晚于 :date.',
    'after_or_equal' => ' :attribute 必须晚于或同于 :date.',
    'alpha' => ' :attribute 只能包含字母.',
    'alpha_dash' => ' :attribute 只能包含字母、数字和破折号.',
    'alpha_num' => ' :attribute 只能包含字母和数字.',
    'array' => ' :attribute 必须是一个数组.',
    'before' => ' :attribute 必须早于 :date.',
    'before_or_equal' => ' :attribute 必须是早于或同于 :date.',
    'between' => [
        'numeric' => ' :attribute 必须介于 :min - :max.',
        'file' => ' :attribute 必须介于 :min - :max KB.',
        'string' => ' :attribute 必须介于 :min - :max 字符.',
        'array' => ' :attribute 必须介于 :min - :max 数目.',
    ],
    'boolean' => ' :attribute 字段必须为 true 或 false.',
    'confirmed' => ' :attribute 确认不匹配.',
    'date' => ' :attribute 不是一个有效的日期.',
    'date_format' => ' :attribute 与格式 :format 不匹配.',
    'different' => ' :attribute 和 :other 不可相同.',
    'digits' => ' :attribute 必须 :digits 数字.',
    'digits_between' => ' :attribute 必须介于 :min - :max 个数字.',
    'dimensions' => ' :attribute 图片尺寸无效.',
    'distinct' => ' :attribute 字段具有重复值.',
    'email' => ' :attribute 必须是一个有效的电子邮箱地址.',
    'exists' => ' 所选的 :attribute 无效.',
    'file' => ' :attribute 必须是文件.',
    'filled' => ' :attribute 字段是必填的.',
    'image' => ' :attribute 必须是图片.',
    'in' => ' 所选的 :attribute 无效.',
    'in_array' => ' :attribute 字段不存在于 :other.',
    'integer' => ' :attribute 必须是整数.',
    'ip' => ' :attribute 必须是有效的 IP 地址.',
    'json' => ' :attribute 必须是有效的 JSON 字符串.',
    'max' => [
        'numeric' => ' :attribute 不得大于 :max.',
        'file' => ' :attribute 不得大于 :max KB.',
        'string' => ' :attribute 不得大于 :max 个字符.',
        'array' => ' :attribute 不得大于 :max 个数字.',
    ],
    'mimes' => ' :attribute 必须是文件类型: :values.',
    'mimetypes' => ' :attribute 必须是文件类型: :values.',
    'min' => [
        'numeric' => ' :attribute 必须至少 :min.',
        'file' => ' :attribute 必须至少 :min KB.',
        'string' => ' :attribute 必须至少 :min 个字符.',
        'array' => ' :attribute 必须至少 :min 个数字.',
    ],
    'not_in' => ' 所选的 :attribute 无效.',
    'numeric' => ' :attribute 必须是数字.',
    'present' => ' :attribute 字段必须存在.',
    'regex' => ' :attribute 格式无效.',
    'required' => ' :attribute 字段是必填的.',
    'required_if' => ' :attribute 字段是必填的, 当 :other 为 :value.',
    'required_unless' => ' :attribute 字段是必填的, 除非 :other 为 :values.',
    'required_with' => ' :attribute 字段是必填的, 当 :values 存在.',
    'required_with_all' => ' :attribute 字段是必填的, 当 :values 存在.',
    'required_without' => ' :attribute 字段是必填的, 当 :values 不存在.',
    'required_without_all' => ' :attribute 字段是必填的, 当 :values 都不存在.',
    'same' => ' :attribute 和 :other 必须一致.',
    'size' => [
        'numeric' => ' :attribute 必须为 :size.',
        'file' => ' :attribute 必须为 :size KB.',
        'string' => ' :attribute 必须为 :size 字符.',
        'array' => ' :attribute 必须包括 :size 个数字.',
    ],
    'string' => ' :attribute 必须是字符串.',
    'timezone' => ' :attribute 必须是有效区域.',
    'unique' => ' :attribute 已被占用.',
    'uploaded' => ' :attribute 上传失败.',
    'url' => ' :attribute 格式无效.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    | Simplified Chinese Translation Copyright (c) 2021 - 2022 Ice Ling <iceling@ilwork.cn>
    */

    'attributes' => [],

    // Internal validation logic for Pterodactyl
    'internal' => [
        'variable_value' => ':env 变量',
        'invalid_password' => '此帐户提供的密码无效.',
    ],
];
