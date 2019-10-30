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
class AdminTest extends HttpTestCase
{
    public function testAdminIndex()
    {
        $res = $this->adminClient->get('/admin/index', [
            'offset' => 0,
            'limit' => 10,
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testAdminDelete()
    {
        $res = $this->adminClient->post('/admin/delete', [
            'id' => 10,
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testAdminSave()
    {
        $res = $this->adminClient->post('/admin/save', [
            'mobile' => '15904436899',
            'user_name' => 'test',
            'role_id' => 1,
            'password' => '123456',
        ]);

        $this->assertSame(0, $res['code']);
    }
}
