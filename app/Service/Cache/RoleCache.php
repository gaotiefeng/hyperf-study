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

namespace App\Service\Cache;

use App\Model\Role;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CachePut;

class RoleCache
{
    /**
     * @Cacheable(prefix="role", value="list", ttl="86400")
     */
    public function roleGet()
    {
        return $this->roleAll();
    }

    /**
     * @CachePut(prefix="role", value="list", ttl="86400")
     */
    public function rolePut()
    {
        return $this->roleAll();
    }

    public function roleAll()
    {
        return  Role::query()->select('id', 'name')->get()->toArray();
    }
}
