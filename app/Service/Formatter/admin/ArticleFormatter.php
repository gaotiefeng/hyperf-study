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

namespace App\Service\Formatter\admin;

use App\Model\Article;
use App\Service\Formatter\Formatter;
use App\Service\Formatter\UserFormatter;

class ArticleFormatter extends Formatter
{
    public function base(Article $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'content' => $model->content,
            'likes' => $model->likes,
            'page_views' => $model->page_views,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

    public function detail(Article $model, $user = null)
    {
        $result = $this->base($model);

        $result['user'] = UserFormatter::instance()->base($user);

        return $result;
    }
}
