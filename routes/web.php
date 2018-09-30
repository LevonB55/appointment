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

//Users Routes...
// Route::resource('user','UserController', ['except' => ['create', 'store', 'destroy']]); 
Route::get('/', 'UserController@index')->name('homepage');
Route::get('user', 'UserController@index')->name('user.index');
Route::get('user/{user}', 'UserController@show')->name('user.show')->middleware('checkuser');//////////////
Route::put('user/{user}', 'UserController@update')->name('user.update');
Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');
Route::get('search', 'UserController@searchDoctors')->name('doctors.search');
Route::get('doctor/search', 'UserController@searchDoctorsDropdown')->name('doctors.searhdropdown');

// Authentication/Registration Routes...
Auth::routes();
Route::get('getLogout', 'Auth\LoginController@getLogout')->name('getLogout')->middleware('auth');

//Appointments Routes...
Route::group(['middleware' => ['auth']], function () {
	// Route::resource('appointments','AppointmentController', ['except' => ['create', 'index', 'edit', 'update']]);
	
	Route::group(['middleware' => ['role:doctor', 'checkdoctor','permission:edit appointment|cancel appointment']], function () {
		// Route::group(['middleware' => ['checkdoctor']], function () {
			Route::post('appointments', 'AppointmentController@store')->name('appointments.store');
			Route::delete('appointments/{appointment}', 'AppointmentController@destroy')->name('appointments.destroy');
			Route::get('appointments/create/{id}', 'AppointmentController@create')->name('appointments.create');
			Route::post('appointments/cancel/{id}', 'AppointmentController@cancelAppointment')->name('appointments.cancel');
			Route::get('appointments/list/{id}', 'AppointmentController@index')->name('appointments.index');
		// });	
	});

	Route::get('appointments/{appointment}', 'AppointmentController@show')->name('appointments.show');
	Route::get('appointments/hours/{id}', 'AppointmentController@showAppointmentHours')->name('appointments.hours');
	Route::post('appointments/make/{id}', 'AppointmentController@makeAppointment')->name('appointments.make');
	Route::get('appointments/confirmed/{id}', 'AppointmentController@confirmedAppointment')->name('appointments.confirmed');
});