<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Feedback extends Model
{
    use SoftDeletes;
    //Relationship
    public function review()
    {
        return $this->hasOne(
            Review::class,
            'id',
            'review_id'
        );
    }
    public function question()
    {
        return $this->hasOne(
            Question::class,
            'id',
            'question_id'
        );
    }
    public function question()
    {
        return $this->hasOne(
            Question::class,
            'id',
            'user_id'
        );
    }

    public function user()
    {
        return $this->hasOne(
            User::class,
            'id',
            'user_id'
        );
    }
}
