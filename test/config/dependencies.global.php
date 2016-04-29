<?php
return [
    'dependencies' => [
        'factories' => [
            Doctrine\ORM\EntityManager::class  => VasilDakov\Doctrine\Service\DoctrineFactory::class,
            Doctrine\Common\Cache\Cache::class => VasilDakov\Doctrine\Service\DoctrineRedisCacheFactory::class,
        ]
    ],
];