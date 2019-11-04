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
use App\Service\Formatter\admin\RouteFormatter;
use App\Service\Service;
use Hyperf\Di\Annotation\Inject;

class RouteBiz extends Service
{
    /**
     * @Inject
     * @var RouteDao
     */
    protected $dao;

    /**
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function list($offset, $limit)
    {
        [$count,$items] = $this->dao->index($offset, $limit);

        $result['count'] = $count;
        foreach ($items as $k => $item) {
            $result['items'][$k] = RouteFormatter::instance()->base($item);
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function save(array $data)
    {
        return $this->dao->save($data);
    }

    /**
     * @return int|mixed
     */
    public function delete(int $id)
    {
        return $this->dao->delete($id);
    }
}
