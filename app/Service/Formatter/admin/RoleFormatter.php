<?php


namespace App\Service\Formatter\admin;


use App\Model\Role;
use App\Service\Formatter\Formatter;

class RoleFormatter extends Formatter
{
    public function base(Role $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'created_at' => $model->created_at,
        ];
    }

}
