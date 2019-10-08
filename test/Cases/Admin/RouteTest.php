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
    public function testAdminRouteSave()
    {
        $res = $this->adminClient->post('/route/save', [
            'name' => '12321',
            'icon' => 'ads',
            'route' => '/route/save',
        ]);

        $this->assertSame(0, $res['code']);
    }
}
