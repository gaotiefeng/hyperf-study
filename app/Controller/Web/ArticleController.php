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

namespace App\Controller\Web;

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Service\Biz\Web\ArticleBiz;
use App\Untils\JwtAuth;
use Hyperf\Di\Annotation\Inject;
use Inhere\Validate\Validation;

class ArticleController extends Controller
{
    /**
     * @Inject
     * @var ArticleBiz
     */
    protected $biz;

    /**
     * 列表.
     * @return array
     */
    public function list()
    {
        $input = $this->request->all();
        $validator = Validation::check($input, [
            [['offset', 'limit'], 'required', 'filter' => 'integer'],
        ]);
        if (! $validator->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR, $validator->firstError());
        }
        $data = $validator->getSafeData();

        $offset = $validator->get('offset') ?? null;
        $limit = $validator->get('limit');

        [$count,$items] = $this->biz->list($data, $offset, $limit);

        return $this->response->success([
            'count' => $count,
            'items' => $items,
        ]);
    }

    public function likes()
    {
        $articleId = $this->request->input('article_id');

        if (empty($articleId)) {
            throw new BusinessException(ErrorCode::ARTICLE_NO_EXIST);
        }
        $userId = JwtAuth::instance()->build()->getUserId();

        $result = $this->biz->likes($userId, $articleId);

        return $this->response->success($result);
    }
}
