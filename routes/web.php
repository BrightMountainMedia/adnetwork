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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/user/current', 'UserController@current');
Route::post('/support/email', 'SupportController@sendEmail');

// Front-End Pages
Route::get('/dashboard', 'DashboardController@index');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/publishers', 'AdminController@allPublishers');
Route::get('/admin/publisher/{id}/publisher_profile', 'AdminController@show');
Route::post('/admin/publisher/add_stat', 'AdminController@storeStat');

Route::get('/admin/add-user-role', ['as' => 'role', 'uses' => 'RoleController@create']);
Route::post('/admin/add-user-role', ['as' => 'role.store', 'uses' => 'RoleController@store']);
Route::post('/admin/add-user-role/{id}', 'RoleController@destroy');

Route::get('/admin/add-stats', 'StatsController@index');
Route::get('/admin/add-stats/{id}/publisher_profile', 'StatsController@profile');
Route::post('/admin/add-stats/add_stats', 'StatsController@store');
// Route::put('/admin/add-stats/{id}/stats_update', 'StatsController@update');

Route::get('/profile', ['as' => 'profile', 'uses' => 'ProfileController@create']);
Route::post('/profile', ['as' => 'profile_store', 'uses' => 'ProfileController@store']);

Route::get('/security', ['as' => 'security', 'uses' => 'SecurityController@create']);
Route::post('/security', ['as' => 'security_update', 'uses' => 'SecurityController@update']);