<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontPageController@index')->name('front-page');

Auth::routes();
Route::post('/google/sign-in', 'GoogleTokenController@exchangeAuthCode')->name('google-integrate-auth-token');

// Console, aka. Logged in area
Route::prefix('console')->name('console.')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('user/{user}')->name('user.')->group(function () {

        Route::get('/settings', function () {
            return view('console.user.settings');
        })->name('settings');

        Route::prefix('admin')->name('admin.')->group(function () { // todo - Should have middleware protecting it from non-admin users

            Route::get('/', 'AdminController@show')->name('home');

            Route::prefix('update')->name('update.')->group(function () {

                Route::get('/disable-user', 'UserController@disableUser')->name('disable-user'); // todo - hook this in to Blade where users are displayed for admin
                Route::get('/enable-user', 'UserController@enableUser')->name('enable-user');

                Route::post('/listAllBusinesses', 'BusinessController@listAllBusinesses')->name('listAllBusinesses');

                Route::prefix('review')->name('review.')->group(function () {

                    Route::prefix('{review}')->group(function () {

                        Route::get('/disable', 'ReviewController@disableReview')->name('disable');
                        Route::get('/enable', 'ReviewController@enableReview')->name('enable');

                    });

                });

                Route::prefix('business')->name('business.')->group(function () {

                    Route::prefix('{business}')->group(function () {

                        Route::get('/disable', 'BusinessController@disableBusiness')->name('disable');
                        Route::get('/enable', 'BusinessController@enableBusiness')->name('enable');

                    });

                });

            });

        });

        Route::prefix('reviewer')->name('reviewer.')->group(function () { // todo - Should have middleware protecting it from non-admin users

            Route::get('/', 'UserController@reviewerConsoleIndex')->name('home');
            Route::get('/all-user-reviews', 'UserController@lastHundredReviews')->name('last-hundred-reviews');

            Route::prefix('update')->name('update.')->group(function () {

                Route::prefix('bookmark')->name('bookmark.')->group(function () {

                    Route::prefix('{bookmark}')->group(function () {

                        Route::get('/public-bookmark', 'BookmarkController@markPublic')->name('public-bookmark');
                        Route::get('/private-bookmark', 'BookmarkController@markPrivate')->name('private-bookmark');

                    });
                });
            });

        });

        Route::prefix('businesses')->name('businesses.')->group(function () { // todo - Should have middleware protecting it from non-admin users

            Route::get('/', 'UserController@businessConsoleIndex')->name('home');

            Route::get('/business-create', 'BusinessController@create')->name('create');
            Route::post('/business-create', 'BusinessController@store')->name('store');

            Route::prefix('{business}')->name('business.')->group(function () { // todo - Should have middleware

                Route::get('/', 'BusinessController@showConsole')->name('business-console');
                Route::get('/business-edit', 'BusinessController@edit')->name('edit');
                Route::post('/business-edit', 'BusinessController@update')->name('business-update');

                Route::prefix('update')->name('update.')->group(function () {

                    Route::prefix('social-media')->name('social-media.')->group(function () {

                        Route::get('/create', 'BusinessSocialMediaController@create')->name('create');
                        Route::post('/store', 'BusinessSocialMediaController@store')->name('store');

                        Route::prefix('{social_media}')->group(function () {

                        });
                    });
                    Route::prefix('service')->name('service.')->group(function () {

                        Route::get('/create', 'BusinessServiceController@create')->name('create');
                        Route::post('/store', 'BusinessServiceController@store')->name('store');

                        Route::prefix('{service}')->group(function () {
                            Route::get('/destroy', 'BusinessServiceController@destroy')->name('destroy');

                        });
                    });
                    Route::prefix('events')->name('events.')->group(function () {

                        Route::get('/create', 'BusinessEventController@create')->name('create');
                        Route::post('/store', 'BusinessEventController@store')->name('store');

                        Route::prefix('{events}')->group(function () {

                        });
                    });
                });

                Route::prefix('update')->name('update.')->group(function () {

                    Route::delete('/destroy', 'BusinessController@destroy')->name('destroy');

                });

            });
        });
    });
    Route::prefix('update')->name('update.')->group(function () {

        Route::prefix('user/{user}')->name('user.')->group(function () {

            // GET - index/show
            Route::get('/username', function () {
                return view('forms.update-user');
            })->name('username-form');
            Route::get('/promote-to-admin', 'UserController@promoteToAdmin')->name('promote-user');
            Route::get('/demote-from-admin', 'UserController@demoteFromAdmin')->name('demote-user');

            // POST - Store
            Route::post('/username', 'UserController@username')->name('username');

            // PUT - Update
            Route::put('/details', 'UserController@update')->name('details-update');
            Route::put('/password', 'UserController@updatePassword')->name('password-update');

            // DELETE - Destroy
            Route::delete('/username', 'UserController@destroy')->name('username');

        });

    });
    Route::prefix('admin')->name('admin.')->group(function () { // todo - Should have middleware protecting it from non-admin users
        Route::get('/all-users', 'UserController@listAllUsers')->name('list-all-users');
        Route::get('/all-businesses', 'BusinessController@listAllBusinesses2')->name('list-all-businesses');
    });
});


