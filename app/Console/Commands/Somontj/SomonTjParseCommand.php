<?php

namespace App\Console\Commands\Somontj;

use App\Clients\SomontjClient;
use App\DTO\SomonTj\GetItemsResponseDTO;
use App\DTO\SomonTj\ImageDTO;
use App\Models\Listing\Listing;
use App\Models\Listing\ListingImage;
use App\Models\Listing\ListingUser;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SomonTjParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'somontj:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SomontjClient $client): void
    {
        $page = 1;

        do {
            $response = $client->getItems($page);
            $this->saveData($response);
            $page++;
        } while ($response->next);
    }

    private function saveData(GetItemsResponseDTO $items): void
    {
        $now = now();
        $listings = [];
        $users = [];
        $images = [];

        foreach ($items->results as $item) {
            $users[$item->user->id] = [
                'external_id' => $item->user->id,
                'name' => $item->user->name,
                'phone' => $item->user->phone,
                'joined' => $item->user->joined ? Carbon::parse($item->user->joined)->toDateTimeString() : null,
                'created_at' => $now->toDateTimeString(),
                'updated_at' => $now->toDateTimeString(),
            ];

            $images[$item->id] = array_map(
                fn(ImageDTO $image) => [
                    'external_id' => $image->id,
                    'url' => $image->url,
                    'is_flatplan' => $image->is_flatplan,
                ],
                $item->images
            );

            $listings[] = [
                'external_id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'description' => $item->description,
                'price' => $item->price,
                'city_id' => $item->city,
                'rubric' => $item->rubric,
                'start_price' => $item->start_price,
                'price_description' => $item->price_description,
                'published_at' => Carbon::parse($item->created_dt)->toDateTimeString(),
                'hit_count' => $item->hit_count,
                'phone_hitcount' => $item->phone_hitcount,
                'video_link' => $item->video_link,
                'flatplan' => $item->flatplan,
                'zoom' => $item->zoom,
                'category_type' => $item->category_type,
                'feet' => $item->attrs->attrs__feet,
                'floor' => $item->attrs->attrs__floor,
                'remont' => $item->attrs->attrs__remont,
                'sanuzel' => $item->attrs->attrs__sanuzel,
                'district' => $item->attrs->attrs__district,
                'otoplenie' => $item->attrs->attrs__otoplenie,
                'sostoyanie' => $item->attrs->attrs__sostoyanie,
                'latitude' => $item->coordinates?->latitude,
                'longitude' => $item->coordinates?->longitude,
                'listing_user_id' => $item->user->id,
            ];
        }

        ListingUser::query()->upsert(
            values: $users,
            uniqueBy: ['external_id'],
            update: ['name', 'phone', 'updated_at'],
        );

        $users = ListingUser::query()
            ->whereIn('external_id', array_keys($users))
            ->get()
            ->keyBy('external_id');

        foreach ($listings as &$listing) {
            $listing['listing_user_id'] = $users[$listing['listing_user_id']]->id;
        }

        Listing::query()->upsert(
            values: $listings,
            uniqueBy: ['slug', 'external_id'],
            update: [
                'title',
                'slug',
                'description',
                'price',
                'city_id',
                'rubric',
                'start_price',
                'price_description',
                'published_at',
                'hit_count',
                'phone_hitcount',
                'video_link',
                'flatplan',
                'zoom',
                'category_type',
                'feet',
                'floor',
                'remont',
                'sanuzel',
                'district',
                'otoplenie',
                'sostoyanie',
                'latitude',
                'longitude',
            ],
        );

        $listings = Listing::query()->whereIn('external_id', array_keys($images))->get()->keyBy('external_id');

        $imagesData = [];

        foreach ($images as $listingId => $image) {
            foreach ($image as $item) {
                $imagesData[] = [
                    'listing_id' => $listings[$listingId]->id,
                    ...$item
                ];
            }
        }

        ListingImage::query()->upsert(
            values: $imagesData,
            uniqueBy: ['external_id'],
            update: ['url', 'is_flatplan']
        );
    }
}
