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
        try {
            $client = $this->client();
            $params = [
                'index' => $this->index,
                'type' => $this->type,
                'body' => [
                    $this->type => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'integer'
                            ],
                            'title' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word'
                            ],
                            'content' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word'
                            ],
                            'user_id' => [
                                'type' => 'integer'
                            ]
                        ]
                    ]
                ]
            ];
            $client->indices()->putMapping($params);
        } catch (\Exception $exception) {
            $this->logger->error('DOC UPDATE elasticSearch is error' . $exception->getMessage());
            var_dump($exception->getMessage());
        }
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
                'body' => ['doc' => $data],
            ];

            $client->create($params);
        } catch (\Exception $exception) {
            $this->logger->error('DOC UPDATE elasticSearch is error' . $exception->getMessage());
            var_dump($exception->getMessage());
        }
    }

    //TODO Match 查询
    public function search(array $params)
    {
        try {
            $client = $this->client();

            /*$params = [
                'index' => $this->index,
                'type' => $this->type,
                'id' => $this->id,
                'body' => ['query' => ['match' => ['title' => '你知道']]],
                'size' => $offset,
                'from' => $limit,
            ];*/

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
            var_dump($exception->getMessage());
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
