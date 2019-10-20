<?php


namespace App\Middleware;



use App\Constants\Constants;
use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Untils\AdminAuth;
use App\Untils\JwtAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminAuthMiddleware implements MiddlewareInterface
{
    protected $urls = [
        '/user/login',
    ];

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
        $token = $request->getHeaderLine(Constants::ADMIN_TOKEN);

        $getUrl = $request->getUri()->getPath();

        if(! in_array($getUrl,$this->urls)) {
            $auth = AdminAuth::instance()->reload($token);

            if (! $auth->check()) {
                throw new  BusinessException(ErrorCode::TOKEN_NOT_EXITS);
                $auth->init(1);
            }
        }

        return  $handler->handle($request);
    }
}