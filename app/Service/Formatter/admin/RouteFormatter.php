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

namespace App\Service\Formatter\admin;

use App\Model\Route;
use App\Service\Formatter\Formatter;

class RouteFormatter extends Formatter
{
    public function base(Route $model)
    {
        return [
            'id' => $model->id,
            'route' => $model->route,
            'name' => $model->name,
            'created_at' => $model->created_at,
        ];
    }
}
