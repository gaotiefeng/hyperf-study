<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Service\Biz\Admin\AdminBiz;
use Hyperf\Di\Annotation\Inject;

class AdminController extends Controller
{
    /**
     * @Inject()
     * @var AdminBiz
     */
    protected $biz;
    
    public function index()
    {
        $input = $this->request->all();

        $offset = $this->request->input('offset',0);
        $limit = $this->request->input('limit', 10);


        $result = $this->biz->index($offset,$limit);

        return $this->response->success($result);
    }

    /**
     * @return int|mixed
     */
    public function delete()
    {
        $id = $this->request->input('id');

        if(empty($id)) {
            throw new BusinessException(ErrorCode::ADMIN_NOT_EXITS);
        }

        $result = $this->biz->delete($id);

        return $this->response->success($result);
    }
}
