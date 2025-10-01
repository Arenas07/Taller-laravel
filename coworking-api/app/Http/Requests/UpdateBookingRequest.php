<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Booking;

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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $bookingId = $this->route('id');

            $exists = Booking::where('room_id', $this->room_id ?? $this->booking->room_id)
                ->where('id', '!=', $bookingId)
                ->where('status', '!=', 'cancelled')
                ->where(function ($q) {
                    $q->whereBetween('start_at', [$this->start_at, $this->end_at])
                      ->orWhereBetween('end_at', [$this->start_at, $this->end_at])
                      ->orWhere(function ($q2) {
                          $q2->where('start_at', '<', $this->start_at)
                             ->where('end_at', '>', $this->end_at);
                      });
                })
                ->exists();

            if ($exists) {
                $validator->errors()->add('room_id', 'This room is already booked in that time range.');
            }
        });
    }
}
