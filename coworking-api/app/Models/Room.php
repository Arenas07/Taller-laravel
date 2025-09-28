<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Space;
use App\Models\amenity_room;
use App\Models\Booking;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id',
        'name',
        'capacity',
        'type',
        'is_active',
    ];

    public function spaces()
    {
        return $this->belongsTo(Space::class, 'space_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class)->using(amenity_room::class)->withTimestamps();
    }

    public function bookings()
    {
        return $this->belongsTo(Booking::class);
    }
}
