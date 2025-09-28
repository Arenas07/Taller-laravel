<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => 'sometimes|exists:rooms,id',
            'user_id' => 'sometimes|exists:users,id',
            'start_time' => 'sometimes|date|after_or_equal:now',
            'end_time' => 'sometimes|date|after:start_time',
            'status' => 'sometimes|in:pending,confirmed,cancelled',
        ];
    }
}
