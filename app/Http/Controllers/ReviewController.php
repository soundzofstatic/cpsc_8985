<?php

namespace App\Http\Controllers;

use App\Business;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        //dd($request->all());
        if (Auth::check()) {

            $user = Auth::user();

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

            // Update the $review with the feedback_id
            $review->feedback_id = $feedback->id;
            $review->save();

            return redirect()->route('business.home' , ['business'=>$request->input('business_id')]);
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
     * @param  \App\Review  $review
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
}
