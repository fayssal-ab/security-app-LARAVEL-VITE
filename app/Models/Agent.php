<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Agent extends Model
{
    protected $fillable = [
        'nom',
        'telephone', 
        'adresse',
        'user_id',
    ];

   public function user()
{
    return $this->belongsTo(User::class);
}
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }
    public function presences()
    {
    return $this->hasMany(Presence::class);

    }
}
