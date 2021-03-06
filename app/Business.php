<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;
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
            'business_id'
        )
            ->orderBy('created_at', 'DESC');

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
            'business_id',
            'id'
        );
    }
    public function bookmarks()
    {
        return $this->hasMany(
            Bookmark::class,
            'business_id',
            'id'
        );
    }
    public function questions()
    {
        return $this->hasMany(
            Question::class,
            'business_id',
            'id'
        );
    }
    public function reviews()
    {
        return $this->hasMany(
            Review::class,
            'business_id',
            'id'
        )
            ->orderBy('created_at', 'DESC');

    }

    public function lastHundredReviews()
    {
        return $this->hasMany(
            Review::class,
            'business_id',
            'id'
        )
            ->limit(100)
            ->orderBy('created_at', 'DESC');

    }

    public function lastHundredQuestions()
    {
        return $this->hasMany(
            Question::class,
            'business_id',
            'id'
        )
            ->limit(100)
            ->orderBy('created_at', 'DESC');

    }

    public function alerts()
    {
        return $this->hasMany(
            Alert::class,
            'business_id',
            'id'
        );
    }

    /**
     * Relationship that defaults the first uploaded photo for the business as the main photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainPhoto() {
        return $this->hasOne(
            'App\\FileUpload',
            'business_id',
            'id'
        )
            ->where('upload_type', '=', 'business.photo')
            ->orderBy('created_at', 'ASC');
    }

    public function photos() {
        return $this->hasMany(
            'App\\FileUpload',
            'business_id',
            'id'
        )
            ->where('upload_type', '=', 'business.photo')
            ->orderBy('created_at', 'ASC');
    }

    public function rating()
    {
        return round($this->reviews->avg('rating'), 1);
    }

    public function servicesAsStringId()
    {
        $stringOfIds = '';

        foreach($this->businessService as $businessService) {

            $stringOfIds .= $businessService->service_id . ',';

        }

        return trim($stringOfIds, ',');
    }
}
