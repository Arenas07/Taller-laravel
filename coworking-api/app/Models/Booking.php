<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\Room;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'member_id',
        'room_id',
        'start_at',
        'end_at',
        'status',
        'purpose', 
    ];

    public function Member(){
        return $this->belongsTo(Member::class);
    }

    public function Room(){
        return $this->belongsTo(Room::class);
    }
}
