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

use Swoole\Process;

$process = new Process(function (Process $worker) {
    $worker->exec('/bin/echo', ['hello', 'goods']);
    $worker->write('hello you');
}, true);

$process->start();
//$process->write('pid');

echo $process->pid . "\n";
echo 'from exec ' . $process->read() . "\n";
