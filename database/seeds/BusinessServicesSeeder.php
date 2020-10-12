<?php

use Illuminate\Database\Seeder;

class BusinessServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = \App\Business::get();
        $services = \App\Service::get();

        foreach($businesses as $business) {

            if ($business->businessService->count() < 1) {


                $randomNumber = rand(1, ($services->count() -1));

                for ($i = 0; $i <= $randomNumber; $i++) {

                    $businessService = new \App\BusinessService();
                    $businessService->service_id = $services[rand(0, ($services->count() - 1))]->id;
                    $businessService->business_id = $business->id;
                    $businessService->save();

                }

            }

        }
    }
}
