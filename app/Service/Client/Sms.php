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

namespace App\Service\Client;

use App\Service\Service;
use Hyperf\Config\Annotation\Value;
use Hyperf\Contract\ConfigInterface;
use Overtrue\EasySms\EasySms;

class Sms extends Service
{
    /**
     * @Value(key="sms")
     * @var array
     */
    protected $config;

    public function sendSms($mobile, $code)
    {
        /*        $this->config = $this->container->get(ConfigInterface::class);

                $config = $this->config->get('sms');*/

        $easySms = new EasySms($this->config);

        $easySms->send($mobile, [
            'template' => '',
            'data' => [
                'code' => '验证码:' . $code,
            ],
        ]);
    }
}
