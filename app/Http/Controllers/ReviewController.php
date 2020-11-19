<?php

namespace App\Http\Controllers;

use App\Business;
use App\Feedback;
use App\Helpers\Alert;
use App\Review;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Business $business)
    {
       //dd($business);

        return view('forms.review')
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
    public function store(Request $request,business $business)
    {
        //dd($request->all());
        if (Auth::check()) {

            $user = Auth::user();
            $business = Business::where('id', '=', $request->input('business_id'))
                ->first();

            $review = new \App\Review();
            $review->user_id = $user->id;
            $review->business_id = $request->input('business_id');
            $review->feedback_id = null;
            $review->is_active = true;
            $review->rating = $request->input('rating');
            $review->save();

            // Now Set the feedback associated with the review
            $feedback = new \App\Feedback();
            $feedback->user_id = $user->id;
            $feedback->review_id = $review->id;
            $feedback->question_id = null;
            $feedback->reply_on_type = null;
            $feedback->reply_on_feedback_id = null;
            $feedback->sequence_number = 0;
            $feedback->text = $request->input('review');
            $feedback->save();
            // Save a Notification Alert
            Alert::createAlert(
                'user.review.store',
                'Successfully made a review',
                $user,
                $business
            );

            // Update the $review with the feedback_id
            $review->feedback_id = $feedback->id;
            $review->save();

            return redirect()->route('business.home' , ['business'=>$request->input('business_id')]);
        }
    }
    //    Storing Replies

    public function reply(Request $request)
    {
//        dd($request->all());
        try {

            if (Auth::check()) {

                $lastFeedback = Feedback::where('review_id', '=', $request->input('review_id'))
                    ->orderBy('sequence_number', 'DESC')
                    ->first();
                $user = Auth::user();

                // Now Set the feedback associated with the review
                $feedback = new \App\Feedback();
                $feedback->user_id = $user->id;
                $feedback->question_id = null;
                $feedback->review_id = $request->input('review_id');
                $feedback->reply_on_type = 'App\\Feedback';
                $feedback->reply_on_feedback_id = $request->input('feedback_id');
                $feedback->sequence_number = $lastFeedback->sequence_number + 1;
                $feedback->text = $request->input('reply');
                $feedback->save();

                // Update the $review with the feedback_id
                return redirect()
                    ->back()
                    ->with(['message' => 'Successfully added Feedback']);
            }

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
    }

    public function question(Request $request)
    {
        //dd($request->all());
        if (Auth::check()) {
            $user = Auth::user();
            $question = new \App\Question();
            $question->user_id = $user->id;
            $question->business_id = $request->input('business_id');
            $question->feedback_id = null;
            $question->is_active = true;
            $question->save();

            // Now Set the feedback associated with the review
            $feedback = new \App\Feedback();
            $feedback->user_id = $user->id;
            $feedback->question_id = $question->id;
            $feedback->reply_on_type = 'App\\Question';
            $feedback->reply_on_feedback_id = $request->input('feedback_id');
            $feedback->sequence_number = 0;
            $feedback->text = $request->input('question');
            $feedback->save();

            // Update the $quesiton with the feedback_id
            $question->feedback_id = $feedback->id;
            $question->save();
            return redirect()
                ->back()
                ->with(['message' => 'Successfully added question']);
        }
    }

            /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review`
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }

    /**
     * @param User $user
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableReview(User $user, Review $review)
    {

        try {

            if($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the authenticated user.');

            }

            if(!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            $review->is_active = false;
            $review->save();

            return redirect()
                ->back()
                ->with(['message' => 'Successfully disabled review: ' . $review->id]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    /**
     * @param User $user
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enableReview(User $user, Review $review)
    {

        try {

            if($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the authenticated user.');

            }

            if(!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            $review->is_active = true;
            $review->save();

            return redirect()
                ->back()
                ->with(['message' => 'Successfully enabled review: ' . $review->id]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }
}
