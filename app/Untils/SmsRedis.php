<?php


namespace App\Untils;

use Hyperf\Redis\Redis;

class SmsRedis
{
    protected $mobileKey = 'mobile';

    public function set($mobile, $code)
    {
        di()->get(Redis::class)->set($this->mobileKey.$mobile,$code,120);
    }

    public function check($mobile, $code)
    {
        if(empty($code)) {
            return false;
        }
        $redis = di()->get(Redis::class);
        $redisCode = $redis->get($this->mobileKey.$mobile);

        if($redisCode !== $code) {
            return false;
        }

        return true;
    }
}
