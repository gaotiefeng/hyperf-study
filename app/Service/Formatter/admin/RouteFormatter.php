<?php


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
