<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

 class Site extends Model
{
    protected $fillable =[
        'nom',
        'adresse'
    ];
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }
}


