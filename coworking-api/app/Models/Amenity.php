<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\amenity_room;

class Amenity extends Model
{
    /** @use HasFactory<\Database\Factories\AmenityFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'name', 
    ];

    public function Room() {
        return $this->belongsToMany(Room::class)->using(amenity_room::class)->withTimestamps;
    }
}
