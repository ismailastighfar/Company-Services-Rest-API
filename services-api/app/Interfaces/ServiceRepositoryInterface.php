<?php

namespace App\Interfaces;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    public function all(array $fields,string $sortField,string $sortDirection,int $perPage) : Collection;

    public function create(array $data);
}
