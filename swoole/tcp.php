<?php

$serv = new Swoole\Server("127.0.0.1",'9511');

$serv->on('Connect',function ($serv,$fd){
   echo "Client Connect \n fd:".$fd."\n";
});

$serv->on('Receive', function ($serv,$fd,$form_id,$data){
    echo "fd:".$fd."form_id:".$form_id."\n";
    $serv->send($fd, "Serve:".$data);
});

$serv->on('Close',function ($serv,$fd){
    echo "Client CLOST \n";
});

$serv->start();

//telnet 127.0.0.1 9511
