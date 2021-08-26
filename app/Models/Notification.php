<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;

    public function notificationable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

}