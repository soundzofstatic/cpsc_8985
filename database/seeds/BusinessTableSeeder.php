<?php

use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
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

        if ($businesses->count() < 40) {

            for ($i = 0; $i < 40; $i++) {

                $faker = Faker\Factory::create('en_US');

                $randomDate = \Carbon\Carbon::now()->subDays(rand(5, 180));
                $randomEstDate = \Carbon\Carbon::now()->subYears(rand(0, 50));

                $business = new \App\Business();
                $business->name = $faker->company;
                $business->user_id = $users[rand(0, ($users->count() - 1))]->id;
                $business->is_active = true;
                $business->address = $faker->address;
                $business->hours = '9-9';
                $business->est_date = $randomEstDate->format('m/d/Y');
                $business->description = $faker->realText(215, 2);
                $business->dollar_rating = rand(0, 5);
                $business->web_url = $faker->url;
                $business->menu_url = $faker->url;
                $business->contact_phone = $faker->e164PhoneNumber;
                $business->contact_email = $faker->email;
                $business->view_count = 0;
                $business->setCreatedAt($randomDate);
                $business->setUpdatedAt($randomDate);
                $business->save();

            }

        } else {

            echo "No need to seed Businesses. At least 100 businesses already exist." . PHP_EOL;

        }
    }
}
