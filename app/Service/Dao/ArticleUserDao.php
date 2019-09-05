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
use App\Model\ArticleUser;
use App\Service\Service;

class ArticleUserDao extends Service
{
    public function exist($articleId, $userId)
    {
        $model = ArticleUser::query()->where(['article_id' => $articleId, 'user_id' => $userId])->first();

        if (! empty($model)) {
            throw new BusinessException(ErrorCode::ARTICLE_USER_EXIST);
        }

        return $model;
    }
}
