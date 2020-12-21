<?php

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'isInstalledCheck']
    ],
    function()
    {
        Route::prefix('user')->group(function() {

            Route::group(['middleware'=>['loginCheck', "XSS"]],function(){

                Route::get('/', 'UserController@userList')->name('users-list')->middleware('permissionCheck:users_read');
                Route::get('/create', 'UserController@create')->name('user-create')->middleware('permissionCheck:users_write');
                Route::post('/store', 'UserController@store')->name('user-store')->middleware('permissionCheck:users_write');
                Route::post('/update/user-info/{id}', 'UserController@updateUserInfo')->name('update-user-info')->middleware('permissionCheck:users_write');
                Route::post('/update/my-info/{id}', 'UserController@updateUserInfo')->name('update-my-info');

                //role and permissions
                Route::get('/roles', 'RolesPermissionsController@index')->name('roles')->middleware('permissionCheck:role_read');
                Route::get('/role-add', 'RolesPermissionsController@addRole')->name('new-role-add')->middleware('permissionCheck:role_write');
                Route::post('/role-add', 'RolesPermissionsController@postAddRole')->middleware('permissionCheck:role_write');
                Route::get('/edit/role/{id}', 'RolesPermissionsController@editRole')->name('user.edit-role-and-permissions')->middleware('permissionCheck:role_write');
                Route::post('/edit/role/{id}', 'RolesPermissionsController@postEditRole')->middleware('permissionCheck:role_write');
                Route::post('/change-role/{user_id}/{role_id}', 'RolesPermissionsController@changeRole')->name('change-role')->middleware('permissionCheck:users_write');
                Route::get('/ban-user/{user_id}', 'RolesPermissionsController@banUser')->name('ban-user')->middleware('permissionCheck:users_write');
                Route::get('/unban-user/{user_id}', 'RolesPermissionsController@unBanUser')->name('unban-user')->middleware('permissionCheck:users_write');

                Route::get('/permissions', 'RolesPermissionsController@permissions')->name('permissions')->middleware('permissionCheck:permission_read');
                Route::post('/change-role-permission-by-module', 'RolesPermissionsController@changeRolePermissionByModule')->name('change-role-permission-by-module')->middleware('permissionCheck:permission_write');

                //user account
                Route::get('/my-profile', 'UserController@myProfile')->name('user-account');
                Route::post('/change-password/by-me', 'UserController@changePasswordByMe')->name('change-password-by-me');

            });

            //user registration
            // Route::get('/registration', 'RegistrationController@index')->name('registration');
            // Route::post('/registration', 'RegistrationController@postReg')->name('do-registration');
            Route::get('activation/{email}/{activationCode}','RegistrationController@activation');

            //forgot password
            // Route::get('/forgot-password','ForgotPasswordController@forgotPassword')->name('forget-password');
            // Route::post('/forgot-password','ForgotPasswordController@postForgotPassword')->name('do-forget-password');
            // Route::get('reset/{email}/{activationCode}','ForgotPasswordController@resetPassword');
            // Route::post('reset/{email}/{activationCode}','ForgotPasswordController@PostResetPassword')->name('reset-password');

            //user login
            // Route::get('/login', 'LoginController@index')->name('login');
            // Route::post('/login', 'LoginController@postLogin')->name('do-login');
            // Route::post('logout','\App\Http\Controllers\Site\UserController@logout')->name('user-logout');
        });
});
