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

Router::get('/admin/index', 'App\Controller\Admin\AdminController::index');
Router::post('/admin/delete', 'App\Controller\Admin\AdminController::delete');
Router::post('/admin/save', 'App\Controller\Admin\AdminController::save');

Router::post('/route/save', 'App\Controller\Admin\RouteController::save');
Router::get('/route/index', 'App\Controller\Admin\RouteController::index');
Router::post('/route/delete', 'App\Controller\Admin\RouteController::delete');
Router::get('/route/all', 'App\Controller\Admin\RouteController::all');

Router::post('/role/save', 'App\Controller\Admin\RoleController::save');
Router::get('/role/index', 'App\Controller\Admin\RoleController::index');
Router::post('/role/delete', 'App\Controller\Admin\RoleController::delete');
Router::get('/role/all', 'App\Controller\Admin\RoleController::all');

Router::post('/user/login', 'App\Controller\Admin\UserController::login');
Router::get('/user/info', 'App\Controller\Admin\UserController::info');
Router::get('/user/images', 'App\Controller\Admin\UserController::images');

Router::get('/article/index', 'App\Controller\Admin\ArticleController::index');
Router::get('/article/info', 'App\Controller\Admin\ArticleController::info');

Router::get('/grpc/test', 'App\Controller\Rpc\GrpcClientController::hello');
