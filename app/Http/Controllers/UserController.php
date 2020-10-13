<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $countOfCheckIns = $user->businessCheckIns->count();

        // Call User Blade for anonymous viewing
        return view('user.home')
            ->with(
                compact(
                    [
                        'user',
                        'countOfCheckIns'
                    ]
                )
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        try {

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->save();

            return redirect()
                ->back()
                ->with('message', 'Successfully updated user details.');

        } catch (\Exception $e) {

            Log::error($e->getMessage()); // Log the Error to storage/logs

            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Set or Update the username.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function username(Request $request)
    {
        try{

            if(empty($request->input('username'))) {
                throw new \Exception('Username cannot be blank.');
            }

            // Set the username
            Auth::user()->username = $request->input('username');
            Auth::user()->save();

            return redirect()->route('console.home'); // todo - send back message of successful setting

        } catch (\Exception $e) {

            // todo - log the error
            return redirect()->back(); // todo - send back with errors


        }

    }

    /**
     * Update password for a user
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, User $user)
    {

        try {

            if(empty($request->input('password')) OR empty($request->input('password'))) {

                throw new \Exception('Password or confirmation left empty. Please provide both.');

            }

            if(strlen($request->input('password')) < 8) {

                throw new \Exception('Password must be 8 characters in length.');

            }

            if($request->input('password') != $request->input('password_confirmation')) {

                throw new \Exception('Password must match password confirmation.');

            }

            $user->password = bcrypt($request->input('password'));
            $user->save();

            return redirect()
                ->back()
                ->with('message', 'Successfully updated user password.');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
    }

    /**
     * Method used to promote a user to be an application administrator
     *
     * @param User $user
     */
    public function promoteToAdmin(User $user)
    {

        try {

            if($user->isAdmin()) {

                throw new \Exception('User is already an administrative user.');

            }

            $admin = new Admin();
            $admin->user_id = $user->id;
            $admin->save();

            return redirect()
                ->back()
                ->with('message', 'Successfully promoted user to application administrator.');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    /**
     * Method used to demote a user to a regular reviewer user
     *
     * @param User $user
     */
    public function demoteFromAdmin(User $user)
    {

        try {

            if(!$user->isAdmin()) {

                throw new \Exception('User is not an administrative user.');

            }

            $user->admin->delete();

            return redirect()
                ->back()
                ->with('message', 'Successfully demoted user to application administrator.');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    /**
     * Method used to demote a user to a regular reviewer user
     *
     * @param User $user
     */
    public function reviewerConsoleIndex(User $user)
    {

        try {

            // todo - Get last 5 Reviews for $user from the database
   // dd($user->lastFiveReviews);


            // todo - Get last 5 check-ins for $user from the database

            // todo - Get bookmarks $user from the database

            return view('console.user.reviewer.home')
                ->with(compact([
                    'user'
                ]));

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    /**
     * Method used to demote a user to a regular reviewer user
     *
     * @param User $user
     */
    public function businessConsoleIndex(User $user)
    {

        try {

            return view('console.user.business.home');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }
}
