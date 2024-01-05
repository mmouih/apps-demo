<?php

namespace App\Payload;

readonly class Geolocalisation implements PayloadInterface
{
    public function __construct(
        public float $lat,
        public float $lng,
    ) {
    }
}
