<?php

namespace App\DTO\SomonTj;

class BreadcrumbDTO
{
    public function __construct(
        public int $id,
        public string $path,
        public string $name,
    ) {}
}
