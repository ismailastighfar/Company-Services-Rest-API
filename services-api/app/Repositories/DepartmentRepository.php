<?php

namespace App\Repositories;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function all(string $sortField, string $sortDirection, int $perPage): Collection
    {
        $query = Department::orderBy($sortField, $sortDirection)->with('services');

        $result = $query->paginate($perPage);

        return $result->getCollection();


    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }
}
