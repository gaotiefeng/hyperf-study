<?php


namespace App\Service\Biz\Web;


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

    public function list()
    {
        $result = $this->dao->index();

        return $result;
    }
}
