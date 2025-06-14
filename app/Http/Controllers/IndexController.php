<?php

namespace App\Http\Controllers;

use App\Services\ListingService;

class IndexController
{
    public function index(ListingService $listingService)
    {
        $listings = $listingService->byWords(1.2);

        return view('welcome', compact('listings'));
    }
}
