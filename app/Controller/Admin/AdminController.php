<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Controller;
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
}
