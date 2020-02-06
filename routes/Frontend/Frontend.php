<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');

Route::post('/get/states', 'FrontendController@getStates')->name('get.states');
Route::post('/get/cities', 'FrontendController@getCities')->name('get.cities');

//Login controller routes
Route::get('/user/login','LoginController@index')->name('user.login');
Route::get('/logout','LoginController@logout')->name('logout');
Route::post('login/store','LoginController@store')->name('login.store');

//Register controller routes

Route::get('/register', 'RegisterController@index')->name('register.show');
Route::post('/register/store', 'RegisterController@store')->name('register.store');
Route::get('/register/{id}/edit', 'RegisterController@edit')->name('register.edit');
Route::post('/register/{id}/update', 'RegisterController@update')->name('register.update');


///Category controller routes
Route::get('categories','CategoriesController@index')->name('category.list');
Route::get('/categories/search','CategoriesController@getAllCat')->name('category.list.ajax');

///Subcategory controller routes
Route::get('subcategories/{id}','SubcategoriesController@getSub')->name('subcategory.list');
Route::get('/subcategories/search/subcat','SubcategoriesController@getAll')->name('subcategory.list.ajax');
Route::get('/wishlist/add','WishListController@add')->name('wishlist.add');
Route::get('/wishlist/remove','WishListController@remove')->name('wishlist.remove');
Route::get('/wishlist/list/{uid}','WishListController@list')->name('wishlist.list');

////Product controller routes
Route::get('products/{id}/{cid}','ProductsController@getProd')->name('products.list');
Route::get('product/details/{id}/{subid}/{cid}','ProductsController@detailProd')->name('product.details');
Route::get('product/details/reviews/store','ProductsController@storeReview')->name('product.details.reviews.store');
///cart controller route
Route::get('cart/add','CartController@add')->name('cart.add');
Route::get('cart/show','CartController@show')->name('cart.show');
Route::get('cart/remove','CartController@remove')->name('cart.remove');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');

        /*
         * User Profile Picture
         */
        Route::patch('profile-picture/update', 'ProfileController@updateProfilePicture')->name('profile-picture.update');
    });
});

/*
* Show pages
*/
Route::get('pages/{slug}', 'FrontendController@showPage')->name('pages.show');
