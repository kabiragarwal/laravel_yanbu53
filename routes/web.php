<?php

Route::get('login', function(){
    return redirect('/signin');
});


Route::get('/', 'PagesController@home');
Route::get('home', 'PagesController@home');
Route::get('about-us', 'PagesController@about_us');
Route::get('faq', 'PagesController@faq');
Route::get('contact-us', 'PagesController@contact');
Route::get('privacy-policy', 'PagesController@privacy_policy');
Route::get('terms-and-conditions', 'PagesController@terms');


Route::get('signup', 'PagesController@signup');
Route::get('signin', 'PagesController@signin');
Route::get('password_reset/{token}', 'PagesController@password_reset');
Route::get('forgot-password', 'PagesController@forgot_password');
Route::get('confirmEmail/{token}', 'PagesController@confirmEmail');
Route::get('logout', 'UsersController@logout');
Route::get('ad/post', 'ProductsController@create_ad');
Route::get('ad/view/{product}', 'ProductsController@show_ad');
Route::get('ad/edit/{product}', 'ProductsController@edit_ad');
Route::get('test', 'ProductsController@test');
Route::get('test-new', 'ProductsController@test_new');
Route::get('ad/premium/{product}', 'ProductsController@premium_ad');
Route::get('search', 'ProductsController@search');
Route::get('sub-category/{subcategory}', 'ProductsController@filter');
Route::get('popular/category/{category}', 'ProductsController@filter');
Route::get('product/featured/{title}', 'ProductsController@filter');
Route::get('location/city/{name}', 'ProductsController@filter');
Route::get('key-word/{title}', 'ProductsController@filter');
Route::get('profile', 'UsersController@profile');
Route::get('password_update', 'UsersController@password_update');
Route::get('myads', 'UsersController@myads');
Route::get('favourite-ads', 'UsersController@favAds');
Route::get('archived-ads', 'UsersController@archived_ads');
Route::get('saved-search', 'UsersController@saved_search');
Route::get('pending-approval-ads', 'UsersController@pendingApprovalAds');
Route::get('account-close', 'UsersController@accountClose');
Route::get('messages', 'UsersController@messages');
Route::get('message/view/{id}', 'UsersController@message_thread');
Route::get('ad-abuses', 'UsersController@ad_abuses');
Route::get('ad_abuse_view/{productId}', 'UsersController@ad_abuses_view');

Route::post('filter', 'ProductsController@filter');
Route::get('filter', 'ProductsController@filter');
Route::get('ad/all', 'ProductsController@filter');

// Route::get('post-ads/{product}', function(\App\Product $product){
//     return $product;
// });


Route::post('signup', 'PagesController@post_signup');
Route::post('signin', 'PagesController@post_signin');
Route::post('contact-us', 'PagesController@post_contact');
Route::post('password_reset', 'PagesController@post_password_reset');
Route::post('forgot_password', 'PagesController@post_forgot_password');
Route::post('post-ads', 'ProductsController@post_create_ad');
Route::post('update-ads', 'ProductsController@post_update_ad');
Route::post('productAbuse', 'ProductsController@productAbuse');
Route::post('send_message', 'MessagesController@sendMessage');
Route::post('favourite', 'UsersController@favourite');
Route::post('permium-ad-confrim', 'ProductsController@permiumAdConfrim');
Route::post('coupon_code_apply', 'ProductsController@coupon_code_apply');
Route::post('saveAllSearches', 'UsersController@saveAllSearches');
Route::post('adVisitIncrement', 'ProductsController@adVisitIncrement');
Route::post('profile', 'UsersController@post_profile');
Route::post('password_update', 'UsersController@post_password_update');
Route::post('myads', 'UsersController@post_myads');
Route::post('favourite-ads', 'UsersController@post_favAds');
Route::post('archived-ads', 'UsersController@post_archived_ads');
Route::post('pending-approval-ads', 'UsersController@postPendingApprovalAds');
Route::post('saved-search', 'UsersController@postSavedSearch');
Route::post('messages', 'UsersController@postMessages');
Route::post('ad-abuses', 'UsersController@postAdAbuses');
Route::post('account-close', 'UsersController@postAccountClose');
Route::post('allStatesByCountryId', 'LocationController@getStatesByCountryId');
Route::post('allCitiesByStateId', 'LocationController@getCitiesByStateId');

