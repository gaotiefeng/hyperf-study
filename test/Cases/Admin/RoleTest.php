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
class RoleTest extends HttpTestCase
{
    public function testAdminRoleIndex()
    {
        $res = $this->adminClient->get('/role/index',[
           'offset' => 0,
           'limit' => 10
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testAdminRoleSave()
    {
        $res = $this->adminClient->post('/role/save', [
            'name' => '12321',
        ]);

        $this->assertSame(0, $res['code']);
    }
}
