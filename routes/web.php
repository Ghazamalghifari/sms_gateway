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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::group(['prefix'=>'sms', 'middleware'=>['auth']], function () {
 
	Route::resource('kontaks', 'KontakController'); 

	Route::resource('grubs', 'GrubController'); 
	Route::resource('anggotas', 'AnggotaController'); 
	Route::resource('sms', 'SmsController'); 

	Route::get('grub/anggota/{id}',[
	'middleware' => ['auth'],
	'as' => 'grubs.anggota',
	'uses' => 'AnggotaController@index'
	] );

	Route::get('grub/kontak/{id}',[
	'middleware' => ['auth'],
	'as' => 'grubs.kontak',
	'uses' => 'AnggotaController@datatable_kontak'
	] );

	Route::get('grub/masuk-kontak/{id_kontak}/{id_grup}',[
	'middleware' => ['auth'],
	'as' => 'grubs.masuk-kontak',
	'uses' => 'AnggotaController@store'
	] );

	Route::get('outbox',[
	'middleware' => ['auth'],
	'as' => 'sms.index',
	'uses' => 'SmsController@index'
	] );

	Route::get('kirim_pesan/kontak',[
	'middleware' => ['auth'],
	'as' => 'sms.create',
	'uses' => 'SmsController@create'
	] );

	Route::get('kirim_pesan/grup',[
	'middleware' => ['auth'],
	'as' => 'sms.create_grup',
	'uses' => 'SmsController@create_grup'
	] );

Route::post('kirim_pesan/grup',[
'middleware' => ['auth'],
'as' => 'sms.store_grup',
'uses' => 'SmsController@store_grup'
] );
	});