<?php

use Hyperf\HttpServer\Router\Router;

Router::get('/', 'App\Controller\IndexController::index');
