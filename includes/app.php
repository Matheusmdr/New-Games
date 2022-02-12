<?php

require __DIR__ . '/../vendor/autoload.php';


use \App\Utils\View;
use \App\Http\Middleware\Queue as MiddlewareQueue;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;

Environment::load(__DIR__.'/../');

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

define('URL', getenv('URL'));


View::init([
    'URL' => URL
]);

MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class,
    'required-admin-logout' => \App\Http\Middleware\RequireAdminLogout::class,
    'required-admin-login' => \App\Http\Middleware\RequireAdminLogin::class,
    'required-client-logout' => \App\Http\Middleware\RequireClientLogout::class,
    'required-client-login' => \App\Http\Middleware\RequireClientLogin::class
]);

MiddlewareQueue::setDefault([
    'maintenance'
]);