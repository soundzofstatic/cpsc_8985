<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = \App\User::get();

        if($users->count() < 11) {

            // Ensure admin_user exists as a user
            $user = new \App\User();
            $user->first_name = 'Admin';
            $user->last_name = 'Admin';
            $user->email = 'admin@fake.com';
            $user->username = 'admin_user';
            $user->password = bcrypt('password');
            $user->save();

            for ($i = 0; $i < 11; $i++) {

                $faker = Faker\Factory::create('en_US');
                $randomDate = \Carbon\Carbon::now()->subDays(rand(5, 180));

                $user = new \App\User();
                $user->first_name = $faker->firstName;
                $user->last_name = $faker->lastName;
                $user->email = $faker->email;
                $user->username = $faker->userName;
                $user->password = bcrypt('password');
                $user->setCreatedAt($randomDate);
                $user->setUpdatedAt($randomDate);
                $user->save();

            }

        } else {

            echo "No need to seed Users. At least 10 users already exist." . PHP_EOL;

        }
    }
}
