<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    public function businessVisit()
    {
        return $this->hasMany(
            BusinessVisit::class,
            'business_id',
            'id'
        );

    }
    public function businessService()
    {
        return $this->hasMany(
            BusinessService::class,
            'business_id',
            'id'
        );

    }
    public function businessCheckIn()
    {
        return $this->hasMany(
            BusinessCheckIn::class,
            'business_id',
            'id'
        );

    }
    public function businessEvent()
    {
        return $this->hasMany(
            BusinessEvent::class,
            'business_id',
            'id'
        );

    }
    public function businessSocialMedia()
    {
        return $this->hasMany(
            BusinessSocialMedia::class,
            'business_id',
            'id'
        );
    }
    public function promotedBusiness()
    {
        return $this->hasOne(
            promotedBusiness::class,
            'user_id',
            'id'
        );
    }
    public function Bookmark()
    {
        return $this->hasOne(
            Business::class,
            'user_id',
            'id'
        );
    }
    public function question()
    {
        return $this->hasOne(
            Question::class,
            'user_id',
            'id'
        );
    }
    public function reviews()
    {
        return $this->hasMany(
            Review::class,
            'business_id',
            'id'
        );

    }

    public function alert()
    {
        return $this->hasOne(
            Alert::class,
            'user_id',
            'id'
        );
    }

    public function rating()
    {
        return round($this->reviews->avg('rating'), 1);
    }
}
