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

            Route::get('/', 'AdminController@index')->name('home');

        });

        Route::prefix('reviewer')->name('reviewer.')->group(function () { // todo - Should have middleware protecting it from non-admin users

            Route::get('/', 'UserController@reviewerConsoleIndex')->name('home');

        });

        Route::prefix('business')->name('business.')->group(function () { // todo - Should have middleware protecting it from non-admin users

            Route::get('/', 'UserController@businessConsoleIndex')->name('home');
            Route::get('/{business}', 'BusinessController@indexConsole')->name('business-console');

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
