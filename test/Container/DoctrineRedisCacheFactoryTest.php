<?php
namespace VasilDakov\Tests\Container;

use VasilDakov\Doctrine\Container\DoctrineRedisCacheFactory;
use Interop\Container;

use Zend\Stdlib\ArrayUtils;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

use Doctrine\Common\Cache\RedisCache;

class DoctrineRedisCacheFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testServiceNotCreatedException()
    {
        $this->setExpectedException(ServiceNotCreatedException::class, 'Missing Doctrine Cache configuration');

        $config = [];

        $container = new ServiceManager();
        (new Config($config))->configureServiceManager($container);

        $container->setService('config', $config);

        $factory = new DoctrineRedisCacheFactory();
        $this->assertInstanceOf(DoctrineRedisCacheFactory::class, $factory);

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

        $factory = new DoctrineRedisCacheFactory();
        $this->assertInstanceOf(DoctrineRedisCacheFactory::class, $factory);

        $instance = $factory->__invoke($container);
        $this->assertInstanceOf(RedisCache::class, $instance);

    }
}