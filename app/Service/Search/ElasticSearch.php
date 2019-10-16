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

namespace App\Service\Search;

use App\Service\Service;
use Elasticsearch\ClientBuilder;
use Hyperf\Config\Annotation\Value;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\RingPHP\CoroutineHandler;
use Psr\Container\ContainerInterface;
use Swoole\Coroutine;

class ElasticSearch extends Service
{

    /**
     * @param string $index
     * @param string $type
     * @param int $id
     * @param array $data
     */
    public function create(string $index,string $type,int $id,array $data)
    {
        $host = env('ES_HOST','');

        $build = ClientBuilder::create();

        if (Coroutine::getCid() > 0) {
            $handler = make(CoroutineHandler::class, [
                'option' => [
                    'max_connections' => 50,
                ],
            ]);
            $build->setHandler($handler);
        }
        $client = $build->setHosts([$host])->build();
        $params = [
            'id' => $id,
            'index' => $index,
            'type' => $type,
            'body' => $data,
        ];
        $client->create($params);
    }

    public function search(string $index,string $type)
    {
        $data['index'] = $index;
        $data['type'] = $type;

    }
}
