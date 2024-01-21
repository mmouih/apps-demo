<?php

namespace App\Entity;

class Client
{
    private int $id;

    private Subscription $subscription;

    public function getId(): int
    {
        return $this->id;
    }


    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }
}
