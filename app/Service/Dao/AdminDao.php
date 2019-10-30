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

use App\Constants\Constants;
use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Kernel\Helper\ModelHelper;
use App\Model\Admin;
use App\Model\AdminRole;
use App\Service\Service;
use Hyperf\DbConnection\Db;

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

        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::ADMIN_NOT_EXITS);
        }

        return $model;
    }

    public function index($offset, $limit)
    {
        $query = Admin::query();

        return ModelHelper::pagination($query, $offset, $limit);
    }

    public function save(array $data)
    {
        Db::beginTransaction();
        try {
            $model = new Admin();
            $model->user_name = $data['user_name'];
            $model->mobile = $data['mobile'];
            $options = Constants::options;
            $model->password = password_hash($data['password'], PASSWORD_BCRYPT, $options);
            $model->save();

            $adminRole = new AdminRole();
            $adminRole->role_id = $data['role_id'];
            $adminRole->admin_id = $model->id;
            $adminRole->save();
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            $this->logger->error('admin save ' . $e->getMessage());
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }
        return $model;
    }

    /**
     * @param $mobile
     * @param bool $throw
     * @param bool $is
     * @return null|\Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Model|object
     */
    public function mobile($mobile, bool $throw = false, $is = false)
    {
        $model = Admin::query()->where('mobile', '=', $mobile)->first();

        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::ADMIN_NOT_EXITS);
        }

        if (! empty($model) && $is) {
            throw new BusinessException(ErrorCode::ADMIN_EXITS);
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

    /**
     * @param int $id
     * @return int|mixed
     */
    public function delete(int $id)
    {
        return Admin::query()->where('id', '=', $id)->delete();
    }
}
