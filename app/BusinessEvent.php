<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessEvent extends Model
{
    use SoftDeletes;
    //
    public function user() {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
    public function Business()
    {
        return $this->hasOne(
            Business::class,
            'user_id',
            'id'
        );
    }
}
