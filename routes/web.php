<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\validator;
use  App\Http\Controllers\db;
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

// Route::get('/', function () {
//     return view('welcome');
// });
 
// Route::view('create','form' );

// Route::post('/save', function () {
//     echo 'welcome';
// });
 
Route::get('create', 'userController@create');
Route::post('save','userController@store');
Route::get('display','userController@display')->Middleware('checklogin');
Route::get('edit/{id}','userController@edit')->where(['id' => '[0-9]+' ])->Middleware('checklogin');;
Route::post('update','userController@update')->Middleware('checklogin');;
Route::get('remove/{id}','userController@remove')->where(['id' => '[0-9]+' ])->Middleware('checklogin');;

Route::get('login/','userController@getLogin');
Route::post('doLogin/','userController@login');

Route::get('logOut/','userController@logOut')->Middleware('checklogin');;

Route::resource('admins','adminsController');
// admins/create