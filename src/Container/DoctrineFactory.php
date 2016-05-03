<?php

namespace VasilDakov\Doctrine\Container;

use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Cache\Cache;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class DoctrineFactory
{
    /**
     * @param  ContainerInterface $container
     * @return EntityManager
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config') ? $container->get('config') : [];

        if (!isset($config['doctrine'])) {
            throw new ServiceNotCreatedException('Missing Doctrine configuration');
        }

        $config = $config['doctrine'];

        $proxyDir = (isset($config['proxy_dir'])) ? $config['proxy_dir'] : 'data/DoctrineORM/Proxy';

        $proxyNamespace = (isset($config['proxy_namespace'])) ? $config['proxy_namespace'] : 'DoctrineORM/Proxy';

        $autoGenerateProxyClasses = (isset($config['configuration']['auto_generate_proxy_classes']))
                                    ? $config['configuration']['auto_generate_proxy_classes']
                                    : false;

        $underscoreNamingStrategy = (isset($config['configuration']['underscore_naming_strategy']))
                                    ? $config['configuration']['underscore_naming_strategy']
                                    : false;

        // Doctrine ORM
        $doctrine = new Configuration();
        $doctrine->setProxyDir($proxyDir);
        $doctrine->setProxyNamespace($proxyNamespace);
        $doctrine->setAutoGenerateProxyClasses($autoGenerateProxyClasses);

        // Naming Strategy
        if ($underscoreNamingStrategy) {
            $doctrine->setNamingStrategy(new UnderscoreNamingStrategy());
        }

        // ORM mapping by Annotation
        //AnnotationRegistry::registerAutoloadNamespace($config['driver']['annotations']['class']);
        AnnotationRegistry::registerFile('vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
        $driver = new AnnotationDriver(
            new AnnotationReader(),
            $config['driver']['annotations']['paths']
        );
        $doctrine->setMetadataDriverImpl($driver);

        // Cache
        $cache = $container->get(Cache::class);
        $doctrine->setQueryCacheImpl($cache);
        $doctrine->setResultCacheImpl($cache);
        $doctrine->setMetadataCacheImpl($cache);

        // EntityManager
        return EntityManager::create($config['connection']['orm_default']['params'], $doctrine);
    }
}
