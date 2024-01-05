<?php

namespace App\Payload;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

readonly class User implements PayloadInterface
{
    public function __construct(
        #[Length(min: 3)]
        #[Type(type: 'alpha')]
        public string $name,
        #[Assert\Valid]
        public ?Address $address = null,
    ) {
    }
}
