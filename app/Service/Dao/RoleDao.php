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

use App\Kernel\Helper\ModelHelper;
use App\Model\Role;
use App\Service\Service;

class RoleDao extends Service
{
    public function index(array $data)
    {
        $query = Role::query();

        return ModelHelper::pagination($query, $data['offset'], $data['limit']);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function save(array $data)
    {
        $model = new Role();
        $model->name = $data['name'];

        return $model->save();
    }
}
