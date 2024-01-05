<?php

namespace App\Handler;

use App\Payload\PayloadInterface;
use App\Payload\User;

final class CreateOrUpdateUserHandler implements HandlerInterface
{
    /**
     * @param User $payload
     */
    public function handle(PayloadInterface $payload): void
    {
    }
}
