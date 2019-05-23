<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    //
    // protected $fillable = ["name"];
    protected $guarded = [];
    
    
    public function depart_itineraires()
    {
        return $this->hasMany(Itineraire::class, 'depart');
    }
    public function destination_itineraires()
    {
        return $this->hasMany(Itineraire::class, 'destination');
    }
}
