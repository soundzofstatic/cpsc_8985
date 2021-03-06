<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Business;
use App\PromotedBusiness;
use App\Question;
use App\Review;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //dd ($user);
        $users = User::limit(5)
            ->orderBy('created_at', 'desc')
            ->get();

        $questions = Question::limit(5)
            ->orderBy('created_at', 'desc')
            ->get();

        $reviews = Review::limit(5)
            ->orderBy('created_at', 'desc')
            ->get();

        $businesses = Business::limit(5)
            ->orderBy('created_at', 'desc')
            ->get();

        $promotedBusinesses = PromotedBusiness::limit(5)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('console.user.admin.home')
            ->with(
                compact([
                    'users',
                    'reviews',
                    'businesses',
                    'promotedBusinesses',
                    'questions'
                ])
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
