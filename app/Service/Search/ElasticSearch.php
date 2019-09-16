<?php


namespace App\Service\Search;


use App\Service\Service;
use Elasticsearch\ClientBuilder;
use Hyperf\Guzzle\RingPHP\CoroutineHandler;
use Swoole\Coroutine;

class ElasticSearch extends Service
{
    public function create(int $articleId, $title)
    {
        var_dump($articleId);
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
            'id' => $articleId,
            'index' => 'hyperf',
            'type' => 'article',
            'body' => [ 'id'=> $articleId, 'title' => $title]
        ];
        $client->create($params);
    }

    public function search()
    {

    }
}
