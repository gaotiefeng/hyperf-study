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
use Hyperf\Guzzle\RingPHP\CoroutineHandler;
use Swoole\Coroutine;

class ElasticSearch extends Service
{
    public function client()
    {
        $host = env('ES_HOST', '');

        $build = ClientBuilder::create();

        if (Coroutine::getCid() > 0) {
            $handler = make(CoroutineHandler::class, [
                'option' => [
                    'max_connections' => 50,
                ],
            ]);
            $build->setHandler($handler);
        }
        return $build->setHosts([$host])->setRetries(2)->build();
    }

    /**
     * @param string $index
     * @param string $type
     * @param int $id
     * @param array $data
     */
    public function create(string $index, string $type, int $id, array $data)
    {
        try {
            $client = $this->client();

            //TODO 'client' => [ 'ignore' => [400, 404] 忽略多个http状态码,'verbose' => true 返回头部 状态吗]
            $params = [
                'id' => $id,
                'index' => $index,
                'type' => $type,
                'body' => ['doc' => $data],
            ];

            $client->update($params);
        } catch (\Exception $exception) {
            $this->logger->error('DOC UPDATE elasticSearch is error' . $exception->getMessage());
            var_dump($exception->getMessage());
        }
    }

    public function search(string $index, string $type, int $offset, int $limit)
    {
        try {
            $client = $this->client();

            $params = [
                'index' => $index,
                'type' => $type,
                'body' => [ 'query' => ['match' => ['title' => '你知道']]],
                'size' => $offset,
                'from' => $limit,
            ];

            return $client->search($params);
        } catch (\Exception $exception) {
            $this->logger->error('SEARCH elasticSearch is error' . $exception->getMessage());
        }
    }

    public function delete($index,$type,$id)
    {
        try {

            $client = $this->client();
            $param = [
                'index' => $index,
                'type' => $type,
                'id' => $id,
            ];

            return $client->delete($param);
        } catch (\Exception $exception) {
            $this->logger->error('DELETE elasticSearch is error' . $exception->getMessage());
            var_dump($exception->getMessage());
        }
    }
}
