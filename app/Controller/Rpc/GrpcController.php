<?php

declare(strict_types=1);

namespace App\Controller\Rpc;

use App\Controller\Controller;
use Grpc\HiReply;
use Grpc\HiUser;

class GrpcController extends Controller
{
    public function sayHello(HiUser $user)
    {
        $message = new HiReply();
        $message->setMessage("Hello World");
        $message->setUser($user);
        return $message;
    }
}
