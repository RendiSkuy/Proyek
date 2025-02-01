<?php

return [

    'defaults' => [
        'guard' => 'web', // Default guard tetap 'web'
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // 🔥 Tambahkan guard baru untuk nasabah
        'nasabah' => [
            'driver' => 'session',
            'provider' => 'nasabahs',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 🔥 Tambahkan provider untuk nasabah
        'nasabahs' => [
            'driver' => 'eloquent',
            'model' => App\Models\Nasabah::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // 🔥 Tambahkan reset password untuk nasabah (jika diperlukan)
        'nasabahs' => [
            'provider' => 'nasabahs',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
