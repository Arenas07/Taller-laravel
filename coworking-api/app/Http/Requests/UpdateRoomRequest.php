<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'space_id' => 'sometimes|exists:spaces,id',
            'name' => 'sometimes|string|max:100',
            'capacity' => 'sometimes|integer|min:1',
            'price_per_hour' => 'sometimes|numeric|min:0',
            'description' => 'sometimes|nullable|string|max:500',
        ];
    }
}
