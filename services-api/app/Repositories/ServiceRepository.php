<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository implements ServiceRepositoryInterface
{

    public function all(array $fields): Collection
    {
        return Service::all($fields);
    }

    public function create(array $data)
    {
       return Service::create($data);
    }
}
