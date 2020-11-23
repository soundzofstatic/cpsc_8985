<?php

namespace App\Http\Controllers;

use App\Business;
use App\PromotedBusiness;
use App\User;
use Carbon\Carbon;
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
    public function create(User $user, Business $business, request $request)
    {
        try {

//            if($user->id != Auth::user()->id) {
//
//                throw new \Exception('Requesting user must be the Authenticated user.');
//
//            }

            if(!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            // todo - Show the user the create a promoted business form

            return view('console.user.business.promote')
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

            // Store the data to a new PromotedBusiness()
            $promotedBusiness = new PromotedBusiness();
            $promotedBusiness->user_id = $user->id;
            $promotedBusiness->business_id = $business->id;
            $promotedBusiness->is_active = true;
            $promotedBusiness->start_date = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
            $promotedBusiness->end_date = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
            $promotedBusiness->promo_location = $request->input('promo_location');
            $promotedBusiness->save();

            return redirect()->route('console.user.businesses.business.business-console', ['user'=> Auth::user()->id, 'business' => $business->id])
                ->with(
                    [
                        'message' => 'Successfully promoted business: ' . $business->name
                    ],
                    compact(
                        [
                            'business'
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
    public function destroy(User $user, PromotedBusiness $promotedBusiness)
    {
        try {

            if(Auth::check()) {

                if(!Auth::user()->isAdmin()) {

                    throw new \Exception('Promotion can only be removed by admins.');

                }

                $promotedBusiness->delete();

                return redirect()
                    ->back()
                    ->with(['message' => 'Successfully deleted Business Promotion.']);

            } else {

                return redirect()
                    ->route('login')
                    ->withErrors(['Must be logged in before you can delete a Business Promotion.']);

            }

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
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
