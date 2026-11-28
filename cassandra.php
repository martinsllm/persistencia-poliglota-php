<?php

$cluster = Cassandra::cluster()
    ->withContactPoints('cassandra')
    ->build();

$session = $cluster->connect('e_commerce');

/*$statement = $session->prepare('INSERT INTO products (product_id, name, price) VALUES (?, ?, ?);');

$session->execute($statement, [
    'arguments' => [
        'product_id' => 1,
        'name' => 'Produto',
        'price' => 1000_00,
    ]
]);*/

$rows = $session->execute('SELECT * FROM products');

foreach ($rows as $row) {
    var_dump($row);
}
