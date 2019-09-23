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

$ws = new Swoole\WebSocket\Server('192.168.41.99', 9514);

$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "Hello word ws \n");
});

$ws->on('message', function ($ws, $frame) {
    $ws->push($frame->fd, 'Message' . $frame->data);
});

$ws->on('close', function ($ws, $fd) {
    echo "close fd={ {$fd} } \n";
});

$ws->start();
