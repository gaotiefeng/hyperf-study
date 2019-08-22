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

namespace App\Service\Biz\Web;

use App\Constants\Constants;
use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\User;
use App\Service\Dao\UserDao;
use App\Service\Formatter\UserFormatter;
use App\Service\Service;
use App\Untils\JwtAuth;
use Hyperf\Di\Annotation\Inject;

class UserBiz extends Service
{
    /**
     * @Inject
     * @var UserDao
     */
    protected $dao;

    public function userLogin($mobile, $password)
    {
        $model = User::query()->where(['mobile' => $mobile, 'password' => $password])->first();

        if (empty($model)) {
            throw new BusinessException(ErrorCode::USER_NOT_EXIST);
        }

        $result['token'] = JwtAuth::instance()->init($model->id)->getToken();

        return $result;
    }

    /**
     * @param $mobile
     * @param $password
     * @return bool
     */
    public function register($mobile, $password)
    {
        $options = Constants::options;
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        return $this->dao->register($mobile, $password);
    }

    /**
     * @param $userId
     * @return array
     */
    public function userInfo($userId)
    {
        $item = $this->dao->first($userId, true);

        return UserFormatter::instance()->base($item);
    }
}
