<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessSocialMedia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BusinessSocialMediaController extends Controller
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

            return view('forms.social-media-link')
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

            if($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the Authenticated user.');

            }

            if($user->id != $business->user_id) {

                throw new \Exception('Requesting user must be the business owner.');

            }

            if(empty($request->input('social_media_provider') OR empty($request->input('social_media_link')))) {

                throw new \Exception('Social Media Provider or Link is missing. Ensure all values are provided.');

            }

            $socialMediaLink = new BusinessSocialMedia();
            $socialMediaLink->business_id = $business->id;
            $socialMediaLink->social_media_provider = $request->input('social_media_provider');
            $socialMediaLink->social_media_link = $request->input('social_media_link');
            $socialMediaLink->save();

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
     * @param  \App\BusinessSocialMedia  $businessSocialMedia
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessSocialMedia $businessSocialMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessSocialMedia  $businessSocialMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessSocialMedia $businessSocialMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessSocialMedia  $businessSocialMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessSocialMedia $businessSocialMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessSocialMedia  $businessSocialMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessSocialMedia $businessSocialMedia)
    {
        //
    }
}
