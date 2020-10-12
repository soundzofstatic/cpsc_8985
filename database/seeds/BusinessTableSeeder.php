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

        if($businesses->count() < 10) {

            for ($i = 0; $i < 10; $i++) {

                $faker = Faker\Factory::create('en_US');

                $randomDate = \Carbon\Carbon::now()->subDays(rand(5, 180));
                $randomEstDate = \Carbon\Carbon::now()->subYears(rand(0, 50));

                $user = new \App\Business();
                $user->name = $faker->company;
                $user->user_id = $users[rand(0, ($users->count()-1))]->id;
                $user->is_active = true;
                $user->address = $faker->address;
                $user->hours = '9-9';
                $user->est_date = $randomEstDate->format('m/d/Y');
                $user->description = $faker->realText(215, 2);
                $user->dollar_rating = rand(0, 5);
                $user->web_url = $faker->url;
                $user->menu_url = $faker->url;
                $user->contact_phone = $faker->e164PhoneNumber;
                $user->contact_email = $faker->email;
                $user->view_count = 0;
                $user->setCreatedAt($randomDate);
                $user->setUpdatedAt($randomDate);
                $user->save();

            }

        } else {

            echo "No need to seed Businesses. At least 10 users already exist." . PHP_EOL;

        }
    }
}
