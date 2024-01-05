<?php

use App\Payload\PayloadInterface;

arch('Payloads should be readonly')
    ->expect('App\Payload')
    ->classes()
    ->toBeReadonly();

arch('Payloads must implement ' . PayloadInterface::class)
    ->expect('App\Payload')
    ->classes()
    ->toImplement(PayloadInterface::class);
