<?php

namespace App\Interfaces;

use App\DTOs\RequestDTO;
use App\DTOs\ServiceDTO;
use phpDocumentor\Reflection\Types\Boolean;

interface ServiceServiceInterface
{
    public function getAllServices(RequestDTO $requestDTO);
    public function createService(ServiceDTO $serviceDTO) : ServiceDTO;
}
