<?php


namespace HyperfTest\Cases\Web;


use HyperfTest\HttpTestCase;

class SmsTest extends HttpTestCase
{
    public function testWebSmsSend()
    {
        $res = $this->client->post('/sms/send',[
            'mobile' => '15904435047'
        ]);

        return $this->assertSame(0,$res['code']);
    }
}
