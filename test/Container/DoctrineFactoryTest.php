<?php
namespace VasilDakov\Tests\Container;

use VasilDakov\Doctrine\Container\DoctrineFactory;
use Interop\Container;

use Zend\Stdlib\ArrayUtils;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\RedisCache;

class DoctrineFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testServiceNotCreatedException()
    {
        $this->setExpectedException(ServiceNotCreatedException::class, 'Missing Doctrine configuration');

        $config = [];

        $container = new ServiceManager();
        (new Config($config))->configureServiceManager($container);

        $container->setService('config', $config);

        $factory = new DoctrineFactory();
        $this->assertInstanceOf(DoctrineFactory::class, $factory);

        $factory->__invoke($container);
    }


    public function testFactory()
    {
        $config = [];

        $configFiles = [
            __DIR__ . '/../config/dependencies.global.php',
            __DIR__ . '/../config/doctrine.global.php',
        ];

        // Merge all module config options
        foreach ($configFiles as $configFile) {
            $config = ArrayUtils::merge($config, include $configFile);
        }

        $container = new ServiceManager();
        (new Config($config['dependencies']))->configureServiceManager($container);

        $container->setService('config', $config);

        //var_dump($container->get(EntityManager::class)); exit();
        //var_dump($container->get(EntityManager::class)); exit();

        $factory = new DoctrineFactory();
        $this->assertInstanceOf(DoctrineFactory::class, $factory);

        $instance = $factory->__invoke($container);
        $this->assertInstanceOf(EntityManager::class, $instance);

    }
}