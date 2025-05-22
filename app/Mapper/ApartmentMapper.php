<?php

namespace App\Mapper;

use App\DTO\SomonTj\ApartmentDTO;
use App\DTO\SomonTj\UserDTO;
use App\DTO\SomonTj\ImageDTO;
use App\DTO\SomonTj\AttributesDTO;
use App\DTO\SomonTj\CoordinatesDTO;
use App\DTO\SomonTj\PermissionsDTO;

class ApartmentMapper
{
    public function results(array $data): ApartmentDTO
    {
        return new ApartmentDTO(
            id: $data['id'],
            title: $data['title'],
            slug: $data['slug'],
            rubric: $data['rubric'],
            description: $data['description'],
            city: $data['city'],
            user: new UserDTO(
                id: $data['user']['id'],
                name: $data['user']['name'],
                has_email: $data['user']['has_email'],
                verified: $data['user']['verified'],
                joined: $data['user']['joined'],
                phone: $data['user']['phone'] ?? null,
            ),
            images: array_map(fn(array $image) => new ImageDTO(
                id: $image['id'],
                url: $image['url'],
                orig: $image['orig'],
                is_flatplan: $image['is_flatplan']
            ), $data['images']),
            attrs: new AttributesDTO(
                attrs__feet: $data['attrs']['attrs__feet'] ?? 0,
                attrs__type: $data['attrs']['attrs__type'] ?? 0,
                attrs__floor: $data['attrs']['attrs__floor'] ?? 0,
                attrs__remont: $data['attrs']['attrs__remont'] ?? 0,
                attrs__sanuzel: $data['attrs']['attrs__sanuzel'] ?? 0,
                attrs__district: $data['attrs']['attrs__district'],
                attrs__otoplenie: $data['attrs']['attrs__otoplenie'] ?? 0,
                attrs__sostoyanie: $data['attrs']['attrs__sostoyanie'] ?? 0,
            ),
            price: $data['price'],
            start_price: $data['start_price'] ?? null,
            contacts: $data['contacts'] ?? [],
            hit_count: $data['hit_count'],
            currency: $data['currency'],
            phone_hitcount: $data['phone_hitcount'],
            raise_dt: $data['raise_dt'],
            created_dt: $data['created_dt'],
            owner_advert_count: $data['owner_advert_count'],
            coordinates: isset($data['coordinates']) ? new CoordinatesDTO(
                latitude: $data['coordinates']['latitude'],
                longitude: $data['coordinates']['longitude']
            ) : null,
            zoom: $data['zoom'],
            negotiable_price: $data['negotiable_price'],
            exchange: $data['exchange'],
            price_description: $data['price_description'],
            in_top: $data['in_top'],
            in_premium: $data['in_premium'],
            is_editable: $data['is_editable'],
            is_favorite: $data['is_favorite'],
            city_districts: $data['city_districts'],
            flatplan: $data['flatplan'],
            video_link: $data['video_link'],
            credit_type: $data['credit_type'],
            credit_attrs: $data['credit_attrs'],
            credit_link: $data['credit_link'],
            breadcrumbs: [],
            templated_title: $data['templated_title'],
            cloudinary_video: $data['cloudinary_video'] ?? [],
            whatsapp: $data['whatsapp'] ?? '',
            viber: $data['viber'] ?? null,
            imei_checked: $data['imei_checked'],
            imei_info: $data['imei_info'] ?? [],
            phone_benchmark_results: $data['phone_benchmark_results'] ?? [],
            external_id: $data['external_id'] ?? '',
            item_link: $data['item_link'] ?? '',
            virtual_tour_link: $data['virtual_tour_link'] ?? '',
            square_meter_price: $data['square_meter_price'] ?? null,
            is_carcheck: $data['is_carcheck'],
            delivery: $data['delivery'] ?? false,
            has_online_viewing: $data['has_online_viewing'] ?? false,
            has_carcheck_report: $data['has_carcheck_report'] ?? false,
            has_free_carcheck_report: $data['has_free_carcheck_report'] ?? false,
            category_type: $data['category_type'] ?? '',
            new_in_stock_label: $data['new_in_stock_label'],
            new_to_order_label: $data['new_to_order_label'],
            price_from: $data['price_from'],
            show_send_form: $data['show_send_form'] ?? false,
            show_whatsapp_btn: $data['show_whatsapp_btn'] ?? false,
            permissions: new PermissionsDTO(
                phone: $data['permissions']['phone'],
                whatsapp: $data['permissions']['whatsapp'],
                email: $data['permissions']['email'],
                cv_form: $data['permissions']['cv_form'],
                chat: $data['permissions']['chat'],
                delivery: $data['permissions']['delivery'],
            ),
            currency_id: $data['currency_id'],
        );
    }
}

