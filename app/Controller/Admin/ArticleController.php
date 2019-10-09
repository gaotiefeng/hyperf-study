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

namespace App\Controller\Admin;

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Service\Biz\Admin\ArticleBiz;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class ArticleController extends Controller
{
    /**
     * @Inject
     * @var ArticleBiz
     */
    protected $biz;

    /**
     * @Inject
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    public function index()
    {
        $input = $this->request->all();

        $message = [
            'offset.required' => '偏移量不能为空',
            'limit.required' => '条数不能空并且为整数',
        ];
        $validation = $this->validationFactory->make($input, [
            'offset' => 'required | integer',
            'limit' => 'required | integer',
        ], $message);

        if ($validation->fails()) {
            throw  new BusinessException(ErrorCode::SERVER_ERROR, $validation->errors()->first());
        }

        $data = $validation->validated();

        $result = $this->biz->index($data);

        return $this->response->success($result);
    }

    public function info()
    {
        $id = $this->request->input('id');

        if (empty($id)) {
            throw new BusinessException(ErrorCode::ARTICLE_NO_EXIST);
        }
        $result = $this->biz->info($id);

        return $this->response->success($result);
    }
}
