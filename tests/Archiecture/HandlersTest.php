<?php

use App\Handler\CreateOrUpdateUserHandler;
use App\Handler\HandlerInterface;

arch(sprintf('CreateOrUpdateUserHandler must implement %s', HandlerInterface::class))
->expect(CreateOrUpdateUserHandler::class)
->toImplement(HandlerInterface::class);

arch('handlers must be final')
    ->expect('App\Handler')
    ->classes
    ->toBeFinal();

arch(sprintf('All classes from Namespace App\Handler implement %s', HandlerInterface::class))
    ->expect('App\Handler')
    ->toImplement(HandlerInterface::class);
