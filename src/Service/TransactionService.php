<?php

namespace Service;

use App\Entity\Client;
use App\Entity\Subscription;

interface TransactionService
{
    public function create(float $amount, Client $client): void;
}
