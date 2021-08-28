<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function token()
    {
        return $this->morphMany('App\Models\NotificationToken', 'tokenable');
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'phone',
        'region_id',

    ];
    protected $hidden=[
        'password',
        'api_token'
    ];

}