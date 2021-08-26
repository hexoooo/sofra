<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}