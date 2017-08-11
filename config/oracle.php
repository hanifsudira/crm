<?php

return [
    'oracle' => [
        'driver'        => 'oracle',
        'tns'           => env('DB_TNS', ''),
        'host'          => env('DB_HOST_ORA', ''),
        'port'          => env('DB_PORT_ORA', '1521'),
        'database'      => env('DB_DATABASE_ORA', ''),
        'username'      => env('DB_USERNAME_ORA', ''),
        'password'      => env('DB_PASSWORD_ORA', ''),
        'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
    ],
];
