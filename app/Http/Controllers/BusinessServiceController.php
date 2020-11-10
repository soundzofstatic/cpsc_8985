<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessService;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BusinessServiceController extends Controller
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

            if($user->id != $business->user_id) {

                throw new \Exception('Requesting user must be the business owner.');

            }

            $services = Service::orderBy('name', 'ASC')
                ->get();

            return view('forms.create-service')
                ->with(compact([
                    'user',
                    'business',
                    'services'
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(User $user, Business $business, Request $request)
    {
        try {

            if ($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the Authenticated user.');

            }

            if ($user->id != $business->user_id) {

                throw new \Exception('Requesting user must be the business owner.');

            }

            if (empty($request->input('service_provider'))) {

                throw new \Exception('Business Service or Link is missing. Ensure all values are provided.');

            }

            $BusinessService = new BusinessService();
            $BusinessService->business_id = $business->id;
            $BusinessService->service_id = $request->input('service_provider');
            $BusinessService->save();

            return redirect()->route('console.user.businesses.business.business-console', ['user'=> Auth::user()->id, 'business' => $business->id])
                ->with(
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
     * @param  \App\BusinessService  $businessService
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessService $businessService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessService  $businessService
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessService $businessService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessService  $businessService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessService $businessService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessService  $businessService
     * @return \Illuminate\Http\Response
     */

        public function destroy(User $user, Business $business,BusinessService $service)
    {

        try {

            if (Auth::check()) {

                if (Auth::user()->id != $business->user_id) {

                    throw new \Exception('Business  does not belong to the user making the request.');

                }

                if ($business->id != $service->business_id) {

                    throw new \Exception('Business service does not belong to the business where request originated from.');

                }

                $service->delete();

                return redirect()
                    ->back()
                    ->with(['message' => 'Successfully deleted Business service for business: ' . $business->name]);

            } else {

                return redirect()
                    ->back()
                    ->withErrors(['Must be logged in before you can delete a service from a Business.']);

            }

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
    }
}
