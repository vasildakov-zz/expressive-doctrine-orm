<?php
return [
    'dependencies' => [
        'factories' => [
            Doctrine\ORM\EntityManager::class  => VasilDakov\Doctrine\Container\DoctrineFactory::class,
            Doctrine\Common\Cache\Cache::class => VasilDakov\Doctrine\Container\DoctrineRedisCacheFactory::class,
        ]
    ],
];