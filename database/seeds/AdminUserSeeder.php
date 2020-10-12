<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::get();

        $adminsCount = 0;
        foreach($users as $user) {

            if($user->isAdmin()) {

                $adminsCount++;

            }

        }

        if($adminsCount < 5) {

            for($i=0;$i<=5;$i++) {

                $admin = new \App\Admin();
                $admin->user_id = $users[$i]->id;
                $admin->save();

            }

        } else {

            echo "No need to seed Admin Users. At least 5 already exist." . PHP_EOL;

        }
    }
}
