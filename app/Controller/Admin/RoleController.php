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
use App\Service\Biz\Admin\RoleBiz;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class RoleController extends Controller
{
    /**
     * @Inject
     * @var RoleBiz
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

        $result = $this->biz->list($data);

        return $this->response->success($result);
    }

    public function save()
    {
        $input = $this->request->all();

        $message = [
            'name.required' => '名称必填',
            'name.max' => '名称不能超过32长度',
        ];
        $validation = $this->validationFactory->make($input, [
            'name' => 'required | max:32',
        ], $message);

        if ($validation->fails()) {
            throw  new BusinessException(ErrorCode::SERVER_ERROR, $validation->errors()->first());
        }
        $data = $validation->validated();

        $result = $this->biz->save($data);

        return $this->response->success($result);
    }
}
