<?php

use Illuminate\Database\Seeder;

class BusinessSocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = \App\Business::get();

        foreach($businesses as $business) {

            if ($business->businessSocialMedia->count() < 1) {

                $randomNumber = rand(0, (count(\App\BusinessSocialMedia::SOCIAL_MEDIA_PROVIDERS) -1));

                for ($i = 0; $i <= $randomNumber; $i++) {

                    $faker = Faker\Factory::create('en_US');

                    $socialMedia = new \App\BusinessSocialMedia();
                    $socialMedia->business_id = $business->id;
                    $socialMedia->social_media_provider = \App\BusinessSocialMedia::SOCIAL_MEDIA_PROVIDERS[$i];
                    $socialMedia->social_media_link = $faker->url;
                    $socialMedia->save();

                }

            }

        }
    }
}
