<?php

namespace App\DTO\SomonTj;

class GetItemsResponseDTO
{
    public function __construct(
        public int $count,
        public string $next,
        public ?string $previous,
        /** @var ApartmentDTO[] */
        public array $results
    )
    {
    }
}
