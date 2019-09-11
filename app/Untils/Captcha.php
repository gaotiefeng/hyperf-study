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

namespace App\Untils;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;

class Captcha
{
    /**
     * @Inject
     * @var Redis
     */
    protected $redis;

    protected $captcha = 'captcha';

    /**
     * @param $code
     * @param int $num
     * @param int $width
     * @param int $height
     * @return CaptchaBuilder
     */
    public function generate($code, $num = 4, $width = 70, $height = 200)
    {
        $parse = new PhraseBuilder(4, '123456789');
        $build = new CaptchaBuilder(null, $parse);
        $build->setDistortion(false);
        $build->setBackgroundColor(28, 223, 241);
        $build->setTextColor(255, 64, 64);
        $build->build($width, $height);
        $captcha = $build->getPhrase();

        $this->redis->set($this->captcha . $code, $captcha, 60);

        return $build;
    }

    public function set($code)
    {
        $this->redis->set($this->captcha . $code, $code, 120);
    }

    public function check($code, $cap)
    {
        if (empty($cap)) {
            return false;
        }
        $redisCaptcha = $this->redis->get($this->captcha . $code);

        if ($redisCaptcha != $cap) {
            return false;
        }

        return true;
    }
}
