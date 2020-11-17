<?php

namespace App\Http\Controllers;

use App\Business;
use App\PromotedBusiness;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PromotedBusinessController extends Controller
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
    public function create(User $user, Business $business)
    {
        try {

            if($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the Authenticated user.');

            }

            if(!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            // todo - Show the user the create a promoted business form
            dd('Hi, Mythri - Render a view that is a create form for a PromotedBusiness. Collect the start_date, end_date, and promo_location in your form.');

            return view('')
                ->with(compact([
                    'user',
                    'business'
                ]));


        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Business $business, Request $request)
    {
        try {

            if ($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the Authenticated user.');

            }

            if(!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            // todo - Store the data to a new PromotedBusiness()
            dd('Hi Mythri - Store the data that you collected in your form.');

            return redirect()
                ->back
                ->with(
                    [
                        'message' => 'Successfully promoted business: ' . $business->name
                    ]
                );


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
     * @param  \App\PromotedBusiness  $promotedBusiness
     * @return \Illuminate\Http\Response
     */
    public function show(PromotedBusiness $promotedBusiness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PromotedBusiness  $promotedBusiness
     * @return \Illuminate\Http\Response
     */
    public function edit(PromotedBusiness $promotedBusiness)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PromotedBusiness  $promotedBusiness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromotedBusiness $promotedBusiness)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PromotedBusiness  $promotedBusiness
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromotedBusiness $promotedBusiness)
    {
        //
    }

    public function disablePromotion(User $user, PromotedBusiness $promotedBusiness)
    {

        try {

            if($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the authenticated user.');

            }

            if(!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            $promotedBusiness->is_active = false;
            $promotedBusiness->save();

            return redirect()
                ->back()
                ->with(['message' => 'Successfully disabled promotion: ' . $promotedBusiness->business->name]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    public function enablePromotion(User $user, PromotedBusiness $promotedBusiness)
    {

        try {

            if($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the authenticated user.');

            }

            if(!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            $promotedBusiness->is_active = true;
            $promotedBusiness->save();

            return redirect()
                ->back()
                ->with(['message' => 'Successfully enabled business: ' . $promotedBusiness->business->name]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    public function listAllPromotions(User $user) // todo - This method is not named properly, it used for querying, not listing all Businesses
    {

        try {

            $promotedBusinesses = PromotedBusiness::get();

            return view('console.user.admin.list-promoted-businesses')
                ->with(
                    compact(
                        [
                            'promotedBusinesses'
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
