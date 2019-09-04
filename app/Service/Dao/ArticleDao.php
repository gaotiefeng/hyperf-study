<?php


namespace App\Service\Dao;


use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Kernel\Helper\ModelHelper;
use App\Model\Article;
use App\Model\ArticleUser;
use App\Service\Service;
use Hyperf\DbConnection\Db;

class ArticleDao extends Service
{
    public function first(int $articleId, bool $throw = false)
    {
        $model = Article::query()->find($articleId);

        if($throw && !empty($model)) {
            throw new BusinessException(ErrorCode::ARTICLE_NO_EXIST);
        }

        return $model;
    }
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

    public function likes($userId, $articleId)
    {
        Db::beginTransaction();
        try{
            /** @var Article $model */
            $model = $this->first($articleId,true);
            $model = $model->likes + 1;
            $model->save();

            $articleUser = new ArticleUser();
            $articleUser->user_id = $userId;
            $articleUser->article_id = $articleId;
            $articleUser->save();

            Db::commit();
        }catch (\Throwable $e){
            Db::rollBack();
            return false;
        }
        return true;
    }
}
