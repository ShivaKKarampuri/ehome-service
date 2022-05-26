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

/*********************General Function for Both (Front-end & Back-end) ***********************/
/* Route::post('/get_states', 'HomeController@getStates');
Route::post('/get_product_views', 'HomeController@getProductViews');
Route::post('/get_product_other_info', 'HomeController@getProductOtherInformation');
Route::post('/delete_action', 'HomeController@deleteAction')->middleware('auth');
 */
Route::get('/clear-cache', function() {

    $exitCode = Artisan::call('cache:clear');
   
    // return what you want
});
 
/*********************Exception Handling ***********************/
Route::get('/exception', 'ExceptionController@index')->name('exception');
Route::post('/exception', 'ExceptionController@index')->name('exception');

/*********************Admin Panel Start ***********************/
Route::prefix('admin')->group(function() {
    //Login and Logout 
		Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
		Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
		Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
		Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	
	//General  
		Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');
		Route::get('/get_customer_detail', 'Admin\AdminController@CustomerDetail')->name('admin.get_customer_detail');
		Route::get('/my_profile', 'Admin\AdminController@myProfile')->name('admin.my_profile');
		Route::post('/my_profile', 'Admin\AdminController@myProfile')->name('admin.my_profile');
		Route::get('/change_password', 'Admin\AdminController@change_password')->name('admin.change_password');
		Route::post('/change_password', 'Admin\AdminController@change_password')->name('admin.change_password');
		Route::get('/getsubcategory', 'Admin\AdminController@getsubcategory')->name('admin.getsubcategory');
		Route::get('/getstate', 'Admin\AdminController@getstate')->name('admin.getstate');
		Route::get('/getcity', 'Admin\AdminController@getcity')->name('admin.getcity'); 
		   
		Route::post('/delete_action', 'Admin\AdminController@deleteAction'); 
	
		Route::get('/website_setting', 'Admin\AdminController@websiteSetting')->name('admin.website_setting');
		Route::post('/website_setting', 'Admin\AdminController@websiteSetting')->name('admin.website_setting');
		Route::post('/get_states', 'Admin\AdminController@getStates');
		Route::get('/settings/taxes/returnsetting', 'Admin\AdminController@returnsetting')->name('admin.returnsetting');
		Route::get('/settings/taxes/taxrates', 'Admin\AdminController@taxrates')->name('admin.taxrates');

		Route::get('/users', 'Admin\UserController@index')->name('admin.users.index');
		Route::get('/users/create', 'Admin\UserController@create')->name('admin.users.create'); 
		Route::post('/users/store', 'Admin\UserController@store')->name('admin.users.store');
		Route::get('/users/edit/{id}', 'Admin\UserController@edit')->name('admin.users.edit');
		Route::post('/users/edit', 'Admin\UserController@edit')->name('admin.users.edit');
		
		Route::get('/usertype', 'Admin\UsertypeController@index')->name('admin.usertype.index');
		Route::get('/usertype/create', 'Admin\UsertypeController@create')->name('admin.usertype.create');  		
		Route::post('/usertype/store', 'Admin\UsertypeController@store')->name('admin.usertype.store');
		Route::get('/usertype/edit/{id}', 'Admin\UsertypeController@edit')->name('admin.usertype.edit');
		Route::post('/usertype/edit', 'Admin\UsertypeController@edit')->name('admin.usertype.edit');
		
		Route::get('/userrole', 'Admin\UserroleController@index')->name('admin.userrole.index');
		Route::get('/userrole/create', 'Admin\UserroleController@create')->name('admin.userrole.create');  
		Route::post('/userrole/store', 'Admin\UserroleController@store')->name('admin.userrole.store');
		Route::get('/userrole/edit/{id}', 'Admin\UserroleController@edit')->name('admin.userrole.edit');
		Route::post('/userrole/edit', 'Admin\UserroleController@edit')->name('admin.userrole.edit');
		
	     
	//CMS Pages
		Route::get('/cms_pages', 'Admin\CmsPageController@index')->name('admin.cms_pages.index');
		Route::get('/cms_pages/create', 'Admin\CmsPageController@create')->name('admin.cms_pages.create');
		Route::post('/cms_pages/store', 'Admin\CmsPageController@store')->name('admin.cms_pages.store');
		Route::get('/cms_pages/edit/{id}', 'Admin\CmsPageController@editCmsPage')->name('admin.edit_cms_page');
		Route::post('/cms_pages/edit', 'Admin\CmsPageController@editCmsPage')->name('admin.edit_cms_page');
		
	//Email Templates Pages
		Route::get('/email_templates', 'Admin\EmailTemplateController@index')->name('admin.email.index');
		Route::get('/email_templates/create', 'Admin\EmailTemplateController@create')->name('admin.email.create');
		Route::post('/email_templates/store', 'Admin\EmailTemplateController@store')->name('admin.email.store');
		Route::get('/edit_email_template/{id}', 'Admin\EmailTemplateController@editEmailTemplate')->name('admin.edit_email_template');
		Route::post('/edit_email_template', 'Admin\EmailTemplateController@editEmailTemplate')->name('admin.edit_email_template');	
		
	//SEO Tool
		Route::get('/edit_seo/{id}', 'Admin\AdminController@editSeo')->name('admin.edit_seo');
		Route::post('/edit_seo', 'Admin\AdminController@editSeo')->name('admin.edit_seo');
		
		Route::get('/api-key', 'Admin\AdminController@editapi')->name('admin.edit_api');
		Route::post('/api-key', 'Admin\AdminController@editapi')->name('admin.edit_api');	
	
	//amenities	
		Route::get('/amenities', 'Admin\AmenitiesController@index')->name('admin.amenities.index');
		Route::get('/amenities/create', 'Admin\AmenitiesController@create')->name('admin.amenities.create'); 
		Route::post('/amenities/store', 'Admin\AmenitiesController@store')->name('admin.amenities.store');
		Route::get('/amenities/edit/{id}', 'Admin\AmenitiesController@edit')->name('admin.amenities.edit');
		Route::post('/amenities/edit', 'Admin\AmenitiesController@edit')->name('admin.amenities.edit');
		
		//Category	
		Route::get('/categories', 'Admin\CategoryController@index')->name('admin.categories.index');
		Route::get('/categories/create', 'Admin\CategoryController@create')->name('admin.categories.create'); 
		Route::post('/categories/store', 'Admin\CategoryController@store')->name('admin.categories.store');
		Route::get('/categories/edit/{id}', 'Admin\CategoryController@edit')->name('admin.categories.edit');
		Route::post('/categories/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
	
	//Ads	 
		Route::get('/ads', 'Admin\AdsController@index')->name('admin.ads.index');
		Route::get('/ads/create', 'Admin\AdsController@create')->name('admin.ads.create'); 
		Route::post('/ads/store', 'Admin\AdsController@store')->name('admin.ads.store');
		Route::get('/ads/edit/{id}', 'Admin\AdsController@edit')->name('admin.ads.edit');
		Route::post('/ads/edit', 'Admin\AdsController@edit')->name('admin.ads.edit');

	//Country	 
		Route::get('/country', 'Admin\CountryController@index')->name('admin.country.index');
		Route::get('/country/create', 'Admin\CountryController@create')->name('admin.country.create'); 
		Route::post('/country/store', 'Admin\CountryController@store')->name('admin.country.store');
		Route::get('/country/edit/{id}', 'Admin\CountryController@edit')->name('admin.country.edit');
		Route::post('/country/edit', 'Admin\CountryController@edit')->name('admin.country.edit');	
		
	//State	 
		Route::get('/state', 'Admin\StateController@index')->name('admin.state.index');
		Route::get('/state/create', 'Admin\StateController@create')->name('admin.state.create'); 
		Route::post('/state/store', 'Admin\StateController@store')->name('admin.state.store');
		Route::get('/state/edit/{id}', 'Admin\StateController@edit')->name('admin.state.edit');
		Route::post('/state/edit', 'Admin\StateController@edit')->name('admin.state.edit');	
	
	//City	 
		Route::get('/city', 'Admin\CityController@index')->name('admin.city.index');
		Route::get('/city/create', 'Admin\CityController@create')->name('admin.city.create'); 
		Route::post('/city/store', 'Admin\CityController@store')->name('admin.city.store');
		Route::get('/city/edit/{id}', 'Admin\CityController@edit')->name('admin.city.edit');
		Route::post('/city/edit', 'Admin\CityController@edit')->name('admin.city.edit');		
}); 