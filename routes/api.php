<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for yosearch-adsur application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', 'Auth\RegisterController@apiregister');
Route::post('/login', 'Auth\LoginController@apilogin')->name('login');
Route::post('auth/{provider}', 'Auth\RegisterController@apisocialregister');
// Route::post('/login', 'Auth\LoginController@apilogin');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@apiforgotpassword');
Route::post('/verify-otp', 'Auth\ForgotPasswordController@apiverifyotp');
Route::post('/reset-password', 'Auth\ForgotPasswordController@apiresetpassword');
Route::get('/getcountries', 'API\AdsController@getcountries');
Route::get('/getstate', 'API\AdsController@getstate');
Route::get('/getcity', 'API\AdsController@getcity');
Route::get('/getcategory','API\AdsController@getcategories');
Route::get('/getamenties', 'API\AdsController@getamenties');
Route::get('/viewall-ads', 'API\AdsController@viewallads');
 Route::group(['middleware'=>['ApiMiddleware']], function(){ 

Route::group(['prefix' => 'profile'], function() {
		Route::get('/', 'API\UserController@index');
		Route::post('/update', 'API\UserController@update');
		Route::post('/update-pic', 'API\UserController@updateProfilePic');
		
		//Route::post('/password', 'API\UserController@password');
	});
	
	Route::post('/post-ads', 'API\AdsController@addpost');
	Route::post('/search-ads', 'API\AdsController@searchAds');
	Route::post('/update-post-ads', 'API\AdsController@updatepost');
	Route::post('/delete-post', 'API\AdsController@deletepost');
	Route::post('/view-post', 'API\AdsController@viewpost');
	Route::post('/viewall-user-post', 'API\AdsController@viewuserpost');
	Route::post('/send-message', 'API\AdsController@sendMessage');
	Route::get('/sender-message-list', 'API\AdsController@senderMessage');
	Route::get('/reciever-message-list', 'API\AdsController@recieverMessage');
	Route::post('/add-to-favorite', 'API\AdsController@addFavorite');
	Route::get('/favorite-ads-list', 'API\AdsController@favoriteAdsList');
	Route::post('/remove-favorite', 'API\AdsController@removefavoriteAdsList');
	Route::post('/read-message', 'API\AdsController@readMessage');
	Route::get('/all-message-list', 'API\AdsController@allMessage');
	Route::post('/chat-history', 'API\AdsController@chatHistory');
	});
// 

//Webhook panel






