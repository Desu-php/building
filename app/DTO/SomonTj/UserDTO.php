<?php

namespace App\DTO\SomonTj;

class UserDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $has_email,
        public bool $verified,
        public string $joined,
        public ?string $phone,
    ) {}
}

