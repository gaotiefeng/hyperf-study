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

$client = new swoole_client(SWOOLE_SOCK_TCP);

if (! $client->connect('127.0.0.1', 9511, 2)) {
    die('connect failed');
}

if (! $client->send('hello word')) {
    die('send failed');
}

$data = $client->recv();

if (! $data) {
    die('data is null');
}

echo $data;

$client->close();
