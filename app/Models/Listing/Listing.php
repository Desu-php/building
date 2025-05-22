<?php

namespace App\Models\Listing;

use App\Services\PriceService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    protected $guarded = ['id'];

    public function listingUser(): BelongsTo
    {
        return $this->belongsTo(ListingUser::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    public function getFormatPriceAttribute(): string
    {
        return new PriceService($this->price)->formatPrice();
    }

    public function getUrlAttribute(): string
    {
        return sprintf('https://somon.tj/adv/%d_%s/', $this->external_id, $this->slug);
    }
}
