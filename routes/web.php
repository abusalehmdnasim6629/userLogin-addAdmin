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

Route::get('/user-registration','verifyController@userReg');
Route::post('/save-user','verifyController@saveUser');
Route::post('/verification','verifyController@verification');
Route::get('/','verifyController@getVerify');
Route::get('/veri','verifyController@postVerify');
Route::get('/user-profile','verifyController@userprofile');
Route::get('/admin-registration','verifyController@adminReg');
Route::post('/save-admin','verifyController@saveAdmin');
Route::get('/admin-login','verifyController@adminLogin');
Route::get('/add-admin/{admin_id}{user_id}','verifyController@addAdmin');
Route::post('/admin-verification','verifyController@adminVerification');
Route::get('/admin-profile','verifyController@adminprofile');
Route::get('/user-logout','verifyController@userLogout');
Route::get('/admin-logout','verifyController@adminLogout');