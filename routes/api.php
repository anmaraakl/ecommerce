<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user','api\AuthController@user');

route::resource('products','api\ProductsController');
route::post('/register','api\AuthController@register');
route::post('/login','api\AuthController@login');
// route::get('/user','api\AuthController@user');
// route::post('/store','api\ProductsController@store');
Route::middleware('auth:api')->post('/store','api\ProductsController@store');
Route::post('/edit','api\ProductsController@edit');

