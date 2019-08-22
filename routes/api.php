<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('user', 'userControl');
Route::resource('produit', 'produitControl')->middleware('cors');;
Route::post('inscription', 'userControl@store')->middleware('cors');;
Route::post('signin', 'userControl@signin')->middleware('cors');;
Route::post('approvisionner','produitControl@update')->middleware('cors');;
Route::post('delete','produitControl@delete')->middleware('cors');;
Route::post('addplat','produitControl@store')->middleware('cors');;





