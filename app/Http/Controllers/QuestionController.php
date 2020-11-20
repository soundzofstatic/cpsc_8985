<?php

namespace App\Http\Controllers;

use App\Business;
use App\Feedback;
use App\Helpers\Alert;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function create(Business $business)
    {
        //dd($business);

        return view('forms.question')
            ->with(compact([
                'business'
            ]));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth::check()) {

            $user = Auth::user();
            $business = Business::where('id', '=', $request->input('business_id'))
                ->first();

            $question = new \App\Question();
            $question->user_id = $user->id;
            $question->business_id = $business->id;
            $question->feedback_id = null;
            $question->is_active = true;
            $question->save();

            // Save a Notification Alert
            Alert::createAlert(
                'user.question.store',
                'Successfully asked a question',
                $user,
                $business
            );

            // Now Set the feedback associated with the review
            $feedback = new \App\Feedback();
            $feedback->user_id = $user->id;
            $feedback->question_id = $question->id;
            $feedback->reply_on_type = null;
            $feedback->reply_on_feedback_id = null;
            $feedback->sequence_number = 0;
            $feedback->text = $request->input('question');
            $feedback->save();

            // Update the $review with the feedback_id
            $question->feedback_id = $feedback->id;
            $question->save();

            return redirect()->back();

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    /**
     * @param User $user
     * @param Review $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableQuestion(User $user, Review $question)
    {

        try {

            if($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the authenticated user.');

            }

            if(!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            $question->is_active = false;
            $question->save();

            return redirect()
                ->back()
                ->with(['message' => 'Successfully disabled question: ' . $question->id]);
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
    }

    public function reply(Request $request)
            {
                try {

                    if (Auth::check()) {

                        $lastFeedback = Feedback::where('review_id', '=', $request->input('review_id'))
                            ->orderBy('sequence_number', 'DESC')
                            ->first();
                        $user = Auth::user();
                        $business = Business::where('id', '=', $request->input('business_id'))
                            ->first();

                        // Now Set the feedback associated with the review
                        $feedback = new \App\Feedback();
                        $feedback->user_id = $user->id;
                        $feedback->question_id = $request->input('question_id');
                        $feedback->review_id = null;
                        $feedback->reply_on_type = 'App\\Question';
                        $feedback->reply_on_feedback_id = $request->input('feedback_id');
                        $feedback->sequence_number = $lastFeedback->sequence_number + 1;
                        $feedback->text = $request->input('reply');
                        $feedback->save();
                        Alert::createAlert(
                            'user.question.reply',
                            'Successfully answered the question.',
                            $user,
                            $business
                        );

                        // Update the $review with the feedback_id
                        return redirect()
                            ->back()
                            ->with(['message' => 'Successfully answered ']);
                    }

                } catch (\Exception $e) {

                    Log::error($e->getMessage());
                    return redirect()
                        ->back()
                        ->withErrors([$e->getMessage()]);

                }
            }

}
