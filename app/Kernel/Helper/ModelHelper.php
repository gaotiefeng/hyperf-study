<?php


namespace App\Kernel\Helper;


use Hyperf\Database\Model\Builder;

class ModelHelper
{
    public static function pagination(Builder $builder, $offset = 0, $limit = 10)
    {
        $count = $builder->count();

        $items = $builder->offset($offset)->limit($limit)->get();

        return[$count,$items];
    }

    public static function query(Builder $builder, $offset = 0, $limit = 10)
    {
        return $builder->offset($offset)->limit($limit)->get();
    }

}
