<?php

use Illuminate\Database\Seeder;

class PromotedBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = \App\Business::get();
        $users = \App\User::has('admin')
            ->get();

        $promotedBusinesses = \App\PromotedBusiness::get();

        if($promotedBusinesses->count() < 5) {

            for($i=0;$i<=5;$i++) {

                $business = $businesses[rand(0, ($businesses->count()-1))];
                $promoLocation = \App\PromotedBusiness::LOCATIONS[rand(0, (count(\App\PromotedBusiness::LOCATIONS)-1))];

                $exists = \App\PromotedBusiness::where('business_id', '=', $business->id)
                    ->where('promo_location', '=', $promoLocation)
                    ->first();

                if(!$exists) {

                    // Determine if userId should be set
                    $setActive = rand(0, 1);

                    $start = \Carbon\Carbon::now()->addDays(rand(2, 5));
                    $end = \Carbon\Carbon::now()->addDays(rand(6, 10));

                    $promotedBusinesses = new \App\PromotedBusiness();
                    $promotedBusinesses->user_id = $users[rand(0, ($users->count() - 1))]->id;
                    $promotedBusinesses->business_id = $business->id;
                    $promotedBusinesses->is_active = (boolean)$setActive;
                    $promotedBusinesses->start_date = $start;
                    $promotedBusinesses->end_date = $end;
                    $promotedBusinesses->promo_location = $promoLocation;
                    $promotedBusinesses->save();

                }

            }

        } else {

            echo "No need to seed Promoted Businesses. At least 3 already exist." . PHP_EOL;

        }
    }
}
