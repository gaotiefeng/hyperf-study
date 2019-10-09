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

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Service\Biz\Admin\RouteBiz;
use Hyperf\Di\Annotation\Inject;

class RouteController extends Controller
{
    /**
     * @Inject
     * @var RouteBiz
     */
    protected $biz;


    public function index()
    {
    }

    public function save()
    {
        $input = $this->request->all();

        $result = $this->biz->save($input);

        return $this->response->success($result);
    }
}
