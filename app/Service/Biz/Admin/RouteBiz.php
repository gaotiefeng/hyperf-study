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

namespace App\Service\Biz\Admin;

use App\Service\Dao\RouteDao;
use App\Service\Service;
use Hyperf\Di\Annotation\Inject;

class RouteBiz extends Service
{
    /**
     * @Inject()
     * @var RouteDao
     */
    protected $dao;

    public function list()
    {

    }

    public function save(array $data)
    {
        echo 111;
        var_dump($data);
        return $this->dao->save($data);
    }
}
