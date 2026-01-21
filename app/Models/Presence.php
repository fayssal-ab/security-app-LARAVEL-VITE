<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'agent_id',
        'date', 
        'statut',
    ];

   
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    
}
