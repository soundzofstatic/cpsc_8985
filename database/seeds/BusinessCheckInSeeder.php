<?php

use Illuminate\Database\Seeder;

class BusinessCheckInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = \App\Business::get();
        $users = \App\User::get();

        if($businesses->count() < 50) {

            foreach($businesses as $business) {

                $randomNumber = rand(5, 20);

                for($i=0;$i<=$randomNumber;$i++) {

                    $checkIn = new \App\BusinessCheckIn();
                    $checkIn->user_id = $users[rand(0, ($users->count()-1))]->id;
                    $checkIn->business_id = $business->id;
                    $checkIn->save();

                }

            }

        } else {

            echo "No need to seed Business Check-ins. At least 50 check-ins already exist." . PHP_EOL;

        }
    }
}
