<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface DepartmentRepositoryInterface
{
    public function all(string $sortField, string $sortDirection, int $perPage);

    public function create(array $data);
}
