<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
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

        'avatars' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatars'),
            'url' => env('APP_URL').'/storage/avatars',
            'visibility' => 'public',
        ],

        'avatarscomercios' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatarscomercios'),
            'url' => env('APP_URL').'/storage/avatarscomercios',
            'visibility' => 'public',
        ],

        'bannerscomercios' => [
            'driver' => 'local',
            'root' => storage_path('app/public/bannerscomercios'),
            'url' => env('APP_URL').'/storage/bannerscomercios',
            'visibility' => 'public',
        ],

        'avatarsmanufacturers' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatarsmanufacturers'),
            'url' => env('APP_URL').'/storage/avatarsmanufacturers',
            'visibility' => 'public',
        ],

        'avatarscategories' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatarscategories'),
            'url' => env('APP_URL').'/storage/avatarscategories',
            'visibility' => 'public',
        ],

        'avatarssubcategories' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatarssubcategories'),
            'url' => env('APP_URL').'/storage/avatarssubcategories',
            'visibility' => 'public',
        ],

        'avatarsproducts' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatarsproducts'),
            'url' => env('APP_URL').'/storage/avatarsproducts',
            'visibility' => 'public',
        ],

        'filesnotificaciones' => [
            'driver' => 'local',
            'root' => storage_path('app/public/filesnotificaciones'),
            'url' => env('APP_URL').'/storage/filesnotificaciones',
            'visibility' => 'public',
        ],        

        'avatarspromociones' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatarspromociones'),
            'url' => env('APP_URL').'/storage/avatarspromociones',
            'visibility' => 'public',
        ],        

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('storage/avatars') => storage_path('app/public/avatars'),
        public_path('storage/avatarscomercios') => storage_path('app/public/avatarscomercios'),
        public_path('storage/bannerscomercios') => storage_path('app/public/bannerscomercios'),
        public_path('storage/avatarscategories') => storage_path('app/public/avatarscategories'),
        public_path('storage/avatarssubcategories') => storage_path('app/public/avatarssubcategories'),
        public_path('storage/avatarsproducts') => storage_path('app/public/avatarsproducts'),
        public_path('storage/avatarsmanufacturers') => storage_path('app/public/avatarsmanufacturers'),
        public_path('storage/filesnotificaciones') => storage_path('app/public/filesnotificaciones'),
        public_path('storage/avatarspromociones') => storage_path('app/public/avatarspromociones'),
        
    ],

];
