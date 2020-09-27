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


Auth::routes();
Route::post('/google/sign-in', 'GoogleTokenController@exchangeAuthCode')->name('google-integrate-auth-token');

// Console, aka. Logged in area
Route::prefix('console')->name('console.')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
