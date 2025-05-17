<?php

namespace App\DTO\SomonTj;

class PermissionsDTO
{
    public function __construct(
        public string $phone,
        public string $whatsapp,
        public string $email,
        public string $cv_form,
        public string $chat,
        public string $delivery,
    ) {}
}
