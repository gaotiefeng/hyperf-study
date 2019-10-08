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

namespace App\Controller\admin;

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class RoleController extends Controller
{
    /**
     * @Inject
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    public function index()
    {
    }

    public function save()
    {
        $input = $this->request->all();

        $validator = $this->validationFactory->make($input, [
            'name.required' => '名称必填',
        ]);

        if ($validator->fails()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR, $validator->errors()->first());
        }

        $data = $validator->validated();

        var_dump($data);

        return $this->response->success();
    }
}
