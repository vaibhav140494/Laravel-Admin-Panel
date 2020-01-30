<?php
/**
 * SubCategory
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Subcategory'], function () {
        Route::resource('subcategories', 'SubcategoriesController');
        //For Datatable
        Route::get('subcategories/get/{id}', 'SubcategoriesTableController')->name('subcategories.get');
        Route::get('categories/{id}/get','SubcategoriesController@get')->name('categories.id.get');

        Route::get('subcategories/{id}/create','SubcategoriesController@create')->name('categories.id.create');
        Route::get('subcategories/{id}/edit','SubcategoriesController@edit')->name('categories.id.edit');

    });
    
});