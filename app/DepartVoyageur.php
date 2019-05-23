<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartVoyageur extends Model
{
    //
    protected $guarded = [];
    
    public function depart()
    {
        return $this->belongsTo(Depart::class);
    }
    public function voyageur()
    {
        return $this->belongsTo(User::class);
    }
}
