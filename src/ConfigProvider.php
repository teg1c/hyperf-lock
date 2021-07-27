<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Lock.
 *
 * @contact  teg1c@foxmail.com
 */
namespace Tegic\HyperfLock;

class ConfigProvider
{
    public function __invoke(): array
    {
        defined('BASE_PATH') or define('BASE_PATH', '');

        return [
            'dependencies' => [],
            'aspects'      => [],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'commands'  => [],
            'listeners' => [],
            'publish' => [
                [
                    'id'          => 'config',
                    'description' => 'config file of lock.',
                    'source'      => __DIR__ . '/../publish/lock.php',
                    'destination' => BASE_PATH . '/config/autoload/lock.php',
                ]
            ],
        ];
    }
}
