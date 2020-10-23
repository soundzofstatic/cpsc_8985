<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
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

        $reviews = \App\Review::get();

        if($reviews->count() < 300) {

            $randomReviewCount = rand(15, 20);

            foreach($businesses as $business) {

                for($i=0;$i<$randomReviewCount;$i++) {

                    $faker = Faker\Factory::create('en_US');

                    $user = $users[rand(0, ($users->count() -1))];

                    $review = new \App\Review();
                    $review->user_id = $user->id;
                    $review->business_id = $business->id;
                    $review->feedback_id = null;
                    $review->is_active = true;
                    $review->rating = rand(0,5);
                    $review->save();

                    // Now Set the feedback associated with the review
                    $feedback = new \App\Feedback();
                    $feedback->user_id = $user->id;
                    $feedback->review_id = $review->id;
                    $feedback->question_id = null;
                    $feedback->reply_on_type = null;
                    $feedback->reply_on_feedback_id = null;
                    $feedback->sequence_number = 0;
                    $feedback->text = $faker->paragraph(rand(2, 4), true);
                    $feedback->save();

                    // Update the $review with the feedback_id
                    $review->feedback_id = $feedback->id;
                    $review->save();

                }

            }

        }

        $replies = \App\Feedback::where('reply_on_feedback_id', '!=', NULL)
            ->where('review_id', '!=', NULL)
            ->where('sequence_number', '=', 1)
            ->get();

        // Check how initial replies exist
        if($replies->count() == 0) {

            $reviews = \App\Review::get();

            foreach($reviews as $review) {

                $faker = Faker\Factory::create('en_US');

                // Now Set the feedback associated with the Review
                $feedback = new \App\Feedback();
                $feedback->user_id = $review->business->user->id;
                $feedback->review_id = $review->id;
                $feedback->question_id = null;
                $feedback->reply_on_type = \App\Review::class;
                $feedback->reply_on_feedback_id = $review->originalFeedback->id; // the original Feedback on the Review
                $feedback->sequence_number = $review->originalFeedback->sequence_number + 1;
                $feedback->text = $faker->paragraph(rand(1, 2), true);
                $feedback->save();

            }

        }

        $replies = \App\Feedback::where('reply_on_feedback_id', '!=', NULL)
            ->where('review_id', '!=', NULL)
            ->where('sequence_number', '>', 1)
            ->get();

        // Check how many secondary replies exist
        if($replies->count() == 0) {

            $reviews = \App\Review::get();

            foreach($reviews as $review) {

                $randomSecondaryRepliesCount = rand(1, 3);

                for($i=0;$i<=$randomSecondaryRepliesCount;$i++) {

                    $faker = Faker\Factory::create('en_US');

                    $user = $users[rand(0, ($users->count() -1))];

                    // Get the last Feedback for this review
                    $lastFeedback = \App\Feedback::where('review_id', '=', $review->id)
                        ->orderBy('sequence_number', 'desc')
                        ->first();

                    // Now Set the feedback associated with the Review
                    $feedback = new \App\Feedback();
                    $feedback->user_id = $user->id;
                    $feedback->review_id = $review->id;
                    $feedback->question_id = null;
                    $feedback->reply_on_type = \App\Review::class;
                    $feedback->reply_on_feedback_id = $lastFeedback->id; // the original Feedback on the Review
                    $feedback->sequence_number = $lastFeedback->sequence_number + 1;
                    $feedback->text = $faker->paragraph(rand(1, 1), true);
                    $feedback->save();

                }

            }

        }

    }
}
