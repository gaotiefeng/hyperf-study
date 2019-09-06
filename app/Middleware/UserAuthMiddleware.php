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

namespace App\Middleware;

use App\Constants\Constants;
use App\Untils\JwtAuth;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserAuthMiddleware implements MiddlewareInterface
{
    /** @var ContainerInterface */
    protected $container;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine(Constants::AUTH_TOKEN);

        $auth = JwtAuth::instance()->reload($token);

        if (! $auth->check()) {
            //$auth->init(1);
        }

        return  $handler->handle($request);
    }
}
