<?php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

arch('controllers must has "Controller" as suffix')
    ->expect('App\Controller')
    ->toHaveSuffix('Controller');

arch(sprintf('constroller must extends %s', AbstractController::class))
    ->expect('App\Controller')
    ->toExtend(AbstractController::class);

arch('Controllers cannot be used anywhere')
    ->expect('App\Controller')
    ->toBeUsedInNothing();
