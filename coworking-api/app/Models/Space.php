<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Space extends Model
{
    /** @use HasFactory<\Database\Factories\SpaceFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'address'
    ];

    public function Room() {
        return $this->hasMany(Room::class);
    }

}
