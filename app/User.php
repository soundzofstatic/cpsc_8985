<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function admin() {
        return $this->hasOne(
            Admin::class,
            'user_id',
            'id'
        );
    }
    public function googleToken() {
        return $this->hasOne(
            GoogleToken::class,
            'user_id',
            'id'
        );
    }
    public function alerts() {
        return $this->hasMany(
            Alert::class,
            'user_id',
            'id'
        );
    }
    public function reviews() {
        return $this->hasMany(
            Review::class,
            'user_id',
            'id'
        );
    }
//    public function Review() { todo - This is a duplicate relationship, see above.
//        return $this->hasMany(
//            Review::class,
//            'Name',
//            'Email_id'
//        );
//    }
    public Function lastFiveReviews()
    {
        return $this->hasMany(
            Review::class,
            'user_id',
            'id'
        )
            ->limit(5)
            ->orderBy('created_at','desc');
    }
    public function questions() {
        return $this->hasMany(
            Question::class,
            'user_id',
            'id'
        );
    }
    public function feedback() {
        return $this->hasMany(
            Feedback::class,
            'user_id',
            'id'
        );
    }
    public function businesses() {
        return $this->hasMany(
            Business::class,
            'user_id',
            'id'
        );
    }
    public function businessVisits() {
        return $this->hasMany(
            BusinessVisit::class,
            'user_id',
            'id'
        );
    }
    public function businessCheckIns() {
        return $this->hasMany(
            BusinessCheckIn::class,
            'user_id',
            'id'
        )
            ->orderBy('created_at', 'desc');
    }
    public Function lastFiveBusinessCheckIns()
    {
        return $this->hasMany(
            BusinessCheckIn::class,
            'user_id',
            'id'
        )
            ->limit(5)
            ->orderBy('created_at','desc');
    }
    public function bookmarks() {
        return $this->hasMany(
            Bookmark::class,
            'user_id',
            'id'
        );
    }
    public function publicBookmarks() {
        return $this->hasMany(
            Bookmark::class,
            'user_id',
            'id'
        )
            ->where('is_public', '=', true);
    }
    public function promotedBusinesses() {
        return $this->hasMany(
            PromotedBusiness::class,
            'user_id',
            'id'
        );
    }


    /**
     * Method that denotes whether an User is an admin or not
     *
     * @return bool
     */
    public function isAdmin()
    {
        if(empty($this->admin)) {

            return false;

        } else {

            return true;

        }

    }
}
