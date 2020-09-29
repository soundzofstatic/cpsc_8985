<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessSocialMedia extends Model
{
    public function business()
    {
        return $this->belongsTo(
            Business::class,
            'business_id',
            'id'
        );
    }

}
