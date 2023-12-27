<?php

namespace App\Payload;

readonly class Geolocalisation
{
    public function __construct(
        public string $lat,
        public string $lng,
    ) {
    }
}
