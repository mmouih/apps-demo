<?php

namespace App\Payload;

readonly class Geolocalisation
{
    public function __construct(
        public float $lat,
        public float $lng,
    ) {
    }
}
