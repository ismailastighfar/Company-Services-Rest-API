<?php

namespace App\Services;

use App\DTOs\RequestDTO;
use App\DTOs\ServiceDTO;
use App\Exceptions\ServiceCreationException;
use App\Exceptions\UnauthorizedApiKeyException;
use App\Interfaces\ServiceRepositoryInterface;
use App\Interfaces\ServiceServiceInterface;
use App\Mappers\ServiceMapper;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Boolean;

class ServiceService implements ServiceServiceInterface
{
    private ServiceRepositoryInterface $serviceRepository;
    private ServiceMapper $serviceMapper;

    public function __construct(ServiceRepositoryInterface $serviceRepository, ServiceMapper $serviceMapper)
    {
        $this->serviceRepository = $serviceRepository;
        $this->serviceMapper = $serviceMapper;
    }

    /**
     * @throws UnauthorizedApiKeyException
     */
    public function getAllServices(RequestDTO $requestDTO)
    {
        $apiKey = substr($requestDTO->authorizationHeader, 7);
        $apiKeysConfig = Config::get('api_fields.api_keys');

        if (!isset($apiKeysConfig[$apiKey])) {
            throw new UnauthorizedApiKeyException();
        }
       $associatedFields = $apiKeysConfig[$apiKey];

        $fields = $associatedFields['fields'];
        $allowedFields = $associatedFields['allowed_fields'];

        if (empty( $requestDTO->selectedFields)) {
            $requestDTO->selectedFields = $fields;
        } else {
            $requestDTO->selectedFields = explode(',',  $requestDTO->selectedFields);
        }

        $includeRelationships = explode(',', $requestDTO->includeRelationships);



        if ($includeRelationships){
          $result =  $this->serviceRepository->allWithRelationships($requestDTO,$includeRelationships,$allowedFields);
        }else{
            $result =  $this->serviceRepository->all($requestDTO);
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
