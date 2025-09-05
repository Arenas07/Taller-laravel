<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Amenity;
use App\Models\amenity_room;
use App\Models\Space;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'space_id',
        'name',
        'capacity',
        'type',
        'is_active'
    ];

    public function Space(){
        return $this->belongsTo(Space::class);
    }

    public function Amenity() {
        return $this->belongsToMany(Amenity::class)->using(amenity_room::class)->withTimestamps;
    }

}
