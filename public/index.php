<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\SimpleRouter\Router;

$router = new Router;

$router->load( include __DIR__.'/../routes.php');

$router->dispatch($uri);
