<?php

return [
    'permission' => [
        'column_names' => [
            'model_morph_key' => 'model_id',
        ],
        'display_permission_in_exception' => false,
        'cache' => [
            'expiration_time' => \DateInterval::createFromDateString('24 hours'),
            'key' => 'maia.permission.cache',
            'model_key' => 'name',
            'store' => 'default',
        ],
    ],
    'filemanager' => [
        'disk'      => env('FILEMANAGER_DISK', 'public'),
        'order'     => env('FILEMANAGER_ORDER', 'mime'),
        'direction' => env('FILEMANAGER_DIRECTION', 'asc'),
        'cache'     => env('FILEMANAGER_CACHE', false),
        'buttons'   => [
            'create_folder'   => true,
            'upload_button'   => true,
            'select_multiple' => true,
            'rename_folder'   => true,
            'delete_folder'   => true,
            'rename_file'     => true,
            'delete_file'     => true,
        ],
        'filters'   => [
            'Images'     => ['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp', 'tiff'],
            'Documents'  => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pps', 'pptx', 'odt', 'rtf', 'md', 'txt', 'css'],
            'Videos'     => ['mp4', 'avi', 'mov', 'mkv', 'wmv', 'flv', '3gp', 'h264'],
            'Audios'     => ['mp3', 'ogg', 'wav', 'wma', 'midi'],
            'Compressed' => ['zip', 'rar', 'tar', 'gz', '7z', 'pkg'],
        ],
        'filter'    => false,
        'naming'    => \SpaceCode\Maia\Services\DefaultNamingStrategy::class,
        'jobs'      => [],
    ],
    'sitemap' => [
        'use_cache' => false,
        'cache_key' => 'maia-sitemap.' . \Illuminate\Support\Str::slug(str_replace(['http://', 'https://'], '', config('app.url')), '-'),
        'cache_duration' => 0,
        'escaping' => true,
        'use_limit_size' => false,
        'max_size' => null,
        'use_styles' => true,
        'styles_location' => '/vendor/sitemap/',
        'use_gzip' => false
    ]
];
