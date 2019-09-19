<?php

$client = new swoole_client(SWOOLE_SOCK_TCP);

if (! $client->connect('127.0.0.1',9511,2)) {
    die("connect failed");
}

if (! $client->send("hello word")) {
    die("send failed");
}

$data = $client->recv();

if( ! $data) {
    die("data is null");
}

echo $data;

$client->close();
