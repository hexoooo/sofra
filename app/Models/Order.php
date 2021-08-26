<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}