<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;

    public function regions()
    {
        return $this->hasMany('App\Models\Region');
    }

}