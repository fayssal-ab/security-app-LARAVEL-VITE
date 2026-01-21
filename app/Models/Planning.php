<?php

namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;

 class Planning extends Model
{
    protected $fillable =[
        'agent_id',
        'site_id',
        'date',
        'heure_debut',
        'heure_fin'
    ];
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
