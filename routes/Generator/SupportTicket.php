<?php
/**
 * SupportTicket
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'SupportTicket'], function () {
        Route::resource('supporttickets', 'SupportTicketsController');
        //For Datatable
        Route::post('supporttickets/get', 'SupportTicketsTableController')->name('supporttickets.get');
    });
    
});