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

use Elasticsearch\ClientBuilder;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Guzzle\RingPHP\CoroutineHandler;
use Psr\Container\ContainerInterface;
use Swoole\Coroutine;

abstract class ElasticSearch
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    /**
     * @var ContainerInterface
     */
    protected $container;

    protected $index;

    protected $type;

    protected $id;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->logger = $container->get(StdoutLoggerInterface::class);
    }

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

    public function putMapping()
    {

    }

    public function create(array $data)
    {
        try {
            $client = $this->client();

            //TODO 'client' => [ 'ignore' => [400, 404] 忽略多个http状态码,'verbose' => true 返回头部 状态吗]
            $params = [
                'index' => $this->index,
                'type' => $this->type,
                'id' => $this->id,
                'body' => $data,
            ];

            $client->create($params);
        } catch (\Exception $exception) {
            $this->logger->error('DOC UPDATE elasticSearch is error' . $exception->getMessage());
        }
    }

    //TODO 查询 "query" : {
    //      "term" : { "user_id" : "1" }
    //    }
    public function search(array $query)
    {
        try {
            $client = $this->client();

            $params = [
                'index' => $this->index,
                'type' => $this->type,
                'body' => ['query' => ['term' => $query]],
            ];

            return $client->search($params);
        } catch (\Exception $exception) {
            $this->logger->error('SEARCH elasticSearch is error' . $exception->getMessage());
        }
    }

    public function delete()
    {
        try {
            $client = $this->client();
            $param = [
                'index' => $this->index,
                'type' => $this->type,
                'id' => $this->id,
            ];

            return $client->delete($param);
        } catch (\Exception $exception) {
            $this->logger->error('DELETE elasticSearch is error' . $exception->getMessage());
        }
    }

    /**
     * 知道当前索引配置参数.
     * @param array $index = ['index','index1']
     * @return array
     */
    public function getSettings(array $index)
    {
        try {
            $client = $this->client();

            $params = ['index' => $index];

            return $client->indices()->getSettings($params);
        } catch (\Exception $exception) {
            $this->logger->error('elasticSearch getSetting is error' . $exception->getMessage());
            return [];
        }
    }

    /**
     * 获取单一文档.
     * @return array
     */
    public function get()
    {
        try {
            $client = $this->client();

            $params = [
                'index' => $this->index,
                'type' => $this->type,
                'id' => $this->id,
            ];

            return $client->get($params);
        } catch (\Exception $exception) {
            $this->logger->error('elasticSearch get is error' . $exception->getMessage());
        }
    }

    /**
     * 'body' => ['script' => 'ctx._source.counter += count','params' => ['count' => 4],.
     *
     * @return array
     */
    public function update()
    {
        try {
            $client = $this->client();

            $params = [
                'index' => $this->index,
                'type' => $this->type,
                'id' => $this->id,
            ];

            return $client->update($params);
        } catch (\Exception $exception) {
            $this->logger->error('elasticSearch update is error' . $exception->getMessage());
        }
    }
}
