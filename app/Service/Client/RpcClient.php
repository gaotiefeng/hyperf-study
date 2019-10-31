<?php


namespace App\Service\Client;


use Grpc\HiReply;
use Grpc\HiUser;
use Hyperf\GrpcClient\BaseClient;

class RpcClient extends BaseClient
{
    public function sayHello(HiUser $argument)
    {
        return $this->simpleRequest(
            '/grpc.hi/sayHello',
            $argument,
            [HiReply::class, 'decode']
        );
    }
}