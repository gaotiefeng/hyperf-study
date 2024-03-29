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
use App\Model\Route;
use App\Service\Service;

class RouteDao extends Service
{
    /**
     * @return null|Model
     */
    public function first(int $id, bool $throw = false)
    {
        $model = Route::query()->find($id);

        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        return $model;
    }

    public function index($offset = 0, $limit = 10)
    {
        $query = Route::query();

        return ModelHelper::pagination($query, $offset, $limit);
    }

    /**
     * @return bool
     */
    public function save(array $data)
    {
        $model = new Route();
        $model->name = $data['name'];
        $model->icon = $data['icon'];
        $model->route = $data['route'];
        $model->method = $data['method'];
        $model->is_read = $data['read'];

        return $model->save();
    }

    /**
     * @return int|mixed
     */
    public function delete(int $id)
    {
        $this->first($id, true);

        return Route::query()->where('id', '=', $id)->delete();
    }
}
