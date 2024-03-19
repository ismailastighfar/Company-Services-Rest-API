<?php

namespace App\Repositories;

use App\DTOs\RequestDTO;
use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\Enums\SortDirection;
use Spatie\QueryBuilder\QueryBuilder;

class ServiceRepository implements ServiceRepositoryInterface
{

    public function all(RequestDTO $requestDTO)
    {
        $query = QueryBuilder::for(Service::class)
            ->select($requestDTO->selectedFields)
            ->allowedSorts($requestDTO->sortField )
            ->defaultSort($requestDTO->sortField)
            ->paginate($requestDTO->perPage);

        return $query->getCollection();
    }

    public function create(array $data)
    {
       return Service::create($data);
    }

    public function allWithRelationships(RequestDTO $requestDTO,$includeRelationships,$associatedFields)
    {
        $requestDTO->selectedFields[] = "department_id";
        $requestDTO->selectedFields[] = "employee_id";

        $query = QueryBuilder::for(Service::class)
            ->select($requestDTO->selectedFields)
            ->allowedSorts($requestDTO->sortField)
            ->defaultSort($requestDTO->sortField)
            ->allowedIncludes($includeRelationships)
            ->paginate($requestDTO->perPage);

            return $query->getCollection();
        }

}
