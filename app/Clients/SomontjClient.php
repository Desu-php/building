<?php

namespace App\Clients;

use App\DTO\SomonTj\GetItemsResponseDTO;
use App\Mapper\ApartmentMapper;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SomontjClient
{
    private PendingRequest $http;

    public function __construct(
        private ApartmentMapper $mapper
    )
    {
        $this->http = Http::baseUrl('https://somon.tj/api/')
            ->asJson();
    }

    public function getItems(int $page = 1): GetItemsResponseDTO
    {
        $response = $this->http->get('items', [
                'rubric' => 216,
                'c' => 2362,
                'cities' => 512,
                'page' => $page,
            ])
                ->throw()
                ->collect();

        return new GetItemsResponseDTO(
            count: $response['count'],
            next: $response['next'],
            previous: $response['previous'],
            results: array_map(
                fn(array $result) => $this->mapper->results($result),
                $response->get('results')
            )
        );
    }
}
