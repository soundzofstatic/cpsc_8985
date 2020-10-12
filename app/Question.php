<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //Relationships
    public function user()
    {
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

    public function originalFeedback() {
        return $this->hasOne(
            Feedback::class,
            'id',
            'feedback_id'
        )
        ->where('sequence_number', '=', 0);
    }

    public function feedbacks() {
        return $this->hasMany(
            Feedback::class,
            'id',
            'feedback_id'
        );
    }

}