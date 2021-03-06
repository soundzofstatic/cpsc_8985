<?php

namespace App\Http\Controllers;

use App\BusinessCheckIn;
use App\Feedback;
use App\PromotedBusiness;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkIns = BusinessCheckIn::limit(4)
            ->orderBy('created_at', 'DESC')
            ->get();

        $feedBacks = Feedback::limit(5)
            ->orderBy('created_at', 'DESC')
            ->get();
        $now=Carbon::now();

        $promotedBusiness1 = PromotedBusiness::where('is_active','=',true)
            ->where('promo_location','=','location_1')
            ->where('start_date','<=',$now)
            ->where('end_date','>=',$now)
            ->orderBy('created_at', 'DESC')
            ->first();

        $promotedBusiness2 = PromotedBusiness::where('is_active','=',true)
            ->where('promo_location','=','location_2')
            ->where('start_date','<=',$now)
            ->where('end_date','>=',$now)
            ->orderBy('created_at', 'DESC')
            ->first();

        return view('index')
            ->with(
                compact(
                    [
                        'checkIns',
                        'feedBacks',
                        'promotedBusiness1',
                        'promotedBusiness2'
                    ]
                )
            );
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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
