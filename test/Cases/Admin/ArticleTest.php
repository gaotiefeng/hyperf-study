<?php


namespace HyperfTest\Cases\Admin;


use HyperfTest\HttpTestCase;

class ArticleTest extends HttpTestCase
{
    public function testAdminArticleIndex()
    {
        $res = $this->adminClient->get('/article/index',[
            'offset'=>0,
            'limit'=> 10,
        ]);

        return $this->assertSame(0,$res['code']);
    }
}
