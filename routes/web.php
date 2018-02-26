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

Route::namespace('Admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
	Route::get('admin', 'AdminController@index');

});

// route to show the registration form
// Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
// route to process the registration form
// Route::post('/add-user', 'Auth\RegisterController@register');
// route to show the login form
// Route::get('/login', 'Auth\LoginController@showLoginForm');
// route to process login form
// Route::get('/login-user', 'Auth\LoginController@LoginUser');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
