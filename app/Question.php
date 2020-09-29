<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //Relationships
    public function user()
    {
        public function questions() {
        return $this->hasMany(
            Question::class,
            'user_id',
            'id'
        );
    }
    }

}