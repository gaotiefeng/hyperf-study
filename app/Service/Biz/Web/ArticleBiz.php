<?php


namespace App\Service\Biz\Web;


use App\Model\Article;
use App\Model\ArticleUser;
use App\Service\Dao\ArticleDao;
use App\Service\Dao\ArticleUserDao;
use App\Service\Formatter\ArticleFormatter;
use App\Service\Service;
use Hyperf\Di\Annotation\Inject;

class ArticleBiz extends Service
{
    /**
     * @Inject()
     * @var ArticleDao
     */
    protected $dao;

    /**
     * @Inject()
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
        foreach ($items as $key => $val){
            $result[] = ArticleFormatter::instance()->base($val);
        }

        return [$count,$result];
    }

    public function likes($userId, $articleId)
    {
        $this->articleUserDao->exist($userId, $articleId);

        return $this->dao->likes($userId, $articleId);
    }
}
