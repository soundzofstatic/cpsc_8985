<?php

use Illuminate\Database\Seeder;

class BusinessVisitSeeder extends Seeder
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

        if($businesses->count() < 100) {

            foreach($businesses as $business) {

                $randomNumber = rand(10, 20);

                for($i=0;$i<=$randomNumber;$i++) {

                    // Determine if userId should be set
                    $setUserId = rand(0, 1);

                    $visit = new \App\BusinessVisit();
                    if($setUserId) {

                        $visit->user_id = $users[rand(0, ($users->count()-1))]->id;

                    }
                    $visit->business_id = $business->id;
                    $visit->save();

                }

            }

        } else {

            echo "No need to seed Business Visits. At least 100 visits already exist." . PHP_EOL;

        }
    }
}
