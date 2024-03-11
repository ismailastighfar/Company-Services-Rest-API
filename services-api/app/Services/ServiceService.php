<?php

namespace App\Services;

use App\DTOs\ServiceDTO;
use App\Interfaces\ServiceRepositoryInterface;
use App\Interfaces\ServiceServiceInterface;
use App\Mappers\ServiceMapper;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;

class ServiceService implements ServiceServiceInterface
{
    private ServiceRepositoryInterface $serviceRepository;
    private ServiceMapper $serviceMapper;

    public function __construct(ServiceRepositoryInterface $serviceRepository, ServiceMapper $serviceMapper)
    {
        $this->serviceRepository = $serviceRepository;
        $this->serviceMapper = $serviceMapper;
    }
    public function getAllServices(string $authorizationHeader): Collection
    {
        $apiKey = substr($authorizationHeader, 7);
        $apiKeysConfig = Config::get('api_fields.api_keys');

        if (!isset($apiKeysConfig[$apiKey])) {
            throw new InvalidArgumentException();
        }
        $associatedFields = $apiKeysConfig[$apiKey];
        return $this->serviceRepository->all($associatedFields);
    }

    public function createService(ServiceDTO $serviceDTO): ServiceDTO
    {
        $service = $this->serviceMapper->toModel($serviceDTO);
        $service->save();
        return $this->serviceMapper::toDTO($service);
    }
}
