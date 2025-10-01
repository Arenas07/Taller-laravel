<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'booking_id' => 'required|exists:bookings,id',
            'method'     => 'required|in:card,cash,transfer',
            'amount'     => 'required|numeric|min:0.01',
            'status'     => 'in:pending,paid,failed'
        ];
    }
}
