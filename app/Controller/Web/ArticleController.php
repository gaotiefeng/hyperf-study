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
use App\Untils\JwtAuth;
use Hyperf\CircuitBreaker\Annotation\CircuitBreaker;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\RateLimit\Annotation\RateLimit;
use Inhere\Validate\Validation;

/**
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="rate-limit")
 * @RateLimit(limitCallback={ArticleController::class, "limitCallback"})
 */
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
     *点赞.
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
     * 添加文章.
     * @param [ 'title'=> , 'content' => ]
     * @return array
     *               [ 'code' => 0 , 'data' => true ]
     */
    public function save()
    {
        $input = $this->request->all();

        $userId = JwtAuth::instance()->build()->getUserId();

        $validation = Validation::check($input, [
            [['title', 'content'], 'required'],
        ]);

        if (! $validation->isOk()) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        $data = $validation->safeData();

        $result = $this->biz->save($userId, $data);

        return $this->response->success($result);
    }

    /**
     * @RequestMapping(path="test")
     * @RateLimit(create=2, capacity=4)
     */
    public function test()
    {
        $userId = 1;
        $data = [
            'title' => '北洋水师因何灰飞烟灭',
            'content' => '据新华社9月2日报道，历经两个月的水下考古调查，基本确认了北洋水师旗舰定远舰的沉没位置，并出水一批沉舰遗物。',
        ];

        $this->biz->save($userId, $data);
    }

    public static function limitCallback(float $seconds, ProceedingJoinPoint $proceedingJoinPoint)
    {
        return true;
        // $seconds 下次生成Token 的间隔, 单位为秒
        // $proceedingJoinPoint 此次请求执行的切入点
        // 可以通过调用 `$proceedingJoinPoint->process()` 继续执行或者自行处理
        //return $proceedingJoinPoint->process();
    }

    /**
     * @CircuitBreaker(timeout="0.05", failCounter=1, successCounter=1, fallback="App\Controller\Web\Article::circuitFallback")
     */
    public function circuitTest()
    {
        $userId = 1;
        $data = [
            'title' => '希望你继续做好红色基因的传承人',
            'content' => '习近平总书记16日下午在鄂豫皖苏区首府革命博物馆同当地红军后代、烈士家属代表交谈，红军后代黄德耀激动地紧紧握住总书记的手，
            介绍了自己的革命家史。
            他的外祖母晏春山被捕后受尽了酷刑，最后高呼“中国共产党万岁”，纵身跳下了悬崖，被誉为大别山的“江姐”。',
        ];

        $this->biz->save($userId, $data);
    }

    public function circuitFallback()
    {
        return ['circuit'];
    }
}
