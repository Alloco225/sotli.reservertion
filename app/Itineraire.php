<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    protected $guarded = [];
    
    // protected $fillable = [
    //     "ville_depart", "ville_destination",
    //     "prix", 
    //     "depart_1", "depart_2", "depart_3",
    //     "depart_dernier",
    // ];
    public function ville_depart()
    {
        return $this->belongsTo(Ville::class, 'depart');
    }
    public function ville_destination()
    {
        return $this->belongsTo(Ville::class, 'destination');
    }
    public function horaires()
    {
        return $this->hasMany(Depart::class);
    }
}
