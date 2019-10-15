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

use App\Middleware\CorsMiddleware;
use App\Middleware\DebugMiddleware;
use App\Middleware\UserAuthMiddleware;

return [
    'http' => [
        UserAuthMiddleware::class,
        CorsMiddleware::class,
        DebugMiddleware::class,
    ],
    'admin' => [
        CorsMiddleware::class,
        DebugMiddleware::class,
    ],
];
