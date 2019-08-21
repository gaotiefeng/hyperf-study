<?php


namespace App\Service\Formatter;


use App\Model\User;
use App\Service\Service;

class UserFormatter extends Formatter
{
    public function base(User $model)
    {
        $result = [
            'id' => $model->id,
            'mobile' => $model->mobile,
            'password' => $model->password,
        ];

        return  $result;
    }
}
