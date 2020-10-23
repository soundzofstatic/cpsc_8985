<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
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

        $questions = \App\Question::get();

        if($questions->count() < 300) {

            $randomQuestionCount = rand(15, 20);

            foreach($businesses as $business) {

                for($i=0;$i<$randomQuestionCount;$i++) {

                    $faker = Faker\Factory::create('en_US');

                    $user = $users[rand(0, ($users->count() -1))];

                    $question = new \App\Question();
                    $question->user_id = $user->id;
                    $question->business_id = $business->id;
                    $question->feedback_id = null;
                    $question->is_active = true;
                    $question->save();

                    // Now Set the feedback associated with the Question
                    $feedback = new \App\Feedback();
                    $feedback->user_id = $user->id;
                    $feedback->review_id = null;
                    $feedback->question_id = $question->id;
                    $feedback->reply_on_type = null;
                    $feedback->reply_on_feedback_id = null;
                    $feedback->sequence_number = 0;
                    $feedback->text = $faker->paragraph(rand(2, 4), true);
                    $feedback->save();

                    // Update the $question with the feedback_id
                    $question->feedback_id = $feedback->id;
                    $question->save();
                }

            }

        }

        $replies = \App\Feedback::where('reply_on_feedback_id', '!=', NULL)
            ->where('question_id', '!=', NULL)
            ->where('sequence_number', '=', 1)
            ->get();

        // Check how initial replies exist
        if($replies->count() == 0) {

            $questions = \App\Question::get();

            foreach($questions as $question) {

                $faker = Faker\Factory::create('en_US');

                // Now Set the feedback associated with the Question
                $feedback = new \App\Feedback();
                $feedback->user_id = $question->business->user->id;
                $feedback->review_id = null;
                $feedback->question_id = $question->id;
                $feedback->reply_on_type = \App\Question::class;
                $feedback->reply_on_feedback_id = $question->originalFeedback->id; // the original Feedback on the Question
                $feedback->sequence_number = $question->originalFeedback->sequence_number + 1;
                $feedback->text = $faker->paragraph(rand(1, 2), true);
                $feedback->save();

            }

        }

        $replies = \App\Feedback::where('reply_on_feedback_id', '!=', NULL)
            ->where('question_id', '!=', NULL)
            ->where('sequence_number', '>', 1)
            ->get();

        // Check how many secondary replies exist
        if($replies->count() == 0) {

            $questions = \App\Question::get();

            foreach($questions as $question) {

                $randomSecondaryRepliesCount = rand(1, 3);

                for($i=0;$i<=$randomSecondaryRepliesCount;$i++) {

                    $faker = Faker\Factory::create('en_US');

                    $user = $users[rand(0, ($users->count() -1))];

                    // Get the last Feedback for this question
                    $lastFeedback = \App\Feedback::where('question_id', '=', $question->id)
                        ->orderBy('sequence_number', 'desc')
                        ->first();

                    // Now Set the feedback associated with the Question
                    $feedback = new \App\Feedback();
                    $feedback->user_id = $user->id;
                    $feedback->review_id = null;
                    $feedback->question_id = $question->id;
                    $feedback->reply_on_type = \App\Question::class;
                    $feedback->reply_on_feedback_id = $lastFeedback->id; // the original Feedback on the Question
                    $feedback->sequence_number = $lastFeedback->sequence_number + 1;
                    $feedback->text = $faker->paragraph(rand(1, 1), true);
                    $feedback->save();

                }

            }

        }
    }
}
