<?php
/**
 * Order
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Order'], function () {
        Route::resource('orders', 'OrdersController');
        //For Datatable
        Route::post('orders/get', 'OrdersTableController')->name('orders.get');
        Route::get('view/order/details/{id}','OrdersController@viewOrder')->name('view.order');
        Route::post('update/order/status','OrdersController@updateStatus')->name('update.order.status');
    });
    
});