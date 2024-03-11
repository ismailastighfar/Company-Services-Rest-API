<?php

namespace App\Interfaces;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    public function all(array $fields) : Collection;

    public function create(array $data);
}
