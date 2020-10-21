<?php

use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookmarks = \App\Bookmark::get();
        $businesses = \App\Business::get();
        $users = \App\User::get();

        if($bookmarks->count() < 50) {

            foreach($users as $user) {

                $randomNumber = rand(5, 10);

                for($i=0;$i<=$randomNumber;$i++) {

                    $business = $users[rand(0, ($users->count()-1))];

                    $exists = \App\Bookmark::where('user_id', '=', $user->id)
                        ->where('business_id', '=', $business->id)
                        ->first();

                    if(!$exists) {

                        $bookmark = new \App\Bookmark();
                        $bookmark->user_id = $user->id;
                        $bookmark->business_id = $business->id;
                        $bookmark->is_public = (bool)rand(0, 1);
                        $bookmark->save();

                    }

                }

            }

        } else {

            echo "No need to seed Business Check-ins. At least 50 check-ins already exist." . PHP_EOL;

        }
    }
}
