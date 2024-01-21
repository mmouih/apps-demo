<?php

namespace Domain\Payment;

use App\Entity\Client;
use App\Domain\Payment\PaymentProcessor;

class LoyaltyDiscountProcessor implements PaymentProcessor
{
    public function supports(Client $client): bool
    {
        return $client->getLoyaltyTier()->isGold() || $client->getLoyaltyTier()->isSilver();
    }

    public function handle(float $amount, Client $client): float
    {
        $loyaltyTier = $client->getLoyaltyTier();
        if ($loyaltyTier->isGold()) {
            return $amount * 0.9; // 10% discount for Gold tier
        }

        if ($loyaltyTier->isSilver()) {
            return $amount * 0.95; // 5% discount for Silver tier
        }
        return $amount;
    }
}

