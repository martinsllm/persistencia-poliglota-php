<?php

declare(strict_types=1);

$redis = new Redis();
$redis->connect('redis', 6379);

$redis->set('test', json_encode(['message' => 'Hello, World!']));
echo $redis->get('test');


