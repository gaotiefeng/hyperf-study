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

namespace App\Controller\Web;

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Service\Biz\Web\ArticleBiz;
use App\Service\Search\ElasticSearch;
use App\Untils\JwtAuth;
use Hyperf\Di\Annotation\Inject;
use Inhere\Validate\Validation;

class ArticleController extends Controller
{
    /**
     * @Inject
     * @var ArticleBiz
     */
    protected $biz;

    /**
     * 列表.
     * @return array
     */
    public function list()
    {
        $input = $this->request->all();
        $validator = Validation::check($input, [
            [['offset', 'limit'], 'required', 'filter' => 'integer'],
        ]);
        if (! $validator->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR, $validator->firstError());
        }
        $data = $validator->getSafeData();

        $offset = $validator->get('offset') ?? null;
        $limit = $validator->get('limit');

        [$count,$items] = $this->biz->list($data, $offset, $limit);

        return $this->response->success([
            'count' => $count,
            'items' => $items,
        ]);
    }

    /**
     *点赞
     */
    public function likes()
    {
        $articleId = $this->request->input('article_id');

        if (empty($articleId)) {
            throw new BusinessException(ErrorCode::ARTICLE_NO_EXIST);
        }
        $userId = JwtAuth::instance()->build()->getUserId();

        $result = $this->biz->likes($userId, $articleId);

        return $this->response->success($result);
    }

    /**
     * 添加文章
     * @param [ 'title'=> , 'content' => ]
     * @return array
     * [ 'code' => 0 , 'data' => true ]
     */
    public function save()
    {
        $input = $this->request->all();

        $userId = JwtAuth::instance()->build()->getUserId();

        $validation = Validation::check($input,[
            [['title','content'], 'required']
        ]);

        if(! $validation->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        $data = $validation->safeData();

        $result = $this->biz->save($userId, $data);

        return $this->response->success($result);
    }

    public function test()
    {
        $userId = 1;
        $data = [
            'title'=> '北洋水师因何灰飞烟灭',
            'content' => '
据新华社9月2日报道，历经两个月的水下考古调查，基本确认了北洋水师旗舰定远舰的沉没位置，并出水一批沉舰遗物。北洋水师自1888年组建后，迅速成为号称“亚洲第一”的海上军事力量。然而，仅仅成军不到7年，这支海军便在甲午海战中遭遇全军覆灭的命运，其境遇与本届篮球世界杯刚刚遭遇重大打击的中国男篮颇有相似之处。那么北洋水师因何辉煌过后迅速陨落，真实的定远舰又在甲午战争中发挥了多大作用，本期《出鞘》我们就来回顾这段历史',
        ];

        $this->biz->save($userId,$data);
    }
}
