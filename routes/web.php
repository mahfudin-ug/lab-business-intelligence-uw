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

Route::group(['middleware' => 'auth'], function () {
	/**
	 * Dashboard
	 */
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/grade', 'GradeController@index')->name('grade');
    Route::get('/instructor', 'InstructorController@index')->name('instructor');
    Route::get('/course', 'CourseController@index')->name('course');
    Route::get('/subject', 'SubjectController@index')->name('subject');
    Route::get('/room', 'RoomController@index')->name('room');


});

// Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');


Route::get('/', function() { return redirect('/login'); })->name('main');

Route::view('/test', 'dashboard');