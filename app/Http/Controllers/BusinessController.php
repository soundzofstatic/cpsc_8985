<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessSocialMedia;
use App\BusinessVisit;

use App\FileUpload;
use App\Helpers\Alert;
use App\PromotedBusiness;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFromAnywhere()
    {

        if (Auth::check()) {

            return redirect()
                ->route('console.user.businesses.create', ['user' => Auth::user()->id]);

        } else {

            return redirect()
                ->route('login')
                ->withErrors(['Must be logged in before you can create Business.']);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        try {

            // Because the $user is passed from the route, let's compare it to the Authenticated user
            if ($user->id != Auth::user()->id) {

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
     * @param \App\Business $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {

        // Save a Visit
        $visit = new BusinessVisit();
        $visit->business_id = $business->id;
        if (Auth::check()) {
            $visit->user_id = Auth::user()->id;
        } else {
            $visit->user_id = null;
        }
        $visit->save();

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
     * @param \App\Business $business
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Business $business)
    {
        //$business = business::find($user);
        return view('console.user.business.edit')
            ->with(compact([
                'user',
                'business'
            ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Business $business
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Business $business, Request $request)
    {
        try {
            //dd($request->all());
            if ($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the Authenticated user.');

            }

            if ($user->id != $business->user_id) {

                throw new \Exception('Requesting user must be the business owner.');

            }

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

            //return redirect()
            //->route('business.home', ['business' => $business->id]);

            //$business->name = $request->input('name');
            //$business->save();

            return redirect()->route('console.user.businesses.business.business-console', ['user' => Auth::user()->id, 'business' => $business->id])
                ->with(['message' => 'Successfully updated business details.']);


        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Business $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Business $business)
    {
        // Delete all Bookmarks
        foreach ($business->bookmarks as $bookmark) {
            $bookmark->delete();
        }
        // Delete all Check-ins
        foreach ($business->businessCheckIn as $checkIn) {
            $checkIn->delete();
        }
        // Delete all Events
        foreach ($business->businessEvent as $event) {
            $event->delete();
        }
        // Delete all Services
        foreach ($business->businessService as $service) {
            $service->delete();
        }
        // Delete all Social Media
        foreach ($business->businessSocialMedia as $socialMedia) {
            $socialMedia->delete();
        }
        // Delete all Visits
        foreach ($business->businessVisit as $visit) {
            $visit->delete();
        }
        // Delete all Promoted Business
        if (!empty($business->promotedBusiness)) {
            $business->promotedBusiness->delete();
        }
        // Delete all Questions
        foreach ($business->questions as $question) {
            // Delete all Feedback
            foreach ($question->feedbacks as $feedback) {
                $feedback->delete();
            }
            $question->delete();
        }
        // Delete all Reviews
        foreach ($business->reviews as $review) {
            foreach ($question->feedbacks as $feedback) {
                $feedback->delete();
            }
            $review->delete();
        }
        $business->delete();
        return redirect()
            //->route('console.user.businesses.create', ['user' => Auth::user()->id])
            ->back()
            ->with(['message' => 'Successfully deleted business']);
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

    public function listAllBusinesses(Request $request) // todo - This method is not named properly, it used for querying, not listing all Businesses
    {

        try {

            $businesses = Business::where('name', 'like', '%' . $request->input('query') . '%')
                ->orWhere('contact_email', 'like', '%' . $request->input('query') . '%')
                ->orWhere('web_url', 'like', '%' . $request->input('query') . '%')
                ->orWhere('contact_phone', 'like', '%' . $request->input('query') . '%')
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

    public function listAllBusinesses2(User $user) // todo - This method is not named properly, it used for querying, not listing all Businesses
    {

        try {

            $businesses = Business::get();

            return view('console.user.admin.list-businesses')
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function query(Request $request)
    {

        try {

            $businesses = Business::where('name', 'like', '%' . $request->input('query') . '%')
                ->orWhere('contact_email', 'like', '%' . $request->input('query') . '%')
                ->orWhere('web_url', 'like', '%' . $request->input('query') . '%')
                ->orWhere('contact_phone', 'like', '%' . $request->input('query') . '%')
                ->orderBy('name', 'asc')
                ->orderBy('contact_email', 'asc')
                ->orderBy('contact_phone', 'asc')
                ->orderBy('web_url', 'asc')
                ->get();

            $now = Carbon::now();

            $promotedBusiness3 =PromotedBusiness::where('is_active','=',true)
                ->where('promo_location','=','location_3')
                ->where('start_date','<=', $now)
                ->where('end_date','>=', $now)
                ->orderBy('created_at', 'DESC')
                ->first();

            return view('search.results')
                ->with(
                    compact(
                        [
                            'businesses',
                            'promotedBusiness3'
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
     * @param User $user
     * @param Business $business
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableBusiness(User $user, Business $business)
    {

        try {

            if ($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the authenticated user.');

            }

            if (!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            $business->is_active = false;
            $business->save();

            return redirect()
                ->route('console.user.businesses.business.business-console', ['user' => $user->id, 'business' => $business->id])
                ->with(['message' => 'Successfully disabled business: ' . $business->name]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    /**
     * @param User $user
     * @param Business $business
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enableBusiness(User $user, Business $business)
    {

        try {

            if ($user->id != Auth::user()->id) {

                throw new \Exception('Requesting user must be the authenticated user.');

            }

            if (!$user->isAdmin()) {

                throw new \Exception('Requesting user must be administrator.');

            }

            $business->is_active = true;
            $business->save();

            return redirect()
                ->route('console.user.businesses.business.business-console', ['user' => $user->id, 'business' => $business->id])
                ->with(['message' => 'Successfully enabled business: ' . $business->name]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    public function createPhoto(User $user, business $business, request $request)
    {

        try {

            //dd('HI Mythri, show a form where a user can upload an image. Then you can process the form in the BusinessController@storePhoto method');
            return view('console.user.business.businessimage')
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
    
    public function storePhoto(User $user, business $business, request $request)
    {

        try {

            if ($user->id != Auth::user()->id) {

                throw new \Exception('Authenticated user must be the requesting user.');

            }

            $upload = new FileUpload();
            $upload->user_id = $user->id;
            $upload->business_id = $business->id;
            $upload->is_active = true;
            $upload->upload_type = 'business.photo';
            // Save to file
            $fileUpload = $request->file('file_path');
            $path = $fileUpload->store('public/assets/business/photo');
            $upload->file_type = 'image';
            $upload->file_path = $path;
            $upload->file_name = basename($path);
            $upload->path_directory = $path;
            preg_match('/\.[0-9A-Za-z]+$/', $path, $output_array);
            $upload->file_extension = $output_array[0]; // file extension, includes leading .
            $upload->file_size = $fileUpload->getSize();
            $upload->mime_type = $fileUpload->getMimeType();
            $upload->alt_text = $request->input('alt-text');
            $upload->save();

            return redirect()
                ->route('console.user.businesses.business.business-console', ['user'=> $user, 'business'=>$business])
                ->with(
                    [
                        'message' => 'Successfully Set photo for business.'
                    ]
                );

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    public function destroyPhoto(User $user, business $business)
    {

        try {

            if ($user->id != Auth::user()->id) {

                throw new \Exception('Authenticated user must be the requesting user.');

            }

            if (!empty($user->photo)) {

                $user->photo->delete();

                Alert::createAlert(
                    'user.photo.destroy',
                    'Successfully removed image.',
                    $user,
                    null
                );

            }

            return redirect()
                ->back()
                ->with(['message' => 'Successfully Deleted image for user.']);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

    public function publicCreatePhoto(business $business, User $user, request $request)
    {

        try {

            return view('console.user.business.businessimage')
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

    public function publicStorePhoto(business $business, User $user, request $request)
    {

        try {

            if ($user->id != Auth::user()->id) {

                throw new \Exception('Authenticated user must be the requesting user.');

            }

            $upload = new FileUpload();
            $upload->user_id = $user->id;
            $upload->business_id = $business->id;
            $upload->is_active = true;
            $upload->upload_type = 'business.photo';
            // Save to file
            $fileUpload = $request->file('file_path');
            $path = $fileUpload->store('public/assets/business/photo');
            $upload->file_type = 'image';
            $upload->file_path = $path;
            $upload->file_name = basename($path);
            $upload->path_directory = $path;
            preg_match('/\.[0-9A-Za-z]+$/', $path, $output_array);
            $upload->file_extension = $output_array[0]; // file extension, includes leading .
            $upload->file_size = $fileUpload->getSize();
            $upload->mime_type = $fileUpload->getMimeType();
            $upload->alt_text = $request->input('alt-text');
            $upload->save();

            return redirect()
                ->route('business.home', ['business'=>$business])
                ->with(
                    [
                        'message' => 'Successfully Set photo for business.'
                    ]
                );

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withErrors([$e->getMessage()]);

        }

    }

}

