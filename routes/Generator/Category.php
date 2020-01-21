<?php
/**
 * Category
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Category'], function () {
        Route::resource('categories', 'CategoriesController');
        //For Datatable
        Route::post('categories/get', 'CategoriesTableController')->name('categories.get');
    });
    
});