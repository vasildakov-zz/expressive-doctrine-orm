<?php
namespace VasilDakov\Doctrine\Service;

use Doctrine\Common\Cache\RedisCache;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class DoctrineRedisCacheFactory
{
    /**
     * @param  ContainerInterface $container
     * @return RedisCache  $cache
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config') ? $container->get('config') : [];

        if (!isset($config['doctrine'])) {
            throw new ServiceNotCreatedException('Missing Doctrine Cache configuration');
        }

        $redis = new \Redis();

        $redis->connect(
            $config['doctrine']['cache']['redis']['host'],
            $config['doctrine']['cache']['redis']['port']
        );

        $cache = new RedisCache();
        $cache->setRedis($redis);

        return $cache;
    }
}
