<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Service\Biz\Admin\ArticleBiz;
use Hyperf\Di\Annotation\Inject;
use Inhere\Validate\Validation;

class ArticleController extends Controller
{
    /**
     * @Inject()
     * @var ArticleBiz
     */
    protected $biz;

    public function index()
    {
        $input = $this->request->all();

        $validation = Validation::check($input,[
            [['offset','limit'], 'required', 'filter'=>'integer'],
        ]);

        if(!$validation->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }
        $data = $validation->getSafeData();

        $result = $this->biz->index($data);

        return $this->response->success($result);
    }
}
