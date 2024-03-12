<?php

namespace App\Services;

use App\DTOs\ServiceDTO;
use App\Exceptions\ServiceCreationException;
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
    public function getAllServices(string $authorizationHeader,$selectedFields,string $sortField, string $sortDirection,int $perPage): Collection
    {
        $apiKey = substr($authorizationHeader, 7);
        $apiKeysConfig = Config::get('api_fields.api_keys');

        if (!isset($apiKeysConfig[$apiKey])) {
            throw new InvalidArgumentException();
        }
        $associatedFields = $apiKeysConfig[$apiKey];

        if(empty($selectedFields)){
            $result =  $this->serviceRepository->all($associatedFields,$sortField,$sortDirection,$perPage);
        }else{
            $selectedFields = explode(',', $selectedFields);
            $fields = array_intersect($selectedFields,$associatedFields);
            $result =  $this->serviceRepository->all($fields,$sortField,$sortDirection,$perPage);
        }

        return $result;
    }

    /**
     * @throws ServiceCreationException
     */
    public function createService(ServiceDTO $serviceDTO): ServiceDTO
    {
        $service = $this->serviceMapper->toModel($serviceDTO);

        if (!$service->save()) {
            throw new ServiceCreationException();
        }
        return $this->serviceMapper::toDTO($service);
    }
}
