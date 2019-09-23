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

$serv = new Swoole\Server('127.0.0.1', 9512, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$serv->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], 'UDP-Serve:' . $data);
    var_dump($clientInfo);
});

//使用packet 监听数据接收事件 sendto 发送
$serv->start();

//netcat -u 127.0.0.1 9512   //nc
