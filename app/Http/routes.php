<?php



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

Route::get('/api/category', 'CategoryController@getAll')->middleware('auth');
Route::get('/api/category/{id}', 'CategoryController@getFeeds')->middleware('auth');
Route::post('/api/category/create', 'CategoryController@createCategory')->middleware('auth');
Route::post('/api/category/feed/create/{id}', 'CategoryController@createFeed')->middleware('auth');
Route::match(['put', 'patch'], '/api/category/feed/edit/{id}', 'CategoryController@editFeed')->middleware('auth');

Route::post('/api/feed_items/{id}', 'FeedController@getCurrentRss')->middleware('auth');
Route::get('/api/feed_items/{id}/mark_read', 'FeedController@markItemRead')->middleware('auth');
Route::get('/api/feed_items/{id}/star', 'FeedController@starItem')->middleware('auth');
Route::get('/api/feed_items/{id}/unstar', 'FeedController@unstarItem')->middleware('auth');

# Vue
Route::any('{all}', function () {
    return view('app');
})
->where(['all' => '.*']);
