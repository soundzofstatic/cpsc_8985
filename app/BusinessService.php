<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessService extends Model
{
    use SoftDeletes;
    const Business_Service_Providers = [
        'drive-thru',
        'carry-out',
        'outdoor dining',
        'pet friendly',
    ];
    public function Business()
    {
        return $this->hasOne(
            Business::class,
            'user_id',
            'id'
        );
    }
    public function Services()
    {
        return $this->hasOne(
            Service::class,
            'Name',
            'id'
        );
    }
    public function user() {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
}
