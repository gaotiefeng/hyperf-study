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

Router::post('/user/login', 'App\Controller\Admin\UserController::login');
Router::get('/user/info', 'App\Controller\Admin\UserController::info');

Router::get('/article/index', 'App\Controller\Admin\ArticleController::index');
Router::get('/article/info', 'App\Controller\Admin\ArticleController::info');
