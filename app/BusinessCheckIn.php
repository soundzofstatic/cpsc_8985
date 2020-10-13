<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCheckIn extends Model
{
    public function business()
    {
        return $this->hasOne(
            Business::class,
            'id',
            'business_id'
        );
    }
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
}
