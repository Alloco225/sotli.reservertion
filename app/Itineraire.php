<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    //
    // protected $fillable = [
    //     "ville_depart", "ville_arrivee",
    //     "prix", 
    //     "depart_1", "depart_2", "depart_3",
    //     "depart_dernier",
    // ];
    public function ville_depart()
    {
        return $this->belongsTo('App\Ville');
    }
    public function ville_arrivee()
    {
        return $this->belongsTo('App\Ville');
    }
}
