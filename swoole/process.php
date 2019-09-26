<?php

use Swoole\Process;

$process = new Process(function(Process $worker){

    $worker->exec('/bin/echo',['hello','goods']);
    $worker->write('hello you');
},true);

$process->start();
//$process->write('pid');


echo $process->pid ."\n";
echo "from exec ".$process->read(). "\n" ;

