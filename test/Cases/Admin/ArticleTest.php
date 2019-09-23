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

namespace HyperfTest\Cases\Admin;

use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class ArticleTest extends HttpTestCase
{
    public function testAdminArticleIndex()
    {
        $res = $this->adminClient->get('/article/index', [
            'offset' => 0,
            'limit' => 10,
        ]);

        return $this->assertSame(0, $res['code']);
    }

    public function testAdminArticleInfo()
    {
        $res = $this->adminClient->get('/article/info', [
            'id' => 34636204385558529,
        ]);

        return $this->assertSame(0, $res['code']);
    }
}
