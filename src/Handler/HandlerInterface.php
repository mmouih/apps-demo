<?php

namespace App\Handler;

use App\Payload\PayloadInterface;

interface HandlerInterface
{
    public function handle(PayloadInterface $payload);
}
