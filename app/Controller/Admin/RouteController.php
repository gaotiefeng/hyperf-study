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

namespace App\Controller\admin;

use App\Controller\Controller;

class RouteController extends Controller
{
    public function index()
    {
    }

    public function save()
    {
        $input = $this->request->all();
    }
}
