<?php
return [
    "default"     => 'qiniu', //默认返回存储位置url
    "dirver"      => ['qiniu'], //存储平台 ['local', 'qiniu', 'aliyun']
    "connections" => [
        "local"  => [
            'prefix' => 'uploads/markdown', //本地存储位置，默认uploads
        ],
        "qiniu"  => [
            'access_key' => 'Ip4Ai9cExoiOdt-vLsfMlTgo0rHyJGjzvtSsW0DS',
            'secret_key' => 'Ik8WWy3KPG69ATraq1IHacVAg2reScITRUUVzF8j',
            'bucket'     => 'loan',
            'prefix'     => 'file/', //文件前缀 file/of/path
            'domain'     => 'http://file.bobcoder.cc',
        ],
        "aliyun" => [
            'ak_id'     => '',
            'ak_secret' => '',
            'end_point'  => '',
            'bucket'    => '',
            'prefix'    => '',
        ],
    ],
];