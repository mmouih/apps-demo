<?php

namespace App\Domain\Payment;

use App\Entity\Client;

interface PaymentProcessor
{
    public function supports(Client $client): bool;
    public function handle(float $amount, Client $client): float;
}
