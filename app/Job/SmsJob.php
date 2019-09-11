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

namespace App\Job;

use App\Service\Client\Sms;
use Hyperf\AsyncQueue\Job;

class SmsJob extends Job
{
    public $mobile;

    public $code;

    public function __construct($mobile, $code)
    {
        // 这里最好是普通数据，不要使用携带 IO 的对象，比如 PDO 对象
        $this->mobile = $mobile;
        $this->code = $code;
    }

    public function handle()
    {
        // 根据参数处理具体逻辑
        return di()->get(Sms::class)->sendSms($this->mobile, $this->code);
    }
}
