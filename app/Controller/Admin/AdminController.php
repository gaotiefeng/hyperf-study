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
use App\Request\AdminRequest;
use App\Service\Biz\Admin\AdminBiz;
use App\Untils\AdminAuth;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class AdminController extends Controller
{
    /**
     * @Inject
     * @var AdminBiz
     */
    protected $biz;

    /**
     * @Inject
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    public function index()
    {
        $adminId = AdminAuth::instance()->build()->getUserId();

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

        $offset = $data['offset'];
        $limit = $data['limit'];

        $result = $this->biz->index($offset, $limit);

        return $this->response->success($result);
    }

    public function save(AdminRequest $request)
    {
        $input = $request->all();

        $result = $this->biz->save($input);

        return $this->response->success($result);
    }

    /**
     * @return int|mixed
     */
    public function delete()
    {
        $id = $this->request->input('id');

        if (empty($id)) {
            throw new BusinessException(ErrorCode::ADMIN_NOT_EXITS);
        }

        $result = $this->biz->delete($id);

        return $this->response->success($result);
    }
}
