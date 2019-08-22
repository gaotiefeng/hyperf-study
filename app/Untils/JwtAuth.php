<?php


namespace App\Untils;


use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Firebase\JWT\JWT;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Utils\Traits\StaticInstance;

class JwtAuth
{
    use StaticInstance;

    protected $key = 'api-token';

    protected $userId = 0;

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

    public function getUser()
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
        $params = array(
            "iss" => "article",
            "aud" => "user",
            "iat" => $time,
            "nbf" => $time,
            "exp" => $time + 7200,
            "data" => [
                "user_id" => $this->build()->getUser(),
            ]
        );

        return JWT::encode($params, $this->key);
    }

    public function checkToken(string $token) : int
    {
        try{
            $decoded = JWT::decode($token, $this->key, array('HS256'));
            return $decoded->data->user_id;
        }catch (\Throwable $exception){
            $this->logger->warning('Decode token failed. Message = ' . $exception->getMessage());
        }

        return 0;
    }
}
