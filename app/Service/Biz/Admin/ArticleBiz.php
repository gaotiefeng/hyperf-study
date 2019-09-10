<?php


namespace App\Service\Biz\Admin;


use App\Service\Dao\ArticleDao;
use App\Service\Service;
use Hyperf\Di\Annotation\Inject;

class ArticleBiz extends Service
{
    /**
     * @Inject()
     * @var ArticleDao
     */
    protected $dao;

    public function index($data)
    {
        return $this->dao->index($data, $data['offset'], $data['limit']);
    }
}
