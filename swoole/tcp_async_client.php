<?php

$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

//$client->set(array(
//    'open_length_check' => true,
//    'package_max_length' => 81920,
//    'package_length_type' => 'n', //see php pack()
//    'package_length_offset' => 0,
//    'package_body_offset' => 2,
//    'open_eof_split' => true,
//    'package_eof' => "\r\n",
//));

$client->on("connect", function ($cli){
    $cli->send("hello word async ................................1234567890qwertyuiopasdfghjklzxcvbnm");
});

$client->on("receive", function ($cli,$data){
   echo "Received :{$data} \n";
});

$client->on("error", function($cli){
   echo "Connect error \n";
});

$client->on("close", function ($cli){
    echo "async close \n";
});

$client->connect('127.0.0.1',9511, 0.5);
