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
        return [
            'id' => $this->id,
            'name' =>$this->name,
            'description' => $this->description
        ];
    }
}
