<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\Controller;
use App\Service\Biz\Web\ArticleBiz;
use Hyperf\Di\Annotation\Inject;

class ArticleController extends Controller
{
    /**
     * @Inject()
     * @var ArticleBiz
     */
    protected $biz;
    public function list()
    {
        $input = $this->request->all();
        $offset = $this->request->input('offset');
        $limit = $this->request->input('limit');

        $result = $this->biz->list();

        return $this->response->success($result);
    }
}
