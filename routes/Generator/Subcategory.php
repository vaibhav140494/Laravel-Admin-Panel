<?php
/**
 * SubCategory
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Subcategory'], function () {
        Route::resource('subcategories', 'SubcategoriesController');
        //For Datatable
        Route::post('subcategories/get', 'SubcategoriesTableController')->name('subcategories.get');
    });
    
});