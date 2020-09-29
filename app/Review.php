<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //Relationships
    public function user() {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
    public function business() {
        return $this->belongsTo(
            Business::class,
            'business_id',
            'id'
        );
    }
}
