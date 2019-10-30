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

use App\Model\Route;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CachePut;

class RouteCache
{
    /**
     * @Cacheable(prefix="route", value="list", ttl="86400")
     */
    public function getRoute()
    {
        return $this->allRoute();
    }

    /**
     * @CachePut(prefix="route", value="list", ttl="86400")
     */
    public function putRoute()
    {
        return $this->allRoute();
    }

    public function allRoute()
    {
        return  Route::query()->select('id', 'name')->get()->toArray();
    }
}
