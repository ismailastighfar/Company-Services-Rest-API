<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Department",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="manager", type="string"),
 * )
 */
class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data =  [
            'id' => $this->id,
            'nameDep' => $this->nameDep,
            'description' => $this->description,
            'manager' => $this->manager,
            'services' => ServiceResource::collection($this->whenLoaded('services'))
        ];

        $filteredData = array_filter($data, function ($value) {
            return $value !== null;
        });

        return $filteredData;
    }
}
