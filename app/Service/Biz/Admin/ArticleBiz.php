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

use App\Model\Article;
use App\Service\Dao\ArticleDao;
use App\Service\Formatter\ArticleFormatter;
use App\Service\Service;
use Hyperf\Di\Annotation\Inject;

class ArticleBiz extends Service
{
    /**
     * @Inject
     * @var ArticleDao
     */
    protected $dao;

    public function index($data)
    {
        return $this->dao->index($data, $data['offset'], $data['limit']);
    }

    public function info($id)
    {
        $id = intval($id);
        /** @var Article $item */
        $item =  $this->dao->info($id);

        $result = ArticleFormatter::instance()->base($item);

        return $result;
    }
}
