<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotedBusiness extends Model
{
    const LOCATIONS = [
        'location_1',
        'location_3',
        'location_2'
    ];

    public function business()
    {
        return $this->belongsTo(
            Business::class,
            'business_id',
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
