<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function create()
    {

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
            $feedback->reply_on_type = null;
            $feedback->reply_on_feedback_id = null;
            $feedback->sequence_number = 0;
            $feedback->text = $request->input('question');
            $feedback->save();

            // Update the $review with the feedback_id
            $question->feedback_id = $feedback->id;
            $question->save();

            return redirect()->back();
        }}

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
}
