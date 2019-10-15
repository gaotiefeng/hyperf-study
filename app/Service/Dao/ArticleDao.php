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

namespace App\Service\Dao;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Kernel\Helper\ModelHelper;
use App\Model\Article;
use App\Model\ArticleUser;
use App\Service\Service;
use Hyperf\Database\Model\Collection;
use Hyperf\DbConnection\Db;
use Hyperf\Snowflake\IdGeneratorInterface;
use Throwable;

class ArticleDao extends Service
{
    /**
     * @param int $articleId
     * @param bool $throw
     * @return null|Model
     */
    public function first(int $articleId, bool $throw = false)
    {
        $model = Article::query()->find($articleId);

        if ($throw && empty($model)) {
            throw new BusinessException(ErrorCode::ARTICLE_NO_EXIST);
        }

        return $model;
    }

    /**
     * @param array $data
     * @param int $offset
     * @param int $limit
     * @return Collection|ModelHelper[]
     */
    public function index(array $data, $offset = 0, $limit = 10)
    {
        $query = Article::query();

        if ($title = $data['title'] ?? null) {
            $query->where('title', 'like', $title);
        }

        return ModelHelper::pagination($query, $offset, $limit);
    }

    public function info(int $id)
    {
        return $this->first($id, true);
    }

    /**
     * @param $userId
     * @param $articleId
     * @return bool
     */
    public function likes($userId, $articleId)
    {
        Db::beginTransaction();
        try {
            /** @var Article $model */
            $model = $this->first($articleId, true);
            $model = $model->likes + 1;
            $model->save();

            $articleUser = new ArticleUser();
            $articleUser->user_id = $userId;
            $articleUser->article_id = $articleId;
            $articleUser->save();

            Db::commit();
        } catch (Throwable $e) {
            Db::rollBack();
            return false;
        }
        return true;
    }

    /**
     * @param int $userId
     * @param array $data
     * @return Article
     */
    public function save(int $userId, array $data)
    {
        $article = new Article();
        $article->id = di()->get(IdGeneratorInterface::class)->generate();
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->user_id = $userId;
        $article->save();

        return $article;
    }
}
