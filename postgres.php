<?php

declare(strict_types=1);

$env = parse_ini_file(__DIR__ . '/.env');

$pdo = new PDO(
    "pgsql:host={$env['POSTGRES_HOST']};dbname={$env['POSTGRES_DB']}",
    $env['POSTGRES_USER'],
    $env['POSTGRES_PASSWORD'],
);

var_dump($pdo);
