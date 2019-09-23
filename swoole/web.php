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

$http = new Swoole\Http\Server('192.168.41.99', 9513);

$http->on('request', function ($request, $response) {
    if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
        return $response->end();
    }
    [$controller, $action] = explode('/', trim($request->server['request_uri'], '/'));
    //根据 $controller, $action 映射到不同的控制器类和方法
    //(new $controller)->$action($request, $response);
    var_dump($request->get, $request->post);
    echo PHP_EOL;
    var_dump($request->server['request_uri']);
    $response->header('Content-Type', 'text/html; charset=utf-8');
    $response->end('<h1>Hello Swoole. #' . rand(1000, 9999) . '</h1>');
});

$http->start();
