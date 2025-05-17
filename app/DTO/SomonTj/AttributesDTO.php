<?php

namespace App\DTO\SomonTj;

class AttributesDTO
{
    public function __construct(
        public int $attrs__feet,
        public int $attrs__type,
        public int $attrs__floor,
        public int $attrs__remont,
        public int $attrs__sanuzel,
        public string $attrs__district,
        public int $attrs__otoplenie,
        public int $attrs__sostoyanie,
    ) {}
}

