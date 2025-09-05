<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'booking_id',
        'method',
        'amount',
        'status',
         
    ];

    public function Booking() {
        return $this->belongsTo(Booking::class);
    }
}
