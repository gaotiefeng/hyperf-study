<?php

$serv = new Swoole\Server("127.0.0.1",'9511');

//$serv->set(array(
//    'open_length_check' => true,
//    'package_max_length' => 81920,
//    'package_length_type' => 'n', //see php pack()
//    'package_length_offset' => 0,
//    'package_body_offset' => 2,
//    'open_eof_split' => true,
//    'package_eof' => "\r\n",
//));

$serv->set(array('task_worker_num'=> 4));

$serv->on('Connect',function ($serv,$fd){
   echo "Client Connect \n fd:".$fd."\n".PHP_EOL;
});

$serv->on('receive', function ($serv,$fd,$form_id,$data){
    echo "fd:".$fd."form_id:".$form_id."\n".PHP_EOL;
    $taskId = $serv->task($data); //投递任务
    echo "Dispath AsyncTask: id=$taskId\n".PHP_EOL;
    $serv->send($fd, "Serve:".$data);
});

$serv->on('task', function ($serv, $task_id, $form_id, $data){
    echo "New AsyncTask[id=$task_id]".PHP_EOL;
    //返回任务执行的结果
    $serv->finish("$data -> OK");
});

$serv->on('finish', function ($serv, $task_id, $data){
    echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
});

$serv->on('Close',function ($serv,$fd){
    echo "Client CLOST \n";
});

$serv->start();

//telnet 127.0.0.1 9511
