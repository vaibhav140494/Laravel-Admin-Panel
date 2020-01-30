<?php
/**
 * Product
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Product'], function () {
        Route::resource('products', 'ProductsController');
        //For Datatable
        Route::post('products/get', 'ProductsTableController')->name('products.get');
        Route::get('products/ajax/getsubcategories','ProductsController@getSubCategories')->name('products.ajax.subcategrory');
        Route::get('products/productvariations/show/{id}','ProductsController@getProductVariations')->name('products.productvariations.show');
        Route::get('products/productvariations/delete/{id}','ProductsController@deleteVariation')->name('products.productvariations.delete');
        Route::get('products/productvariations/create/{id}','ProductsController@createVariation')->name('products.productvariations.create');
        Route::post('products/productvariations/create','ProductsController@storeVariation')->name('products.productvariations.store');
    });
    
});