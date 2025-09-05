<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Plan;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'plan_id',
        'company',
        'joined_at',       
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Plan(){
        return $this->belongsTo(Plan::class);
    }
}
