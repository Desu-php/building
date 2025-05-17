<?php

namespace App\Models\Listing;

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
}
