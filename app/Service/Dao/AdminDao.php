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
use App\Model\Admin;
use App\Service\Service;

class AdminDao extends Service
{
    /**
     * @param int $id
     * @param bool $throw
     * @return null|Admin
     */
    public function first(int $id, bool $throw = false)
    {
        $model = Admin::query()->find($id);

        if ($throw && empty($model)) {
            throw new BusinessException(ErrorCode::ADMIN_NOT_EXITS);
        }

        return $model;
    }

    /**
     * @param $mobile
     * @param bool $throw
     * @return null|Model|object
     */
    public function mobile($mobile, bool $throw = false)
    {
        $model = Admin::query()->where('mobile', '=', $mobile)->first();

        if ($throw && empty($model)) {
            throw new BusinessException(ErrorCode::ADMIN_NOT_EXITS);
        }

        return $model;
    }

    /**
     * @param $userId
     * @return null|Model
     */
    public function info($userId)
    {
        return $this->first($userId, true);
    }
}
