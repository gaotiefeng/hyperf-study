<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::get('/', 'App\Controller\IndexController::index');

Router::post('/user/login', 'App\Controller\Web\UserController::login');
Router::post('/user/register', 'App\Controller\Web\UserController::register');
Router::get('/user/info', 'App\Controller\Web\UserController::info');
