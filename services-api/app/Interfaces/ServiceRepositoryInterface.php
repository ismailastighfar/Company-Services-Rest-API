<?php

namespace App\Interfaces;

use App\DTOs\RequestDTO;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    public function all(RequestDTO $requestDTO) ;

    public function allWithRelationships(RequestDTO $requestDTO,$includeRelationships,$associatedFields) ;

    public function create(array $data);
}
