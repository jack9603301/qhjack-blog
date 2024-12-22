<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/qhjack/user/config/site.yaml',
    'modified' => 1729580354,
    'size' => 722,
    'data' => [
        'title' => 'Chunhui Ouyang - qhjack\'s Blogs',
        'default_lang' => 'zh',
        'author' => [
            'name' => 'Chunhui Ouyang',
            'email' => 'jack9603301@163.com'
        ],
        'taxonomies' => [
            0 => 'category',
            1 => 'tag',
            2 => 'author'
        ],
        'metadata' => [
            'description' => 'A personal homepage of a freelancer focusing on life and technology'
        ],
        'summary' => [
            'enabled' => true,
            'format' => 'short',
            'size' => 300,
            'delimiter' => '==='
        ],
        'redirects' => NULL,
        'routes' => NULL,
        'blog' => [
            'route' => '/blogs'
        ],
        'cache' => [
            'enabled' => true,
            'check' => [
                'method' => 'file'
            ],
            'driver' => 'auto',
            'prefix' => 'g',
            'purge_at' => '0 4 * * *',
            'clear_at' => '0 3 * * *',
            'clear_job_type' => 'standard',
            'clear_images_by_default' => false,
            'cli_compatibility' => false,
            'lifetime' => 604800,
            'gzip' => false,
            'allow_webserver_gzip' => false,
            'redis' => [
                'socket' => false,
                'password' => NULL,
                'database' => NULL
            ]
        ]
    ]
];
