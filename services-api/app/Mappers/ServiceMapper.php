<?php

namespace App\Mappers;

use App\DTOs\ServiceDTO;
use App\Models\Service;

class ServiceMapper
{
    public static function toModel(ServiceDTO $serviceDTO): Service
    {
        $data = [
            'name' => $serviceDTO->name,
            'description' => $serviceDTO->description,
            'price' => $serviceDTO->price,
            'is_active' => $serviceDTO->is_active,
            'location' => $serviceDTO->location,
            'contact_email' => $serviceDTO->contact_email,
            'contact_phone' => $serviceDTO->contact_phone,
        ];

        if ($serviceDTO->id !== null) {
            $data['id'] = $serviceDTO->id;
        }

        return new Service($data);
    }

    public static function toDTO(Service $service): ServiceDTO
    {
        return new ServiceDTO([
            'id' => $service->id,
            'name' => $service->name,
            'description' => $service->description,
            'price' => $service->price,
            'is_active' => $service->is_active,
            'location' => $service->location,
            'contact_email' => $service->contact_email,
            'contact_phone' => $service->contact_phone,
        ]);
    }
}
