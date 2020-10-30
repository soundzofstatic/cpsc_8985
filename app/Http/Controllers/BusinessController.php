<?php

namespace App\Http\Controllers;

use App\Business;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BusinessController extends Controller
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
        return view('console.user.business.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        try {

            // Because the $user is passed from the route, let's compare it to the Authenticated user
            if($user->id != Auth::user()->id) {

                throw new \Exception('Authenticated user must match the user who owns business.');

            }

            $business = new \App\Business();
            $business->name = $request->input('name');
            $business->user_id = $user->id;

            $business->address = $request->input('address');
            $business->hours = $request->input('hours');
            $business->est_date = Carbon::createFromFormat('Y-m-d', $request->input('established_on'))->format('m/d/Y');
            $business->description = $request->input('description');
            $business->dollar_rating = $request->input('dollar_rating');
            $business->web_url = $request->input('web_url');
            $business->menu_url = $request->input('menu_url');
            $business->contact_phone = $request->input('contact_phone');
            $business->contact_email = $request->input('contact_email');
            $business->view_count = 0;
            $business->is_active = true;
            $business->save();

            return redirect()
                ->route('business.home', ['business' => $business->id]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
//        dd($business);

        return view('business.single-listing')
            ->with(
                compact(
                    [
                        'business'
                    ]
                )
            );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        //
    }

    public function storeReview(Request $request, Business $business)
    {
//        dd($business);
        dd($request->all());

        // todo - Save the information using Relations from the $business Model.

    }

    /**
     * @param Business $business
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showConsole(User $user, Business $business)
    {

        return view('console.user.business.single-listing')
            ->with(
                compact(
                    [
                        'user',
                        'business'
                    ]
                )
            );
    }
    public function listAllBusinesses(Request $request)
    {

        try {

            $businesses = Business::where('name' , 'like', '%'. $request->input('query') . '%')
                ->orWhere('contact_email', 'like', '%'. $request->input('query') . '%')
                ->orWhere('web_url', 'like', '%'. $request->input('query') . '%')
                ->orWhere('contact_phone', 'like', '%'. $request->input('query') . '%')
                ->orderBy('name', 'asc')
                ->orderBy('contact_email', 'asc')
                ->orderBy('contact_phone', 'asc')
                ->orderBy('web_url', 'asc')
                ->get();

            return view('console.user.admin.search-business')
                ->with(
                    compact(
                        [
                            'businesses'
                        ]
                    )
                );

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }
}

