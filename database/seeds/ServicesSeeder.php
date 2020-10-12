<?php

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
          'Drive-thru',
          'Carry-out',
          'Outdoor Dining',
          'Pet Friendly'
        ];

        foreach($services as $service) {

            $existingService = \App\Service::where('name', '=', strtolower($service))
                ->first();

            if(empty($existingService)) {
                // Add the service to the DB, it doesn't exist
                $newService = new \App\Service();
                $newService->name = strtolower($service);
                $newService->save();

            }

        }

    }
}
