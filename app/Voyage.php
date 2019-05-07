<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    //
    public function voyageur()
    {
        return $this->belongsTo('App\User');
    }
    public function itineraire()
    {
        return $this->belongsTo('App\Itineraire');
    }
}
