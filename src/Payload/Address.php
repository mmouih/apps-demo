<?php

namespace App\Payload;

readonly class Address
{
    public function __construct(
        public string $address,
        public string $zipcode,
        public string $city,
        public string $country,
        public Geolocalisation $geolocalisation,
    ) {
    }
}
