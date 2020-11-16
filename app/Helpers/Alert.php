<?php


namespace App\Helpers;


use App\Business;
use App\User;

class Alert
{

    public static function createAlert($alert_type = 'generic', $text = 'Some Alert.', User $user = null, Business $business = null)
    {
        $alert = new \App\Alert();

        if(!empty($user)) {
            $alert->user_id = $user->id;
        }

        if(!empty($business)) {
            $alert->business_id = $business->id;
        }

        $alert->is_viewed = false;
        $alert->text = $text;
        $alert->alert_type = $alert_type;
        $alert->save();

    }

}