// User Pages/Routes
Route::prefix('user')->name('user.')->group(function () {

    Route::get('/{user}', 'UserController@show')->name('home');
//    Route::prefix('{user}/action')->name('action.')->group(function () {
//        Route::post('/store-review', 'BusinessController@storeReview')->name('store-review');
//    });

});

// Business Pages/Routes
Route::prefix('business')->name('business.')->group(function () {

    Route::prefix('{business}')->group(function () {
        Route::get('/', 'BusinessController@show')->name('home');
        Route::get('/check-in', 'BusinessCheckInController@store')->name('check-in');
        Route::prefix('/bookmark')->name('bookmark.')->group(function () {
            Route::get('/store', 'BookmarkController@store')->name('store');
            Route::get('/destroy/{bookmark}', 'BookmarkController@destroy')->name('destroy');
        });
        Route::prefix('/action')->name('action.')->group(function () {
            Route::post('/store-review', 'BusinessController@storeReview')->name('store-review');
        });
    });
});

// Public Events Pages
Route::prefix('events')->name('events.')->group(function () {

    Route::get('/', 'BusinessEventController@index')->name('home'); // All of the events

    Route::prefix('{event}')->name('event.')->group(function () {

        Route::get('/', 'BusinessEventController@show')->name('home'); // A specific Event

        Route::prefix('/action')->name('action.')->group(function () {
            Route::post('/store-review', 'BusinessController@storeReview')->name('store-review');
        });

    });
});

Route::get('/create', 'BusinessController@createFromAnywhere')->name('business-create');

Route::prefix('search')->name('search.')->group(function () {
    Route::get('/', 'BusinessController@search')->name('home');
    Route::post('/query', 'BusinessController@query')->name('query');
});

// Theme Examples
Route::prefix('theme')->name('theme.')->group(function () {
    Route::get('/', function () {
        return view('themes.localsdirectory.examples.home');
    })->name('home');
    Route::get('/listings', function () {
        return view('themes.localsdirectory.examples.listings');
    })->name('listings');
    Route::get('/single-listing', function () {
        return view('themes.localsdirectory.examples.single-listing');
    })->name('single-listing');
    Route::get('/events', function () { // /theme/events
        return view('themes.localsdirectory.examples.events');
    })->name('events');
    Route::get('/contact', function () {
        return view('themes.localsdirectory.examples.contact');
    })->name('contact');
    Route::get('/blog', function () {
        return view('themes.localsdirectory.examples.blog');
    })->name('blog');
});
//Review form
Route::get('/review/{business}', 'ReviewController@create')->name('review-create');

Route::post('/review-store' ,'ReviewController@store')->name('review-store');

Route::post('/review-reply' ,'ReviewController@reply')->name('review-reply');
//Ask a question
Route::get('/question/{business}', 'QuestionController@create')->name('question-create');

Route::post('/question-store' ,'QuestionController@store')->name('question-store');

Route::post('/question-disable' ,'QustionController@reply')->name('question-disable');


// Proof of Concepts
Route::get('/poc/check-ins-count', function(){

    // Test count of total check-ins
    $checkIns = \App\BusinessCheckIn::get();
    $countCheckIns =  $checkIns->count();

    dd('Total Check-ins ' . $countCheckIns);

});

Route::get('/poc/last-5-check-ins', function(){

    // Test count of total check-ins
    $checkIns = \App\BusinessCheckIn::orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    dd($checkIns);

});

Route::get('/poc/search-business-send-to-blade', function(){ // todo - should be post route when processing from HTML form

    //
    // Example logic for controller to search after request has been submitted from form.
    //


    // Normally, the query would be submitted to the controller method using $request->input('NAME_OF_HTML_INPUT_NAME_ATTRIBUTE'), eg. $request->input('search_query')

    $query = 'Apt';

    $businessess = \App\Business::where('name', 'like', '%' . strtolower($query) . '%')
        ->orWhere('address', 'like', '%' . strtolower($query) . '%')
        ->get();

//    dd($businessess);

    return view('business.search')
        ->with(
            compact(
                [
                    'businessess'
                ]
            )
        );

});

Route::get('/poc/relatedFeedback', function(){

    // Test count of total check-ins
    $review = \App\Review::where('id', '=', 286)
        ->first();

    dd($review->relatedFeedbacks);
    dd($review);

});