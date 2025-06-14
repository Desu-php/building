<?php

namespace App\Services;

use App\Models\Listing\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListingService
{
    private float $latitude = 40.281897;

    private float $longitude = 69.624722;

    public function setPoint(float $latitude, float $longitude): self
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        return $this;
    }

    public function searInCenter(float $radius): Collection
    {
        return Listing::query()
            ->select('listings.*')
            ->selectRaw('
                6371 * ACOS(
           SIN(RADIANS(' . $this->latitude . ')) * SIN(RADIANS(latitude)) +
           COS(RADIANS(' . $this->latitude . ')) * COS(RADIANS(latitude)) *
           COS(RADIANS(longitude) - RADIANS(' . $this->longitude . '))
       ) AS distance_km
            ')
            ->whereRaw('
            6371 * ACOS(
        SIN(RADIANS(' . $this->latitude . ')) * SIN(RADIANS(latitude)) +
        COS(RADIANS(' . $this->latitude . ')) * COS(RADIANS(latitude)) *
        COS(RADIANS(longitude) - RADIANS(' . $this->longitude . '))
        ) <= ?', [$radius])
            ->where('floor', '<',10)
            ->orderBy('price')
            ->with('images')
            ->get();
    }

    public function byWords(float $radius): Collection
    {
        $words = ['Центр', 'Универмаг', 'Марказ', 'Хукумат', 'Ватан'];

        return Listing::query()
            ->select('listings.*')
            ->where('floor', '<', 10)
            ->where('sostoyanie', 10)
            ->where(function (Builder $query) use ($words) {
                foreach ($words as $word) {
                    $query->orWhere(function (Builder $subQuery) use ($word) {
                        $subQuery
                            ->where('title', 'ILIKE', "%{$word}%")
                            ->orWhere('district', 'ILIKE', "%{$word}%");
                    });
                }
            })
            ->orderBy('price')
            ->with('images')
            ->get();
    }
}
