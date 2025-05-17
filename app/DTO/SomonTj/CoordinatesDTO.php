<?php

namespace App\DTO\SomonTj;

class CoordinatesDTO
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {}
}
