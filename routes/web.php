<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
})->middleware('auth');
///////->group()/////share commn attributes like prefix , middleware ,name spacing,controller
///////route::prefix('admin')->group(function(){});
///////middleware-> access control
///////name space ->
Route::get('/showadduser', 'UserController@showadduser');
Route::post('/adduser', 'UserController@adduser');
Route::get('/myInfo', 'UserController@myInfo');
Route::get('/showUpdateInfo','UserController@showUpdateInfo');
Route::post('/upateinformation','UserController@upateinformation');
Route::get('/showChangePassword','UserController@showChangePassword');
Route::post('/changePassword','UserController@changePassword');
Route::get('/users','UserController@AllUsers')->name('users');//////////for link action with url
Route::get('/deleteUser/{id}','UserController@deleteUser');
Route::get('/upgradeUser/{id}','UserController@upgradeUser');
Route::get('/showUpdateUser/{id}','UserController@showUpdateUser');
Route::post('/update','UserController@update');

Route::get('/lang/{local}','LangController@swap')->name('lang');
Route::get('/contactus','ContactController@showcontact');
Route::post('/send','ContactController@send');/////////////////

Route::get('/configAccount','ConfigController@showconfig');
route::get('/config','ConfigController@config');

route::get('/showRessetPassword','ForgetPassController@showRessetPassword');
route::post('/ressetpass','ForgetPassController@ressetpass');
route::get('/passres','ForgetPassController@passres');
route::get('/resetPassword','ForgetPassController@resetPassword');
route::post('/reset','ForgetPassController@reset');



Route::resource('products','ProductController');
Route::get('/assignto/{id}','HomeController@assignto');
Route::post('/assign','HomeController@assign');
Route::get('/myProduct','HomeController@myProduct');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
