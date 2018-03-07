<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', 'Admin\AdminController@index');
        Route::get('/get-all-users', 'Admin\AdminController@getAllUsers');
        Route::get('/update-user/{id}', 'Admin\AdminController@showUser');
        Route::get('/get-user/{id}', 'Admin\AdminController@getUser');
        Route::post('/edit-user', 'Admin\AdminController@editUser');
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/profile', 'User\UserController@showProfile');
    Route::get('/get-user', 'User\UserController@getUser');
    Route::post('/edit-profile', 'User\UserController@editProfile');
});