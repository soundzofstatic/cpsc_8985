<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotedBusiness extends Model
{
    use SoftDeletes;
    const LOCATIONS = [
        'location_1',
        'location_3',
        'location_2'
    ];

    protected $dates = [
            'start_date',
            'end_date'
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
