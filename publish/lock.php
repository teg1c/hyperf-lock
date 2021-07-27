<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Lock.
 *
 * @contact  teg1c@foxmail.com
 */
return [
    'default' => [
        'driver'      => Tegic\HyperfLock\Driver\RedisLock::class,
        'constructor' => [
            'pool' => 'default',
        ],
    ],
];
