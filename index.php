<?php

use App\Utils\Router;

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

$router = new Router();
$router->run();