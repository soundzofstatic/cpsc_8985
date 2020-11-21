<?php


namespace App\Helpers;


use App\Business;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        if($alert_type == 'user.question.store') {

            // Create an alert for the Business Owner
            $businessOwnerAlert = new \App\Alert();
            $businessOwnerAlert->user_id = $business->user->id;
            $businessOwnerAlert->business_id = $business->id;
            $businessOwnerAlert->is_viewed = false;
            $businessOwnerAlert->text = $text;
            $businessOwnerAlert->alert_type = $alert_type;
            $businessOwnerAlert->save();

        }

    }

    /**
     * Method used to collect together a bunch of alerts
     *
     * @return \Illuminate\Support\Collection
     */
    public static function unread()
    {
        try {

            if(!Auth::check()) {

                throw new \Exception('An authenticated user does not exist.');

            }

            $alerts = [];

            foreach(Auth::user()->alerts as $alert) {

                if((boolean)$alert->is_viewed == false) {
                    $alerts[$alert->id] = $alert;
                }

            }

            foreach(Auth::user()->businesses as $business) {

                foreach($business->alerts as $alert) {
                    if((boolean)$alert->is_viewed  == false) {
                        $alerts[$alert->id] = $alert;
                    }
                }

            }

            return collect($alerts);

        } catch (\Exception $e) {

            return collect();

        }

    }

    /**
     * Method used to mark an alert as read
     *
     * @param \App\Alert $alert
     */
    public static function markRead(\App\Alert $alert)
    {
        try {

            if(!Auth::check()) {

                throw new \Exception('An authenticated user does not exist.');

            }

            $alert->is_viewed = true;
            $alert->save();

        } catch (\Exception $e) {

            Log::error($e->getMessage());

        }

    }

}