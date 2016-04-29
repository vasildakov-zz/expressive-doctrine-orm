<?php
return [
    'doctrine' => [
        'connection' => [
            // default connection
            'orm_default' => [
                'driverClass' => Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'driver'   => 'pdo_mysql',
                    'host'     => '127.0.0.1',
                    'port'     => '3306',
                    'dbname'   => 'database',
                    'user'     => 'username',
                    'password' => 'password',
                    'charset'  => 'UTF8',
                ],
            ],
        ],
        'driver' => [
            'annotations' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\DoctrineAnnotations',
                'cache' => 'array',
                'paths' => [
                    'path/to/my/entities',
                ],
            ],
        ],
        // Configuration details for the ORM.
        // See http://docs.doctrine-project.org/en/latest/reference/configuration.html
        'configuration'  => [
            'auto_generate_proxy_classes' => false,

            // directory where proxies will be stored. By default, this is in
            // the `data` directory of your application
            'proxy_dir'                   => 'data/DoctrineORM/Proxy',

            // namespace for generated proxy classes
            'proxy_namespace'             => 'DoctrineORM/Proxy',

            // underscore naming strategy
            'underscore_naming_strategy'  => true,
        ],
        'cache'      => [
            'redis' => [
                'host' => '127.0.0.1',
                'port' => '6379',
            ],
        ],
    ],
];