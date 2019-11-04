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

namespace App\Controller\Rpc;

use App\Controller\Controller;
use App\Service\Client\RpcClient;

class GrpcClientController extends Controller
{
    public function hello()
    {
        $client = new RpcClient('127.0.0.1:9523', [
            'credentials' => null,
        ]);

        $request = new \Grpc\HiUser();
        $request->setName('hyperf');
        $request->setSex(1);

        /*
         * @var \Grpc\HiReply
         */
        [$reply, $status] = $client->sayHello($request);

        $message = $reply->getMessage();
        $user = $reply->getUser();

        $client->close();
        var_dump(memory_get_usage(true));
        return [$message, $user];
    }
}
