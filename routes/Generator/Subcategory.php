<?php
/**
 * SubCategory
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Subcategory'], function () {
    //    Route::resource('subcategories', 'SubcategoriesController');
        //For Datatable
        Route::get('subcategories/get/{id}', 'SubcategoriesTableController')->name('subcategories.get');
        Route::get('categories/{id}/get','SubcategoriesController@get')->name('categories.id.get');
        Route::post('subcategories/store','SubcategoriesController@store')->name('subcategories.store');
        Route::get('subcategories/edit','SubcategoriesController@edit')->name('subcategories.edit');
        Route::patch('subcategories/update','SubcategoriesController@update')->name('subcategories.update');
        Route::get('subcategories/destory','SubcategoriesController@destroy')->name('subcategories.destroy');
        Route::get('subcategories/{id}/create','SubcategoriesController@create')->name('categories.id.create');
        Route::get('subcategories/edit/{id}','SubcategoriesController@edit')->name('categories.id.edit');

    });
    
});