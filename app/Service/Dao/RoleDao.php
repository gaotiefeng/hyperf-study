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
use App\Kernel\Helper\ModelHelper;
use App\Model\Role;
use App\Model\RoleRoute;
use App\Service\Service;
use Hyperf\DbConnection\Db;

class RoleDao extends Service
{
    public function index(array $data)
    {
        $query = Role::query();

        return ModelHelper::pagination($query, $data['offset'], $data['limit']);
    }

    /**
     * @return Role
     */
    public function save(array $data)
    {
        Db::beginTransaction();
        try {
            $model = new Role();
            $model->name = $data['name'];

            $model->save();

            $roleRoute = new RoleRoute();
            $roleRoute->role_id = $model->id;
            $roleRoute->route_id = $data['route_id'];

            $roleRoute->save();
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            $this->logger->error('role add' . $e->getMessage());
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        return $model;
    }
}
