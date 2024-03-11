<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:25',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'location' => 'required|max:25',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|max:10',
        ];
    }
}
