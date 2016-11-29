<?php

use Dotenv\Dotenv;
require 'vendor/autoload.php';

if(file_exists(__DIR__ . '/.env')):
    $dotenv = new Dotenv(__DIR__);
    $dotenv->load();
endif;

define('DS', DIRECTORY_SEPARATOR);

$path = __DIR__ . DS . '..' . DS . '..' . DS . '..';

// load kirby
require($path . DS . 'kirby' . DS . 'bootstrap.php');

// check for a custom site.php
if(file_exists($path . DS . 'site.php')) {
  require($path . DS . 'site.php');
} else {
  $kirby = kirby();
}

return [
    'paths' => 
        [
            'migrations' => $kirby->roots()->index() . DS . 'migrations',
            'seeds' => $kirby->roots()->index() . DS . 'seeds',
        ],
    'environments' => 
        [
            'default_migration_table' => 'phinxlog',
            'default_database' => 'default',
            'default' => 
                [
                    'adapter' => getenv('DB_ADAPTER'),
                    'host'    => getenv('DB_HOST'),
                    'name'    => getenv('DB_DATABASE'),
                    'user'    => getenv('DB_USERNAME'),
                    'pass'    => getenv('DB_PASSWORD'),
                    'port'    => 3306,
                    'charset' => 'utf8',
                ],
        ],
    ];