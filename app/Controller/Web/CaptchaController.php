<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Untils\Captcha;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Arr;

class CaptchaController extends Controller
{
    /**
     * @Inject()
     * @var Captcha
     */
    protected $captcha;

    public function image()
    {
        $data = $this->request->all();
        $code = $this->request->input('code');

        if (empty($code)) {
            throw new BusinessException(ErrorCode::SERVER_ERROR);
        }

        $num = Arr::get($data, 'num', 4);
        $width = Arr::get($data, 'width', 70);
        $height = Arr::get($data, 'height', 40);
        $code = Arr::get($data, 'code', '');

        $build = $this->captcha->generate($code, $num, $width, $height);

        return $this->response->response()
            ->withHeader('Content-type', 'image/jpeg')
            ->withBody(new SwooleStream($build->get()));
    }
}
