<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Elastic\Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->setHosts(['elasticsearch:9200'])->build();

/*$response = $client->indices()->create([
    'index' => 'products',
]);*/

/* $document = [
    'name' => 'Product 1',
    'price' => 150
];

$response = $client->index([
    'index' => 'products',
    'body' => $document
]); */

$response = $client->search([
    'index' => 'products',
    'body' => [
        'query' => [
            'match' => ['name' => 'Product 1']
        ]
    ]
]);

echo $response;
