<?php

/**
 * All route names are prefixed with 'admin.access'.
 */
Route::group([
    'prefix'    => 'access',
    'as'        => 'access.',
    'namespace' => 'Access',
], function () {

    /*
     * User Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-access-management',
    ], function () {
        Route::group(['namespace' => 'User'], function () {
            /*
             * For DataTables
             */
            Route::post('user/get', 'UserTableController')->name('user.get');

            /*
             * User Status'
             */
            Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
            Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');

            /*
             * User CRUD
             */
            Route::resource('user', 'UserController');

            /*
             * Specific User
             */
            Route::group(['prefix' => 'user/{user}'], function () {
                // Account
                Route::get('account/confirm/resend', 'UserConfirmationController@sendConfirmationEmail')->name('user.account.confirm.resend');

                // Status
                Route::get('mark/{status}', 'UserStatusController@mark')->name('user.mark')->where(['status' => '[0,1]']);

                // Password
                Route::get('password/change', 'UserPasswordController@edit')->name('user.change-password');
                Route::patch('password/change', 'UserPasswordController@update')->name('user.change-password');

                // Access
                Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');

                // Session
                Route::get('clear-session', 'UserSessionController@clearSession')->name('user.clear-session');
            });

            /*
             * Deleted User
             */
            Route::group(['prefix' => 'user/{deletedUser}'], function () {
                Route::get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
                Route::get('restore', 'UserStatusController@restore')->name('user.restore');
            });
            Route::post('users/address/delete','UserController@deleteAddress')->name('user.address.delete');    
            Route::get('users/address/edit/{id}','UserController@editAddress')->name('user.address.edit');
            Route::patch('users/address/{id}/update','UserController@updateAddress')->name('user.address.update');
            Route::get('users/address/add/{id}','UserController@addAddress')->name('user.address.add');
            Route::post('users/address/{id}/store','UserController@storeAddress')->name('user.address.store');
        });

        /*
        * Role Management
        */
        Route::group(['namespace' => 'Role'], function () {
            Route::resource('role', 'RoleController', ['except' => ['show']]);

            //For DataTables
            Route::post('role/get', 'RoleTableController')->name('role.get');
        });

        /*
        * Permission Management
        */
        Route::group(['namespace' => 'Permission'], function () {
            Route::resource('permission', 'PermissionController', ['except' => ['show']]);

            //For DataTables
            Route::post('permission/get', 'PermissionTableController')->name('permission.get');
        });
    });
});
