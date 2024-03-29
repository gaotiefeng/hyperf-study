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
use App\Request\admin\RouteRequest;
use App\Service\Biz\Admin\RouteBiz;
use App\Service\Cache\RouteCache;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class RouteController extends Controller
{
    /**
     * @Inject
     * @var RouteBiz
     */
    protected $biz;

    /**
     * @Inject(required=false)
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    public function index()
    {
        $input = $this->request->all();

        $message = [
            'offset.required' => '偏移量不能为空',
            'limit.required' => '条数不能空并且为整数',
        ];
        $validation = $this->validationFactory->make($input, [
            'offset' => 'required | integer',
            'limit' => 'required | integer',
        ], $message);

        if ($validation->fails()) {
            throw  new BusinessException(ErrorCode::SERVER_ERROR, $validation->errors()->first());
        }

        $data = $validation->validated();

        $offset = $data['offset'];
        $limit = $data['limit'];

        $result = $this->biz->list($offset, $limit);

        return $this->response->success($result);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function save(RouteRequest $request)
    {
        $data = $request->all();

        $result = $this->biz->save($data);

        return $this->response->success($result);
    }

    public function delete()
    {
        $id = $this->request->input('id');

        if (empty($id)) {
            throw new BusinessException(ErrorCode::Router_NO_EXIST);
        }

        $result = $this->biz->delete($id);

        return $this->response->success($result);
    }

    public function all()
    {
        $result = di()->get(RouteCache::class)->getRoute();

        return $this->response->success($result);
    }
}
