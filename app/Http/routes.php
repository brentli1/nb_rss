<?php

use App\Category;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
  if (Auth::check()) {
    return view('app');
  } else {
    return view('index');
  }
});

Route::auth();

Route::get('/app', 'HomeController@index');

// Route::get('/category/{id}', ['uses' => 'CategoryController@show']);

Route::get('/api/category', 'CategoryController@getAll')->middleware('auth');
Route::get('/api/category/{id}', 'CategoryController@getFeeds')->middleware('auth');

# Vue
Route::any('{all}', function () {
    return view('app');
})
->where(['all' => '.*']);
