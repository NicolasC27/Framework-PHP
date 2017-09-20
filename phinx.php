<?php
require 'public/index.php';

$migrations = [];
$seeds = [];
foreach ($modules as $module) {
    if ($module::MIGRATIONS) {
        $migrations[] = $module::MIGRATIONS;
    }
    if ($module::SEEDS) {
        $seeds[] = $module::SEEDS;
    }
}

return [
    'paths'        => [
        'migrations' => $migrations,
        'seeds'      => $seeds
    ],
    'environments' => [
        'default_database' => 'development',
        'development'      => [
            'adapter' => 'mysql',
	    'unix_socket' => '/opt/lamp/var/mysql/mysql.sock',
            'host' => $app->getContainer()->get('database.host'),
            'name' => $app->getContainer()->get('database.name'),
            'user' => $app->getContainer()->get('database.username'),
            'pass' => $app->getContainer()->get('database.password')
        ]
    ]
];