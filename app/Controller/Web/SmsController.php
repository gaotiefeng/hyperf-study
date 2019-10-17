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
use App\Job\SmsJob;
use App\Service\Client\Sms;
use App\Untils\Captcha;
use App\Untils\SmsRedis;
use Hyperf\Di\Annotation\Inject;

class SmsController extends Controller
{
    /**
     * @Inject
     * @var Captcha
     */
    protected $captcha;

    public function send()
    {

        $captchaCode = $this->request->input('code',1234);
        $mobile = $this->request->input('mobile');
        $code = rand(100000, 999999);

        /*if (! $this->captcha->check($captchaCode, $code)) {
            throw new BusinessException(ErrorCode::CAPTCHA_NO_EXIST);
        }*/

        di()->get(SmsRedis::class)->set($mobile, $code);

        queue_push(new SmsJob($mobile,$code),1);

        return $this->response->success();
    }
}
