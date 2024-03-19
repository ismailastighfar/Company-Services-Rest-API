<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RequestDTO extends DataTransferObject
{
    public string $authorizationHeader;

    public string $sortField;

    public string $sortDirection;

    public int $perPage;

    public   $selectedFields;

    public string  $includeRelationships;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(Request $request): self
    {
        return new static([
            'authorizationHeader' => $request->header('Authorization') ?? '',
            'sortField' => $request->input('sort', 'id'),
            'sortDirection' => $request->input('direction', 'asc'),
            'perPage' => (int) $request->input('per_page', 10),
            'selectedFields' => $request->input('fields', ''),
            'includeRelationships' => $request->input('include', ''),
        ]);
    }



}
