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
    
        //For product variations
     
        Route::get('products/ajax/getsubcategories','ProductsController@getSubCategories')->name('products.ajax.subcategrory');
        
        Route::get('products/productvariations/show/{pid}','ProductsController@getProductVariations')->name('products.productvariations.show');
        Route::get('products/productvariations/delete/{id}','ProductsController@deleteVariation')->name('products.productvariations.delete');
     
        Route::get('products/productvariations/create/{pid}','ProductsController@createVariation')->name('products.productvariations.create');
        Route::post('products/productvariations/create','ProductsController@storeVariation')->name('products.productvariations.store');
      
        Route::get('products/productvariations/edit/{vid}/{pid}','ProductsController@editVariation')->name('products.productvariations.edit');
        Route::post('products/productvariations/update','ProductsController@updateVariation')
        ->name('products.productvariations.update');
      
        Route::get('products/productimages/upload/{id}','ProductsController@uploadProductImages')->name('products.productimages.upload');
        Route::post('products/productimages/store','ProductsController@storeProductImages')
        ->name('products.productimages.store');
      
        Route::get('products/productimages/galary/{id}','ProductsController@productGalary')->name('products.productimages.galary');
        Route::post('products/productimages/galary/delete','ProductsController@deleteProductImage')->name('products.productimages.galary.delete');



        // For variations add edit delete
        Route::get('variations/show','VariationController@index')->name('variation.show');

        Route::get('variations/create','VariationController@createVariation')->name('products.variations.create');
        Route::post('variations/create','VariationController@storeVariation')->name('products.variations.store');
        Route::post('variation/getAllValues','VariationController@getValuesAjax')->name('variation.get.ajax');

        Route::get('variations/edit/{vid}','VariationController@editVariation')->name('products.variations.edit');
        Route::post('variations/update','VariationController@updateVariation')->name('products.variations.update');
    });
    
});
