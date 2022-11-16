<?php

use App\Utils\Router;

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router->run();