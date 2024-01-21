<?php

namespace App\Entity;

class Subscription
{
    private int $id;

    private string $subscription;
    private float $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function isPremium(): bool
    {
        return SubscriptionCase::Premium === $this->subscription;
    }

    public function isBasic(): bool
    {
        return SubscriptionCase::Basic === $this->subscription;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
