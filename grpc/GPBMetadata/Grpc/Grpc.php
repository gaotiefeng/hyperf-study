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

# source: grpc/grpc.proto

namespace GPBMetadata\Grpc;

class Grpc
{
    public static $is_initialized = false;

    public static function initOnce()
    {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
            return;
        }
        $pool->internalAddGeneratedFile(hex2bin(
            '0aad010a0f677270632f677270632e70726f746f12046772706322230a06' .
            '486955736572120c0a046e616d65180120012809120b0a03736578180220' .
            '01280522360a0748695265706c79120f0a076d6573736167651801200128' .
            '09121a0a047573657218022001280b320c2e677270632e48695573657232' .
            '2f0a02686912290a0873617948656c6c6f120c2e677270632e4869557365' .
            '721a0d2e677270632e48695265706c792200620670726f746f33'
        ));

        static::$is_initialized = true;
    }
}
