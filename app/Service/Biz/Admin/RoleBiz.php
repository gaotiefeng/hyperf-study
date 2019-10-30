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

use App\Service\Dao\RoleDao;
use App\Service\Dao\RouteDao;
use App\Service\Formatter\admin\RoleFormatter;
use App\Service\Service;
use Hyperf\Di\Annotation\Inject;

class RoleBiz extends Service
{
    /**
     * @Inject(required=false)
     * @var RoleDao
     */
    protected $dao;

    public function list(array $data)
    {
        [$count, $items] = $this->dao->index($data);

        $result['count'] = $count;

        foreach ($items as $k => $item) {
            $result['items'][$k] = RoleFormatter::instance()->base($item);
        }

        return $result;
    }

    public function save(array $data)
    {
        di()->get(RouteDao::class)->first($data['route_id']);

        return $this->dao->save($data);
    }
}
