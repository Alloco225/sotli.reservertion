<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depart extends Model
{
    //
    protected $guarded = [];

    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class);
    }
    public function voyage()
    {
        return $this->hasMany(DepartVoyageur::class);
    }
}
