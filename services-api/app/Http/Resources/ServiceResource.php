<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Service",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="price", type="number"),
 *     @OA\Property(property="is_active", type="boolean"),
 *     @OA\Property(property="location", type="string"),
 *     @OA\Property(property="contact_email", type="string"),
 *     @OA\Property(property="contact_phone", type="string")
 * )
 */


class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'location' => $this->location,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'department' => new DepartmentResource($this->whenLoaded('department')),
            'employee' => new EmployeeResource($this->whenLoaded('employee')
            )
        ];



        // Filter out null values
        $filteredData = array_filter($data, function ($value) {
            return $value !== null;
        });

        return $filteredData;
    }
}
