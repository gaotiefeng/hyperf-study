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

namespace App\Exception\Handler;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Kernel\Http\Response;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Response
     */
    protected $response;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $container->get(StdoutLoggerInterface::class);
        $this->response = $this->container->get(Response::class);
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof BusinessException) {
            $this->logger->warning(format_throwable($throwable));

            return $this->response->fail($throwable->getCode(), $throwable->getMessage());
        }

        $this->logger->error(format_throwable($throwable));

        return $this->response->fail(ErrorCode::SERVER_ERROR, 'Server Error');
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
