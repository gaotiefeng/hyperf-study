<?php


namespace HyperfTest\Cases\Admin;


use HyperfTest\HttpTestCase;

class AdminTest extends HttpTestCase
{
    public function testAdminIndex()
    {
        $res = $this->adminClient->get('/admin/index',[
                'offset' => 0,
                'limit' => 10,
            ]);

        $this->assertSame(0,$res['code']);
    }
}
