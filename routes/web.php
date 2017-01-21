<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/




Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', 'UserController@index');
        Route::put('/updateDetails/{id}', 'UserController@updateDetails');
        Route::put('/updateImage/{id}', 'UserController@updateImage');
        Route::put('/updatePassword/{id}', 'UserController@updatePassword');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['middleware' => ['permission:list-users'], 'uses' =>  'UserController@users']);
        Route::get('/{id}',['middleware' => ['permission:show-user'], 'uses' => 'UserController@show']);
        Route::post('/updateRoles/{id}', ['middleware' => ['permission:update-user-roles'], 'uses' => 'UserController@updateRoles']);

    });
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', ['middleware' => ['permission:list-roles'], 'uses' => 'RoleController@index']);
        Route::post('/store', ['middleware' => ['permission:store-role'], 'uses' => 'RoleController@store']);
        Route::put('/update/{id}', ['middleware' => ['permission:update-role'], 'uses' => 'RoleController@update']);
        Route::post('/updatePerms/{id}', ['middleware' => ['permission:update-role-perms'], 'uses' => 'RoleController@updatePerms']);
        Route::delete('/destroy/{id}', ['middleware' => ['permission:delete-role'], 'uses' => 'RoleController@destroy']);

    });
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/', 'ContactController@create');
        Route::post('/store', 'ContactController@store');
        Route::get('/{id}', 'ContactController@edit');
        Route::put('/updateDetails/{id}', 'ContactController@updateDetails');
        Route::put('/updateImage/{id}', 'ContactController@updateImage');
        Route::post('/updateGroups/{id}', 'ContactController@updateGroups');
        Route::delete('/destroy/{id}', 'ContactController@destroy');

    });
    Route::group(['prefix' => 'group'], function () {
        Route::post('/store/{id}', 'GroupController@store');
        Route::put('/update/{id}', 'GroupController@update');
        Route::delete('/destroy/{id}', 'GroupController@destroy');

    });

});
