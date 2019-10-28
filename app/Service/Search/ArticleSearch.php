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

class ArticleSearch extends ElasticSearch
{
    protected $index = 'article';

    protected $type = 'index';

    protected $id;

    public function articleAdd(array $data)
    {
        $this->id = $data['id'];

        return $this->create($data);
    }

    public function articleSearch()
    {
        $params = [
            'index' => 'article',
            'type' => 'index',
            'body' => [
                'query' => [
                    'match' => [
                        'content' => '你选的吗',
                    ],
                ],
            ],
        ];
        return $this->search($params);
        /*$milliseconds = $results['took'];
        $maxScore     = $results['hits']['max_score'];

        $score = $results['hits']['hits'][0]['_score'];
        $doc   = $results['hits']['hits'][0]['_source'];*/
    }
}
