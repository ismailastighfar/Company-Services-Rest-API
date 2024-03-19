<?php

namespace App\Services;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Interfaces\DepartmentServiceInterface;
use App\Repositories\DepartmentRepository;
use Illuminate\Database\Eloquent\Collection;

class DepartmentService implements DepartmentServiceInterface
{

    protected DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function all(string $sortField, string $sortDirection, int $perPage): Collection
    {
        return $this->departmentRepository->all($sortField, $sortDirection, $perPage);
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }
}
