<?php

declare(strict_types=1);

namespace App\Controller\Web;


use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Exception\BusinessException;
use App\Job\SmsJob;
use App\Untils\Captcha;
use App\Untils\SmsRedis;
use Hyperf\Di\Annotation\Inject;

class SmsController extends Controller
{
    /**
     * @Inject()
     * @var Captcha
     */
    protected $captcha;

    public function send()
    {
        $captchaCode = $this->request->input('code');
        $mobile = $this->request->input('mobile');
        $code = rand(100000,999999);

        if(! $this->captcha->check($captchaCode,$code)) {
            throw new BusinessException(ErrorCode::CAPTCHA_NO_EXIST);
        }

        di()->get(SmsRedis::class)->set($mobile,$code);

        //queue_push(new SmsJob($mobile,$code),200);

        return $this->response->success();
    }
}
