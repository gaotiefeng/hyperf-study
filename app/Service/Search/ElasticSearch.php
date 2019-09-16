<?php


namespace App\Service\Search;


use App\Service\Service;
use Elasticsearch\ClientBuilder;
use Hyperf\Guzzle\RingPHP\CoroutineHandler;
use Swoole\Coroutine;

class ElasticSearch extends Service
{
    public function create()
    {
        $build = ClientBuilder::create();

        if(Coroutine::getCid() > 0) {
            $handler = make(CoroutineHandler::class,[
                'option' => [
                    'max_connections' => 50,
                ],
            ]);
            $build->setHandler($handler);
        }
        $client = $build->setHosts(['http://139.9.164.21:9200'])->build();
        $params = [
            'id' => 3,
            'index' => 'hyperf',
            'type' => 'article',
            'body' => [ 'id'=> 1, 'title' => 'title']
        ];
        $client->create($params);
    }

    public function info()
    {
        $build = ClientBuilder::create();

        if(Coroutine::getCid() > 0) {
            $handler = make(CoroutineHandler::class,[
                'option' => [
                    'max_connections' => 50,
                ],
            ]);
            $build->setHandler($handler);
        }
        $client = $build->setHosts(['http://139.9.164.21:9200'])->build();

        $client->info();
    }
}
