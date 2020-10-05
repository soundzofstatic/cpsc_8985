<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCheckIn extends Model
{
    public function Business()
    {
        return $this->hasOne(
            Business::class,
            'user_id',
            'id'
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
