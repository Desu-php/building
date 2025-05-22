<?php

namespace App\Http\Controllers;

use App\Services\ListingService;

class IndexController
{
    public function index(ListingService $listingService)
    {
        $listings = $listingService->searInCenter(1.5);

        return view('welcome', compact('listings'));
    }
}
