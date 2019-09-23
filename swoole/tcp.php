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
$host = '127.0.0.1';
$port = '9512';
$serv = new Swoole\Server('127.0.0.1', '9511');

//$serv->set(array(
//    'open_length_check' => true,
//    'package_max_length' => 81920,
//    'package_length_type' => 'n', //see php pack()
//    'package_length_offset' => 0,
//    'package_body_offset' => 2,
//    'open_eof_split' => true,
//    'package_eof' => "\r\n",
//));
$port = $serv->addListener($host, $port, $type = SWOOLE_SOCK_TCP);

echo $port->port;
echo PHP_EOL;

$serv->set(['task_worker_num' => 4]);

$serv->on('Connect', function ($serv, $fd) {
    echo "Client Connect \n fd:" . $fd . "\n" . PHP_EOL;
    $serv->bind($fd, $fd);
    var_dump($serv->getClientInfo($fd));
    echo PHP_EOL;
    var_dump($serv->getClientList(0, 10));
    echo PHP_EOL;
});

$serv->on('receive', function ($serv, $fd, $form_id, $data) {
    echo 'fd:' . $fd . 'form_id:' . $form_id . "\n" . PHP_EOL;
    $taskId = $serv->task($data); //投递任务
    echo "Dispath AsyncTask: id={$taskId}\n" . PHP_EOL;
    $serv->send($fd, 'Serve:' . $data);

    echo 'stats->';
    var_dump($serv->stats());
    echo PHP_EOL;
});

$serv->on('task', function ($serv, $task_id, $form_id, $data) {
    echo "New AsyncTask[id={$task_id}]" . PHP_EOL;
    //返回任务执行的结果
    $serv->finish("{$data} -> OK");
});

$serv->on('finish', function ($serv, $task_id, $data) {
    echo "AsyncTask[{$task_id}] Finish: {$data}" . PHP_EOL;
});

$serv->on('Close', function ($serv, $fd) {
    echo "Client CLOST \n";
});

$serv->start();

//telnet 127.0.0.1 9511
