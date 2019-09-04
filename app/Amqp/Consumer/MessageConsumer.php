<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use SebastianBergmann\CodeCoverage\Report\PHP;

/**
 * @Consumer(exchange="hyperf", routingKey="hyperf", queue="hyperf", name ="MessageConsumer", nums=1)
 */
class MessageConsumer extends ConsumerMessage
{
    public function consume($data): string
    {
        print_r($data);

        return Result::ACK;
    }
}
