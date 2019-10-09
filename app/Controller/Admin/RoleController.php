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
use App\Service\Biz\Admin\RoleBiz;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class RoleController extends Controller
{
    /**
     * @Inject
     * @var RoleBiz
     */
    protected $biz;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    public function save()
    {
        $input = $this->request->all();

        $result = $this->biz->save($input);

        return $this->response->success($result);
    }
}
