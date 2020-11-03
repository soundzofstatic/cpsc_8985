<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessCheckIn extends Model
{
    use SoftDeletes;
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
