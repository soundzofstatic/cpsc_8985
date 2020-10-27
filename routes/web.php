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

            });

        });

        Route::prefix('reviewer')->name('reviewer.')->group(function () { // todo - Should have middleware protecting it from non-admin users

            Route::get('/', 'UserController@reviewerConsoleIndex')->name('home');

        });

        Route::prefix('businesses')->name('businesses.')->group(function () { // todo - Should have middleware protecting it from non-admin users

            Route::get('/', 'UserController@businessConsoleIndex')->name('home');

            Route::get('/business-create', 'BusinessController@create')->name('create');

            Route::post('/business-create', 'BusinessController@store')->name('store');

            Route::prefix('{business}')->name('business.')->group(function () { // todo - Should have middleware

                Route::get('/', 'BusinessController@showConsole')->name('business-console');

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

        });

    });
    Route::prefix('admin')->name('admin.')->group(function () { // todo - Should have middleware protecting it from non-admin users
        Route::get('/all-users', 'UserController@listAllUsers')->name('list-all-users');
    });
});

// User Pages/Routes
Route::prefix('user')->name('user.')->group(function () {

    Route::get('/{user}', 'UserController@show')->name('home');

});

// Business Pages/Routes
Route::prefix('business')->name('business.')->group(function () {

    Route::get('/{business}', 'BusinessController@show')->name('home');
    Route::prefix('{business}/action')->name('action.')->group(function () {
        Route::post('/store-review', 'BusinessController@storeReview')->name('store-review');
    });
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
    Route::get('/how-it-works', function () { // /theme/how-it-works
        return view('themes.localsdirectory.examples.how-it-works');
    })->name('how-it-works');
    Route::get('/contact', function () {
        return view('themes.localsdirectory.examples.contact');
    })->name('contact');
    Route::get('/blog', function () {
        return view('themes.localsdirectory.examples.blog');
    })->name('blog');
});

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