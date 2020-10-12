<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UsersTableSeeder::class,
             AdminUserSeeder::class,
             BusinessTableSeeder::class,
             BusinessVisitSeeder::class,
             BusinessCheckInSeeder::class,
             ServicesSeeder::class,
             BusinessServicesSeeder::class,
             BusinessSocialMediaSeeder::class,
             PromotedBusinessSeeder::class,
             BookmarkSeeder::class,
             BusinessEventSeeder::class, // todo - Define
             ReviewSeeder::class,
             QuestionSeeder::class
         ]);
    }
}
