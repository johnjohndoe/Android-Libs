<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', 'IndexController@showIndex');

Route::get('/lib/{slug}', 'LibraryController@showLibrary');

Route::get('/login', 'UserController@showLogin');
Route::get('/register', 'UserController@showRegister');
Route::get('/logout', 'UserController@logout');
Route::get('/activate/{userId}/{code}', 'UserController@activate');
Route::post('/login', 'UserController@processLogin');
Route::post('/register', 'UserController@processRegister');
Route::post('/forgot/password', 'UserController@forgotPassword');

Route::post('/search/libraries/', 'LibraryController@searchLibraries');
Route::get('/search/{slug}', 'LibraryController@categorizeLibraries');

Route::post('/submit', 'LibraryController@submitLibrary');
Route::get('/lib/get/stats', 'LibraryController@getStatsAsJson');
Route::post('/lib/image/suggest', 'LibraryController@suggestImage');

Route::get('/admin', [ 'before' => 'admin', 'uses' => 'AdminController@showAdmin']);
Route::get('/admin/lib/accept/{id}', [ 'before' => 'admin', 'uses' => 'AdminController@acceptLibrary']);
Route::get('/admin/lib/decline/{id}/{reason}',  [ 'before' => 'admin', 'uses' => 'AdminController@declineLibrary']);
Route::get('/admin/lib/remove/{id}',  [ 'before' => 'admin', 'uses' => 'AdminController@removeLibrary']);
Route::post('/admin/lib/add',  [ 'before' => 'admin', 'uses' => 'AdminController@addLibrary']);

/* Show mail in cool design */
Route::get('/mail/{type}', function ($type) {
    if ($type == "submitted")
        return View::make('emails.submitted');
    else if ($type == "accepted")
        return View::make('emails.accepted');
    else if ($type == "declined")
        return View::make('emails.declined');
});


/* In route handling */
Route::get('/submit', 'IndexController@showSubmit');


Route::get('/donate', function () {
    return View::make('donate');
});

Route::get('/import', function() {
    set_time_limit(500000);



    /*
    $oDbLibs = Libraries::where('github', 'LIKE', '%' . 'github.com/' . '%')->get();

    $aLibraries = [];


    foreach( $oDbLibs as $oDbLib )
    {
        $sStrippedUrl = str_replace('http://github.com/', '', $oDbLib->github);
        $sStrippedUrl = str_replace('https://github.com/', '', $sStrippedUrl);
        $aLib = [
            "id"   => $oDbLib->id,
            "user" => $oDbLib->getGitHubUserName(),
            "repo" => $oDbLib->getGitHubRepoName()
        ];


        $aLibraries[] = $aLib;
    }



    foreach( $aLibraries as $aLib )
    {
        try {
            // Update description
            $oLib             = Libraries::find($aLib['id']);
            $aGitHubLib       = GitHub::repo()->show($aLib['user'], $aLib['repo']);
            $oLib->title = $aGitHubLib['name'];
            $oLib->save();
        } catch( Exception $ex) { continue; }

    }
    */


});