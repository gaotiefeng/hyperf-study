<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;

/**
 * @Consumer(exchange="hyperf", routingKey="hyperf", queue="hyperf", name ="MessageConsumer", nums=1)
 */
class MessageConsumer extends ConsumerMessage
{
    public function consume($data): string
    {
        return Result::ACK;
    }
}
