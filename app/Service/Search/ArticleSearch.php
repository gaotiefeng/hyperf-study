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
        $query = [
            'title' => "nihao"
        ];

        $result = $this->search($query);

        $arr['total'] = $result['hits']['total'];
        $arr['items'] = $result['hits']['hits'];

        return $arr;
    }

    public function articleDelete()
    {

    }
}
