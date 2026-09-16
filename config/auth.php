<?php

return [
    'defaults' => [
        'guard'     => 'web',
        'passwords' => 'tai_khoans',
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'tai_khoans',
        ],
    ],

    'providers' => [
        'tai_khoans' => [
            'driver' => 'eloquent',
            'model'  => App\Models\TaiKhoan::class,
        ],
    ],

    'passwords' => [
        'tai_khoans' => [
            'provider' => 'tai_khoans',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
