<?php

namespace App\DTO\SomonTj;

class ImageDTO
{
    public function __construct(
        public int $id,
        public string $url,
        public string $orig,
        public bool $is_flatplan,
    ) {}
}
