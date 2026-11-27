<?php

declare(strict_types=1);

$env = parse_ini_file(__DIR__ . '/.env');

$memcached = new Memcached();
$memcached->addServer('memcached', 11211);

$memcached->set('test', json_encode(['message' => 'Hello, World!']), 10);

var_dump($memcached->get('test'));