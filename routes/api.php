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

// DATATABLES SERVICES
Route::get('/users/service', 'UsersController@service')->name('users.service');
Route::get('/clients/service', 'ClientsController@service')->name('clients.service');
Route::get('/levels/service', 'levelsController@service')->name('levels.service');
Route::get('/transportations/service', 'transportationsController@service')->name('transportations.service');
Route::get('/juices/service', 'juicesController@service')->name('juices.service');
Route::get('/foods/service', 'foodsController@service')->name('foods.service');
Route::get('/drinks/service', 'drinksController@service')->name('drinks.service');
Route::get('/machines/service', 'machinesController@service')->name('machines.service');
Route::get('/tables/service', 'tablesController@service')->name('tables.service');