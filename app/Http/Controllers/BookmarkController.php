<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Business;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
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
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function show(Bookmark $bookmark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookmark $bookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookmark $bookmark)
    {
        //
    }

    /**
     * @param User $user
     * @param Bookmark $bookmark
     */
    public function markPublic(User $user, Bookmark $bookmark)
    {

        try {

            if($user->id != Auth::user()->id) {

                throw new \Exception('Authenticated user must match the user who owns business.');

            }

            if($user->id != $bookmark->user_id) {

                throw new \Exception('Bookmark does not belong to the user making the request.');

            }

            if($bookmark->is_public) {

                throw new \Exception('Bookmark is already public.');

            }

            $bookmark->is_public = true;
            $bookmark->save();

            return redirect()
                ->route('console.user.reviewer.home', ['user' => $user->id]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    /**
     * @param User $user
     * @param Bookmark $bookmark
     */
    public function markPrivate(User $user, Bookmark $bookmark)
    {

        try {

            if($user->id != Auth::user()->id) {

                throw new \Exception('Authenticated user must match the user who owns business.');

            }

            if($user->id != $bookmark->user_id) {

                throw new \Exception('Bookmark does not belong to the user making the request.');

            }

            if(!$bookmark->is_public) {

                throw new \Exception('Bookmark is already private.');

            }

            $bookmark->is_public = false;
            $bookmark->save();

            return redirect()
                ->route('console.user.reviewer.home', ['user' => $user->id]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }
}
