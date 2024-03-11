<?php

namespace App\Interfaces;

use App\DTOs\ServiceDTO;

interface ServiceServiceInterface
{
    public function getAllServices(string $authorizationHeader);
    public function createService(ServiceDTO $serviceDTO) : ServiceDTO;
}
