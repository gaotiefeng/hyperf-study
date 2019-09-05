<?php


namespace App\Service\Client;


use App\Service\Service;
use Overtrue\EasySms\EasySms;

class Sms   extends  Service
{
    protected $config = [
            // HTTP 请求的超时时间（秒）
        'timeout' => 5.0,
            // 默认发送配置
        'default' => [
            // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
            // 默认可用的发送网关
        'gateways' => [

            ],
        ],
        // 可用的网关配置
        'gateways' => [

        ],
        ];
    public function sendSms($mobile, $code)
    {
        $easySms = new EasySms($this->config);

        $easySms->send($mobile, [
            'content'  => '您的验证码为: ',
            'template' => 'SMS_001',
            'data' => [
                'code' => $code
            ],
        ]);
    }
}
