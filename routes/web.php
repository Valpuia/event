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

Route::get('/','EventController@home');
Route::get('/login','EventController@login')->name('login');
Route::get('/allevent','EventController@allevent');
Route::get('/event/{id}','EventController@event');
Route::post('/message','EventController@message');
Route::post('/login','EventController@post_login');
Route::get('/logout','EventController@logout');
Route::get('/pastevent','EventController@pastevent');
Route::post('/feedback','EventController@feedback');
Route::get('/reset/password','EventController@resetpassword');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');


Route::group(['middleware'=> ['auth']], function(){
	Route::get('/create','EventController@create');
	Route::post('/create_event','EventController@create_event');
	Route::post('/change_password','EventController@change_password');
	Route::get('/myevent','EventController@myevent');
	Route::get('/myfeedback','EventController@myfeedback');
});


Route::group(['middleware' => ['admin']], function() {
	Route::get('/admin','EventController@admin');
	Route::get('/events','EventController@events');
	Route::get('/all_message','EventController@all_message');
	Route::get('/manage','EventController@manage');
	Route::get('/department','EventController@department');
	Route::get('/allfeedback','EventController@allfeedback');
	Route::get('/location','EventController@location');
	Route::post('/add_fac','EventController@add_fac');
	Route::post('/del_msg','EventController@del_msg');
	Route::post('/del_fac','EventController@del_fac');
	Route::post('/del_event','EventController@del_event');
	Route::post('/del_feed','EventController@del_feed');
	Route::post('/update_user','EventController@update_user');
	Route::post('/add_dept','EventController@add_dept');
	Route::post('/add_loc','EventController@add_loc');
	Route::post('/update_dept','EventController@update_dept');
	Route::post('/del_dept','EventController@del_dept');
	Route::post('/update_loc','EventController@update_loc');
	Route::post('/del_loc','EventController@del_loc');
});