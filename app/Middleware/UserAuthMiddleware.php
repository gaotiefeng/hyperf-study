<?php


namespace App\Middleware;


use App\Constants\Constants;
use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Untils\JwtAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


class UserAuthMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine(Constants::AUTH_TOKEN);

        $auth = di()->get(JwtAuth::class)->reload($token);

        if(!$auth->checkToken()) {
            throw   new BusinessException(ErrorCode::NOT_TOKEN);
        }

        return$handler->handle($request);
    }
}
