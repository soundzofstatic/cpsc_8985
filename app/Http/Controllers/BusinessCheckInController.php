<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessCheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessCheckInController extends Controller
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
    public function store(Business $business, Request $request)
    {
        if(Auth::check()) {

            $checkIn = new BusinessCheckIn();
            $checkIn->business_id = $business->id;
            $checkIn->user_id = Auth::user()->id;
            $checkIn->save();

            return redirect()
                ->back()
                ->with(['message' => 'Successfully Checked-in to : ' . $business->name]);

        } else {

            return redirect()
                ->route('login')
                ->withErrors(['Must be logged in before you can Check-in to a Business.']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessCheckIn  $businessCheckIn
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessCheckIn $businessCheckIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessCheckIn  $businessCheckIn
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessCheckIn $businessCheckIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessCheckIn  $businessCheckIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessCheckIn $businessCheckIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessCheckIn  $businessCheckIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessCheckIn $businessCheckIn)
    {
        //
    }
}
