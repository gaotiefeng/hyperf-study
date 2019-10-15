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

namespace App\Untils;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Firebase\JWT\JWT;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Utils\Traits\StaticInstance;
use Throwable;

class JwtAuth
{
    use StaticInstance;

    protected $key = 'Auth-Token';

    /**
     * @var int
     */
    protected $userId = 0;

    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = di()->get(StdoutLoggerInterface::class);
    }

    public function init(int $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function reload(string $token)
    {
        $this->userId = $this->checkToken($token);

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function build()
    {
        if ($this->check()) {
            return $this;
        }

        throw new BusinessException(ErrorCode::NOT_TOKEN);
    }

    public function check(): bool
    {
        return $this->userId > 0;
    }

    public function getToken()
    {
        $time = time();
        $params = [
            'iss' => 'article',
            'aud' => 'user',
            'iat' => $time,
            'nbf' => $time,
            'exp' => $time + 7200,
            'data' => [
                'user_id' => $this->build()->getUserId(),
            ],
        ];

        return JWT::encode($params, $this->key);
    }

    public function checkToken(string $token): int
    {
        try {
            $decoded = JWT::decode($token, $this->key, ['HS256']);
            return $decoded->data->user_id;
        } catch (Throwable $exception) {
            $this->logger->warning('Decode token failed. Message = ' . $exception->getMessage());
        }

        return 0;
    }
}
