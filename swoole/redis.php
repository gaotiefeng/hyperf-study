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

use Swoole\Coroutine\MySQL as mysql;
use Swoole\Coroutine\Redis as redis;

$http = new swoole_http_server('0.0.0.0', 9501);

$http->on('request', function ($request, $response) {
    $db = new mysql();
    $db->connect([
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => 'tf2019',
        'database' => 'gin',
    ]);
    $data = $db->query('select * from user');

    $redis = new redis();
    $redis->connect('127.0.0.1', 6379);
    $redis->set('gin', json_encode($data));

    $response->end(json_encode($data));
});

$http->start();
