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
     * @return null|User
     */
    public function first($userId)
    {
        $model = User::query()->find($userId);

        if (empty($model)) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        return $model;
    }
}
