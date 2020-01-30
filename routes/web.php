<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');
/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');
});

/*
* Routes From Module Generator
*/
includeRouteFiles(__DIR__.'/Generator/');
Route::get('/','Frontend\FrontendController@index')->name('frontend.index');
// Route::get('/register',function(){
//     return view('frontend_user.register');
// });

// includeRouteFiles(__DIR__.'/frontend_user/');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::any('/', function () {
//     $user = \Auth::user();
//     if(isset($user)){
//     dd($user->role);
// 	if ($user->role == 1) {
// 		return redirect('/admin/dashboard');
// 	} else if ($user->role == 2) {
// 		return view('frontend_user.index');
//     }
// }
// });
Route::get('/productvariations',function(){
    return view('backend.products.productvariation');
});