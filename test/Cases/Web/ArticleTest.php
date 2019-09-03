<?php


namespace HyperfTest\Cases\Web;


use HyperfTest\HttpTestCase;

class ArticleTest extends HttpTestCase
{
    public function testWebArticleList()
    {
        $res = $this->client->get('/article/list',[
            'offset' => 1,
            'limit' => 10,
        ]);

        return $this->assertSame(0,$res['code']);
    }
}
