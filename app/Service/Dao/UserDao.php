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

namespace App\Service\Dao;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\User;
use App\Service\Service;

class UserDao extends Service
{
    /**
     * @param $userId
     * @param $throw
     * @return null|User
     */
    public function first($userId, bool $throw = false)
    {
        $model = User::query()->find($userId);

        if ($throw && empty($model)) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        return $model;
    }

    /**
     * @param $mobile
     * @param $password
     * @return bool
     */
    public function register($mobile, $password)
    {
        $model = new User();

        $model->mobile = $mobile;
        $model->password = $password;

        return  $model->save();
    }
}
