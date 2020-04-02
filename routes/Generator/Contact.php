<?php
/**
 * Routes for : Contact
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
	
	Route::group( ['namespace' => 'Contact'], function () {
	    Route::get('contacts', 'ContactsController@index')->name('contacts.index');
	    
	    
	    
	    //For Datatable
	    Route::post('contacts/get', 'ContactsTableController')->name('contacts.get');
	});
	
});