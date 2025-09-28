<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Booking;
use Illuminate\Validation\Validator;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'member_id' => ['required','exists:members,id'],
            'room_id'   => ['required','exists:rooms,id'],
            'start_at'  => ['required','date','after_or_equal:now'],
            'end_at'    => ['required','date','after:start_at'],
            'purpose'   => ['nullable','string','max:160'],

        ];
    }
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->hasOverlap()) {
                $validator->errors()->add('room_id', 'Ya existe una reserva en este horario para la sala seleccionada.');
            }
        });
    }

    protected function hasOverlap(): bool
    {
        return Booking::where('room_id', $this->room_id)
            ->where(function ($query) {
                $query->whereBetween('start_at', [$this->start_at, $this->end_at])
                    ->orWhereBetween('end_at', [$this->start_at, $this->end_at])
                    ->orWhere(function ($q) {
                        $q->where('start_at', '<=', $this->start_at)
                            ->where('end_at', '>=', $this->end_at);
                    });
            })
            ->exists();
    }
}
