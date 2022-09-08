<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('accomodations', 'Api\AccomodationController@index')->name('api.accomodations.index');
Route::get('accomodation/{id}', 'Api\AccomodationController@show')->name('api.accomodation.show');
Route::get('accomodations/search', 'Api\AccomodationController@search')->name('api.accomodations.search');

Route::get('services', 'Api\ServiceController@index')->name('api.service.index');

Route::get('search', 'Api\SearchController@index')->name('api.search.index');