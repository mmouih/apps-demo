<?php

namespace App\Domain\Payment;

use App\Entity\Client;

class PurchaseHistoryDiscountProcessor implements PaymentProcessor
{
    public function supports(Client $client): bool
    {
        return $client->getPurchaseHistory() > 5;
    }

    public function handle(float $amount, Client $client): float
    {
        return $amount * 0.92; // Additional 8% discount for loyal customers
    }
}
