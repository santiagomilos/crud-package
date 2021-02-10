<?php

return [
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'resources' => [
            'driver' => 'local',
            'root' => resource_path('views'),
        ],

        'routes' => [
            'driver' => 'local',
            'root' => 'routes',
        ],

        'controllers' => [
            'driver' => 'local',
            'root' => app_path('Http/Controllers'),
        ],

        'database' => [
            'driver' => 'local',
            'root' => 'database',
        ],

        'models' => [
            'driver' => 'local',
            'root' => app_path('Models'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],
    ],
];
