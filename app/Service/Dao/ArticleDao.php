<?php


namespace App\Service\Dao;


use App\Kernel\Helper\ModelHelper;
use App\Model\Article;
use App\Service\Service;

class ArticleDao extends Service
{
    /**
     * @param array $data
     * @param int $offset
     * @param int $limit
     * @return ModelHelper[]|\Hyperf\Database\Model\Collection
     */
    public function index(array $data, $offset = 0, $limit = 10)
    {
        $query = Article::query();

        if($title = $data['title'] ?? null) {
            $query->where('title','like',$title);
        }

        return ModelHelper::pagination($query, $offset, $limit);
    }
}
