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

    public function testWebArticleLikes()
    {
        $res = $this->client->post('/article/likes',[
           'user_id' => 1,
           'article' => 1,
        ]);

        $this->assertSame(0, $res['code']);
    }
}
