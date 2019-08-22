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
use App\Service\Biz\Web\UserBiz;
use App\Untils\Jwt;
use App\Untils\JwtAuth;
use Hyperf\Di\Annotation\Inject;
use Inhere\Validate\Validation;

class UserController extends Controller
{
    /**
     * @Inject
     * @var UserBiz
     */
    protected $biz;

    public function login()
    {
        $input = $this->request->all();

        $validator = Validation::check($input, [
            [['mobile'], 'required', 'safe', 'filter' => 'validator_mobile'],
            [['password'], 'string', 'required'],
        ]);

        if (! $validator->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        $mobile = $validator->get('mobile');
        $password = $validator->get('password');

        $result = $this->biz->userLogin($mobile, $password);

        return $this->response->success($result);
    }

    public function register()
    {
        $input = $this->request->all();

        $validator = Validation::check($input, [
            [['mobile'], 'required', 'safe', 'filter' => 'validator_mobile'],
            [['password'], 'string', 'required'],
        ]);

        if (! $validator->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        $mobile = $validator->get('mobile');
        $password = $validator->get('password');

        $result = $this->biz->register($mobile, $password);

        return $this->response->success($result);
    }

    /**
     * @return array
     */
    public function userInfo()
    {
        $userId = JwtAuth::instance()->build()->getUserId();

        if (empty($userId)) {
            throw new BusinessException(ErrorCode::USER_EXIST);
        }

        $result = $this->biz->userInfo($userId);

        return $this->response->success($result);
    }
}