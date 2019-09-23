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
class ArticleTest extends HttpTestCase
{
    public function testWebArticleList()
    {
        $res = $this->client->get('/article/list', [
            'offset' => 1,
            'limit' => 10,
        ]);

        return $this->assertSame(0, $res['code']);
    }

    public function testWebArticleLikes()
    {
        $res = $this->client->post('/article/likes', [
            'user_id' => 1,
            'article' => 1,
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testWebArticleSave()
    {
        $res = $this->client->post('/article/save', [
            'title' => '你知道这五年我怎么过的吗',
            'content' => '你选的吗',
        ]);

        $this->assertSame(0, $res['code']);
    }
}
