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
class RouteTest extends HttpTestCase
{
    public function testAdminRouteIndex()
    {
        $res = $this->adminClient->get('/route/index', [
            'offset' => 0,
            'limit' => 10,
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testAdminRouteSave()
    {
        $res = $this->adminClient->post('/route/save', [
            'name' => '添加路由',
            'icon' => '',
            'route' => '/route/save',
            'method' => 'get',
            'read' => 1,
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testAdminRouteDelete()
    {
        $res = $this->adminClient->post('/route/delete', [
            'id' => 1,
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testAdminRouteAll()
    {
        $res = $this->adminClient->post('/route/all', [
        ]);

        $this->assertSame(0, $res['code']);
    }
}
