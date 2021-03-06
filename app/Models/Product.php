<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = true;

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

}