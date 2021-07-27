<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Lock.
 *
 * @contact  teg1c@foxmail.com
 */
namespace Tegic\HyperfLock;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;
use InvalidArgumentException;
use Psr\Container\ContainerInterface;
use Tegic\HyperfLock\Driver\LockInterface;
use Tegic\HyperfLock\Driver\RedisLock;

class Lock
{
    /**
     * Get a lock instance.
     *
     * @param string $name
     * @param int $seconds
     * @param null|string $owner
     * @param string $driver
     */
    public static function getInstance($name, $seconds = 0, $owner = null, $driver = 'default'): LockInterface
    {
        /** @var ContainerInterface $container */
        $container = ApplicationContext::getContainer();
        /** @var ConfigInterface $config */
        $config = $container->get(ConfigInterface::class);

        if (! $config->has("lock.{$driver}")) {
            throw new InvalidArgumentException(sprintf('The lock config %s is invalid.', $driver));
        }

        $driverClass = $config->get("lock.{$driver}.driver", RedisLock::class);
        $poolName    = $config->get("lock.{$driver}.constructor.pool", 'default');

        return make($driverClass, [
            'name'     => $name,
            'seconds'  => $seconds,
            'owner'    => $owner,
            'poolName' => $poolName,
        ]);
    }
}
