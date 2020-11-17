<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessEvent;
use App\BusinessSocialMedia;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BusinessEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            // Grab all of the events from the Database
            $events = BusinessEvent::orderBy('created_at', 'DESC')
                ->get();

            return view('events.events')
                ->with(compact([
                    'events' // send it to the Blade
                ]));

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

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

            return view('forms.create-event')
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
            //dd($request->all());
            $start_date = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('start_date'));
            if($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the Authenticated user.');

            }

            if($user->id != $business->user_id) {

                throw new \Exception('Requesting user must be the business owner.');

            }

            if(empty($request->input('name') OR empty($request->input('description')))) {

                throw new \Exception('Business Event or Link is missing. Ensure all values are provided.');

            }

            $BusinessEvent = new BusinessEvent();
            $BusinessEvent->business_id = $business->id;
            $BusinessEvent->name = $request->input('name');
            $BusinessEvent->description = $request->input('description');
            $BusinessEvent->start_date = $start_date;
            $BusinessEvent->save();

            return redirect()
                ->back()
                ->with(['message' => 'Successfully created Event: ']);


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
     * @param  \App\BusinessEvent  $businessevent
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessEvent $event)
    {
    //dd($event);


        return view('events.home')
            ->with(
                compact(
                    [
                        'event'
                    ]
                )
            );

//        $businessevent->event->id;
//        $businessevent->event_id();
//        $businessevent->business_id();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessEvent  $businessevent
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessEvent $businessevent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessEvent  $businessevent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessEvent $businessevent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessEvent  $businessevent
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessEvent $businessevent)
    {
        //
    }
}