// admin routes
Route::group(['prefix'=>'admin'], function(){
 	Route::get('home', ['as'=>'home', function(){
 		return 'some view';
 	}]);

	Route::get('dashboard', 'Admin\AdminsController@dashboard');
	Route::get('admin_login', 'Admin\AdminsController@admin_login');
	Route::get('admin_logout', 'Admin\AdminsController@admin_logout');
    Route::post('admin_login', 'Admin\AdminsController@post_admin_login');

	Route::get('users', 'Admin\UsersController@users');
    Route::get('user/edit/{user}', 'Admin\UsersController@user_edit');
    Route::get('user/view/{user}', 'Admin\UsersController@user_view');
    Route::get('user/delete/{user}', 'Admin\UsersController@user_delete');
    Route::post('user_update', 'Admin\UsersController@user_update');

    Route::get('ads', 'Admin\ProductsController@index');
    Route::get('ad/edit/{product}', 'Admin\ProductsController@edit');
    Route::get('ad/view/{product}', 'Admin\ProductsController@view');
    Route::get('ad/delete/{product}', 'Admin\ProductsController@destroy');
    Route::get('ad/premium/{product}', 'Admin\ProductsController@premium_ad');
    Route::post('ad/premium_confirm/', 'Admin\ProductsController@premium_confirm');
    Route::post('ad/update', 'Admin\ProductsController@update');

    Route::get('categories', 'Admin\CategoriesController@index');
    Route::get('category/create', 'Admin\CategoriesController@create');
    Route::get('category/edit/{category}', 'Admin\CategoriesController@edit');
    Route::get('category/view/{category}', 'Admin\CategoriesController@view');
    Route::get('category/delete/{category}', 'Admin\CategoriesController@destroy');
    Route::post('category/update', 'Admin\CategoriesController@update');
    Route::post('category/store', 'Admin\CategoriesController@store');

    Route::get('subcategories', 'Admin\SubCategoriesController@index');
    Route::get('subcategory/create', 'Admin\SubCategoriesController@create');
    Route::get('subcategory/edit/{subcategory}', 'Admin\SubCategoriesController@edit');
    Route::get('subcategory/view/{subcategory}', 'Admin\SubCategoriesController@view');
    Route::get('subcategory/delete/{subcategory}', 'Admin\SubCategoriesController@destroy');
    Route::post('subcategory/update', 'Admin\SubCategoriesController@update');
    Route::post('subcategory/store', 'Admin\SubCategoriesController@store');

    Route::get('countries', 'Admin\CountriesController@index');
    Route::get('country/create', 'Admin\CountriesController@create');
    Route::get('country/edit/{country}', 'Admin\CountriesController@edit');
    Route::get('country/view/{country}', 'Admin\CountriesController@view');
    Route::get('country/delete/{country}', 'Admin\CountriesController@destroy');
    Route::post('country/update', 'Admin\CountriesController@update');
    Route::post('country/store', 'Admin\CountriesController@store');

    Route::get('states', 'Admin\StatesController@index');
    Route::get('state/create', 'Admin\StatesController@create');
    Route::get('state/edit/{state}', 'Admin\StatesController@edit');
    Route::get('state/view/{state}', 'Admin\StatesController@view');
    Route::get('state/delete/{state}', 'Admin\StatesController@destroy');
    Route::post('state/update', 'Admin\StatesController@update');
    Route::post('state/store', 'Admin\StatesController@store');

    Route::get('cities', 'Admin\CitiesController@index');
    Route::get('city/create', 'Admin\CitiesController@create');
    Route::get('city/edit/{city}', 'Admin\CitiesController@edit');
    Route::get('city/view/{city}', 'Admin\CitiesController@view');
    Route::get('city/delete/{city}', 'Admin\CitiesController@destroy');
    Route::post('city/update', 'Admin\CitiesController@update');
    Route::post('city/store', 'Admin\CitiesController@store');

    Route::get('pages', 'Admin\PagesController@index');
    Route::get('page/create', 'Admin\PagesController@create');
    Route::get('page/edit/{page}', 'Admin\PagesController@edit');
    Route::get('page/view/{page}', 'Admin\PagesController@view');
    Route::get('page/delete/{page}', 'Admin\PagesController@destroy');
    Route::post('page/update', 'Admin\PagesController@update');
    Route::post('page/store', 'Admin\PagesController@store');
});
