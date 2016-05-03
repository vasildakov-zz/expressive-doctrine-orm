<?php
return [
    'dependencies' => [
        'factories' => [
            Doctrine\ORM\EntityManager::class  => VasilDakov\Container\DoctrineFactory::class,
            Doctrine\Common\Cache\Cache::class => VasilDakov\Container\DoctrineRedisCacheFactory::class,
        ]
    ],
];