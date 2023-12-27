<?php

namespace App\Payload;

use Symfony\Component\Validator\Constraints as Assert;

readonly class User
{
    public function __construct(
        public string $name,
        #[Assert\Valid]
        public ?Address $address = null,
    ) {
    }
}
