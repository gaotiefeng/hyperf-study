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

namespace HyperfTest\Cases\Web;

use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class SmsTest extends HttpTestCase
{
    public function testWebSmsSend()
    {
        $res = $this->client->post('/sms/send', [
            'mobile' => '15904435047',
        ]);

        return $this->assertSame(0, $res['code']);
    }
}
