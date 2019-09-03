<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Service\Biz\Web\ArticleBiz;
use Hyperf\Di\Annotation\Inject;
use Inhere\Validate\Valid;
use Inhere\Validate\Validation;

class ArticleController extends Controller
{
    /**
     * @Inject()
     * @var ArticleBiz
     */
    protected $biz;

    /**
     * 列表
     * @return array
     */
    public function list()
    {
        $input = $this->request->all();
        $validator = Validation::check($input, [
            [['offset','limit'], 'required', 'filter' => 'integer'],
        ]);
        if(! $validator->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR, $validator->firstError());
        }
        $data = $validator->getSafeData();

        $offset = $validator->get('offset') ?? null;
        $limit = $validator->get('limit');

        [$count,$items] = $this->biz->list($data, $offset, $limit);

        return $this->response->success([
            'count' => $count,
            'items' => $items
        ]);
    }
}
