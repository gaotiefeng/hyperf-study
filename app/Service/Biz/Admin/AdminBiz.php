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

use App\Service\Dao\AdminDao;
use App\Service\Formatter\admin\AdminFormatter;
use App\Service\Service;
use Hyperf\Di\Annotation\Inject;

class AdminBiz extends Service
{
    /**
     * @Inject
     * @var AdminDao
     */
    protected $dao;

    public function index($offset, $limit)
    {
        $result = [];
        [$count, $items] = $this->dao->index($offset, $limit);
        $result['count'] = $count;

        $data = [];
        foreach ($items as $item) {
            $data[] = AdminFormatter::instance()->base($item);
        }
        $result['items'] = $data;

        return $result;
    }

    /**
     * @param int $id
     * @return int|mixed
     */
    public function delete(int $id)
    {
        return $this->dao->delete($id);
    }
}
