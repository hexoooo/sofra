<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationToken extends Model 
{

    protected $table = 'notification_tokens';
    public $timestamps = true;

    public function tokenable()
    {
        return $this->morphTo();
    }

}