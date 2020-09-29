<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Feedback extends Model
{
    //Relationship
    public function Review()
    {
        return $this->hasMany(
            User::class,
            'user_id',
            'id'
        );


    }
}
