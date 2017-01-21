<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->post('login', 'App\Http\Controllers\Api\v1\AuthController@login');
    $api->get('myAccount', 'App\Http\Controllers\Api\v1\UserController@user');
    $api->get('userContacts', 'App\Http\Controllers\Api\v1\UserController@userContacts');
    $api->get('userGroups', 'App\Http\Controllers\Api\v1\UserController@userGroups');
    $api->get('users', 'App\Http\Controllers\Api\v1\AuthController@users');
    $api->post('updateDetails', 'App\Http\Controllers\Api\v1\UserController@updateDetails');
    $api->post('updateImage', 'App\Http\Controllers\Api\v1\UserController@updateImage');
    $api->post('updatePassword', 'App\Http\Controllers\Api\v1\UserController@updatePassword');
    $api->post('updateRoles', 'App\Http\Controllers\Api\v1\UserController@updateRoles');

    $api->group(['prefix' => 'contact'], function ($api) {
        $api->post('/store', 'App\Http\Controllers\Api\v1\ContactController@store');
        $api->post('/update/{id}', 'App\Http\Controllers\Api\v1\ContactController@update');
        $api->post('/updateImage/{id}', 'App\Http\Controllers\Api\v1\ContactController@updateImage');
        $api->post('/delete/{id}', 'App\Http\Controllers\Api\v1\ContactController@destroy');
        $api->post('/updateGroups/{id}', 'App\Http\Controllers\Api\v1\ContactController@updateGroups');
        $api->post('/export', 'App\Http\Controllers\Api\v1\ContactController@export');
        $api->post('/test', 'App\Http\Controllers\Api\v1\ContactController@test');
    });
});