<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'number',
        'issued_date',
        'meta',
         
    ];

    protected $casts = [
    'meta' => 'array',
    ];


    public function Payment(){
        return $this->belongsTo(Payment::class);
    }
}
