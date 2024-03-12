<?php

namespace App\Interfaces;

use App\DTOs\ServiceDTO;

interface ServiceServiceInterface
{
    public function getAllServices(string $authorizationHeader, $selectedFields,string $sortField, string $sortDirection,int $perPage);
    public function createService(ServiceDTO $serviceDTO) : ServiceDTO;
}
