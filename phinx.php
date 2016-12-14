<?php

use Dotenv\Dotenv;
require 'vendor/autoload.php';

if(!defined('DS'))    define('DS', DIRECTORY_SEPARATOR);

require __DIR__ . DS . 'lib' . DS . 'helpers.php';

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
            'migrations' => $kirby->roots()->index() . DS . PhinxHelper::env('PHINX_MIGRATIONS', 'migrations'),
            'seeds' => $kirby->roots()->index() . DS . PhinxHelper::env('PHINX_SEEDS', 'seeds'),
        ],
    'environments' => 
        [
            'default_migration_table' => 'phinxlog',
            'default_database' => 'default',
            'default' => 
                [
                    'adapter' => PhinxHelper::env('DB_ADAPTER', 'mysql'),
                    'host'    => PhinxHelper::env('DB_HOST', 'localhost'),
                    'name'    => PhinxHelper::env('DB_DATABASE', 'dbname'),
                    'user'    => PhinxHelper::env('DB_USERNAME', 'user'),
                    'pass'    => PhinxHelper::env('DB_PASSWORD', 'password'),
                    'port'    => 3306,
                    'charset' => 'utf8',
                ],
        ],
    ];