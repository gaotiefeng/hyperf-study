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

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Service\Biz\Admin\RouteBiz;
use Hyperf\Di\Annotation\Inject;
use Inhere\Validate\Validation;

class RouteController extends Controller
{
    /**
     * @Inject
     * @var RouteBiz
     */
    protected $biz;


    public function index()
    {
        $input = $this->request->all();

        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        $result = $this->biz->list($offset, $limit);

        return $this->response->success($result);
    }

    public function save()
    {
        $input = $this->request->all();

        $validation = Validation::check($input,[

           [['name','icon','route'],'required'],

        ]);

        if(!$validation->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR,$validation->firstError());
        }

        $data = $validation->getSafeData();

        $result = $this->biz->save($data);

        return $this->response->success($result);
    }
}
