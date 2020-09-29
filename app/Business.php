<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
    public function businessVisit()
    {
        return $this->hasMany(
            BusinessVisit::class,
            'business_id',
            'id'
        );
    }
    }
