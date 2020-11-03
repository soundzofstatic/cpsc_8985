<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessSocialMedia extends Model
{
    use SoftDeletes;
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
