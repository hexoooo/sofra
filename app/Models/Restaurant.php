<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model 
{

    protected $table = 'restaurants';
    public $timestamps = true;

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function token()
    {
        return $this->morphMany('App\Models\NotificationToken', 'tokenable');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'phone',
        'region_id',
        'delivery_charge',
        'minimum_charge',

    ];
    protected $hidden=[
        'password',
        'api_token'
    ];
}