<?php

namespace App\Http\Controllers;

use App\Business;
use App\User;
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
    public function store(Request $request)
    {

        //dd($request->all()); // echo or display of data
        //dd($request->input('name')); // echo or display of data
        $businesses = \App\Business::get();
        $users = \App\User::get();

        if ($businesses->count() < 40) {

            for ($i = 0; $i < 40; $i++) {

                $faker = Faker\Factory::create('en_US');

                $randomDate = \Carbon\Carbon::now()->subDays(rand(5, 180));
                $randomEstDate = \Carbon\Carbon::now()->subYears(rand(0, 50));

                $business = new \App\Business();
                $business->name = $faker->company;
                $business->user_id = $users[rand(0, ($users->count() - 1))]->id;

                $business->address = $faker->address;
                $business->hours = '9-9';
                $business->est_date = $randomEstDate->format('m/d/Y');
                $business->description = $faker->realText(215, 2);
                $business->dollar_rating = rand(0, 5);
                $business->web_url = $faker->url;
                $business->menu_url = $faker->url;
                $business->contact_phone = $faker->e164PhoneNumber;
                $business->contact_email = $faker->email;
                $business->view_count = 0;
                $business->setCreatedAt($randomDate);
                $business->setUpdatedAt($randomDate);
                $business->save();

            }
        }
        // todo - Mythri, add logic here to save a business
        // todo - Must save Business for Authenticated User

        $authenticatedUser = Auth::user();
        dd($authenticatedUser->id);
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

