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

namespace App\Service\Biz\Web;

use App\Model\Article;
use App\Service\Dao\ArticleDao;
use App\Service\Dao\ArticleUserDao;
use App\Service\Formatter\ArticleFormatter;
use App\Service\Search\ElasticSearch;
use App\Service\Service;
use Hyperf\Di\Annotation\Inject;

class ArticleBiz extends Service
{
    /**
     * @Inject
     * @var ArticleDao
     */
    protected $dao;

    /**
     * @Inject
     * @var ArticleUserDao
     */
    protected $articleUserDao;

    /**
     * @param array $data
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function list(array $data, $offset = 0, $limit = 10)
    {
        [$count,$items] = $this->dao->index($data, $offset, $limit);

        $result = [];
        foreach ($items as $key => $val) {
            $result[] = ArticleFormatter::instance()->base($val);
        }

        return [$count, $result];
    }

    /**
     * @param $userId
     * @param $articleId
     * @return bool
     */
    public function likes($userId, $articleId)
    {
        $this->articleUserDao->exist($userId, $articleId);

        return $this->dao->likes($userId, $articleId);
    }

    /**
     * @param int $userId
     * @param array $data
     * @return Article
     */
    public function save(int $userId, array $data)
    {
        /** @var Article $model */
        $model = $this->dao->save($userId, $data);

        $data['id'] = $model->id;
        $data['user_id'] = $userId;

        di()->get(ElasticSearch::class)->create('gin', 'article', $model->id, $data);

        $es = di()->get(ElasticSearch::class)->search('gin', 'article', 0, 20);

        var_dump($es);

        return $model;
    }
}
