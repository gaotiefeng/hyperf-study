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

use App\Constants\Constants;
use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Service\Biz\Admin\UserBiz;
use Hyperf\Di\Annotation\Inject;
use Inhere\Validate\Validation;

class UserController extends Controller
{
    /**
     * @Inject
     * @var UserBiz
     */
    protected $biz;

    /**
     * 登录.
     */
    public function login()
    {
//        $options = Constants::options;
//        var_dump($password = password_hash('111111', PASSWORD_BCRYPT, $options));

        $input = $this->request->all();

        $validator = Validation::check($input, [
            ['mobile', 'regexp', '/^1\d{10}$/'],
            ['password', 'required', 'filter' => 'string'],
        ]);

        if (! $validator->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR, $validator->firstError());
        }

        $data = $validator->getSafeData();

        $result = $this->biz->login($data);

        return $this->response->success($result);
    }

    public function info()
    {
        $userId = 1;

        $result = $this->biz->adminInfo($userId);

        return $this->response->success($result);
    }
}
