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
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
	return view('default');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Routes for Posts
Route::get('posts', 'PostsController@index');
Route::post('posts', 'PostsController@store');
Route::get('posts/create', 'PostsController@create');
Route::get('posts/{post}', 'PostsController@show');

//Routes for Referrals
Route::get('referrals/upload', 'ReferralController@upload');
Route::post('referrals/comment', 'ReferralController@addcomment');
Route::post('referrals/upload', 'ReferralController@processUpload');
Route::get('referrals/create', 'ReferralController@create')->name('add-referral');
Route::get('referrals/{country?}/{city?}', 'ReferralController@index');
Route::post('referrals', 'ReferralController@store')->middleware('auth:web');

//Logged in Users
Route::get('my-posts', 'AuthorsController@posts')->name('my-posts');

//Routes for Authors
Route::get('authors', 'AuthorsController@index');
Route::get('authors/{author}', 'AuthorsController@show');

// Routes ot see users
Route::get('users', 'UsersController@index');
Route::post('users/update', 'UsersController@update');
Route::post('users/ban', 'UsersController@ban');
Route::post('users/delete', 'UsersController@delete');
Route::post('users/register', 'UsersController@register');
Route::get('comments/{reference_no}', 'ReferralController@getComments');


