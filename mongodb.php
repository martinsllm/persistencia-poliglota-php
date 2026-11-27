<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$env = parse_ini_file(__DIR__ . '/.env');

$mongoClient = new Client("mongodb://{$env['MONGO_INITDB_ROOT_USERNAME']}:{$env['MONGO_INITDB_ROOT_PASSWORD']}@mongodb:{$env['MONGO_PORT']}");

$database = $mongoClient->selectDatabase($env['MONGO_INITDB_DATABASE']);

$collection = $database->selectCollection('products');

$collection->insertOne(['name' => 'Product 1', 'price' => 150]);

var_dump($collection->findOne(['name' => 'Product 1']));