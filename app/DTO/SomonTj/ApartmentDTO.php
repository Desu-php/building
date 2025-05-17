<?php

namespace App\DTO\SomonTj;

class ApartmentDTO
{
    public function __construct(
        public int             $id,
        public string          $title,
        public string          $slug,
        public int             $rubric,
        public string          $description,
        public int             $city,
        public UserDTO         $user,
        public array           $images, // array of ImageDTO
        public AttributesDTO   $attrs,
        public string          $price,
        public ?string         $start_price,
        public array           $contacts,
        public int             $hit_count,
        public string          $currency,
        public int             $phone_hitcount,
        public string          $raise_dt,
        public string          $created_dt,
        public int             $owner_advert_count,
        public ?CoordinatesDTO $coordinates,
        public ?int            $zoom,
        public bool            $negotiable_price,
        public bool            $exchange,
        public string          $price_description,
        public bool            $in_top,
        public bool            $in_premium,
        public bool            $is_editable,
        public bool            $is_favorite,
        public array           $city_districts,
        public bool            $flatplan,
        public ?string         $video_link,
        public ?string         $credit_type,
        public ?string         $credit_attrs,
        public ?string         $credit_link,
        public array           $breadcrumbs = [], // array of BreadcrumbDTO
        public string          $templated_title,
        public array           $cloudinary_video,
        public string          $whatsapp,
        public ?string         $viber,
        public bool            $imei_checked,
        public array           $imei_info,
        public array           $phone_benchmark_results,
        public string          $external_id,
        public string          $item_link,
        public string          $virtual_tour_link,
        public ?string         $square_meter_price,
        public bool            $is_carcheck,
        public bool            $delivery,
        public bool            $has_online_viewing,
        public bool            $has_carcheck_report,
        public bool            $has_free_carcheck_report,
        public string          $category_type,
        public bool            $new_in_stock_label,
        public bool            $new_to_order_label,
        public bool            $price_from,
        public bool            $show_send_form,
        public bool            $show_whatsapp_btn,
        public PermissionsDTO  $permissions,
        public int             $currency_id,
    )
    {
    }
}

