<?php
/**
 * Offer
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Offer'], function () {
        Route::resource('offers', 'OffersController');
        //For Datatable
        Route::post('offers/get', 'OffersTableController')->name('offers.get');
    });
    
});