<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository implements ServiceRepositoryInterface
{

    public function all($fields, string $sortField, string $sortDirection, int $perPage): Collection
    {
        $query = Service::select($fields)
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return $query->getCollection();
    }

    public function create(array $data)
    {
       return Service::create($data);
    }
}
