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
use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Untils\AdminAuth;
use Hyperf\Config\Annotation\Value;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminAuthMiddleware implements MiddlewareInterface
{
    /**
     * @Value(key="debug")
     */
    protected $debug;

    protected $urls = [
        '/user/login',
    ];

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
        $token = $request->getHeaderLine(Constants::ADMIN_TOKEN);

        $getUrl = $request->getUri()->getPath();

        if (! in_array($getUrl, $this->urls)) {
            $auth = AdminAuth::instance()->reload($token);

            if (! $auth->check() && $this->debug) {
                //throw new  BusinessException(ErrorCode::TOKEN_NOT_EXITS);
                $auth->init(1);
            }
        }

        return  $handler->handle($request);
    }
}
