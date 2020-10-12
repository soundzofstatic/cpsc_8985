<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessSocialMedia extends Model
{
    const SOCIAL_MEDIA_PROVIDERS = [
      'Twitter',
      'Facebook',
      'Instagram',
      'YouTube'
    ];

    public function business()
    {
        return $this->belongsTo(
            Business::class,
            'business_id',
            'id'
        );
    }

}
