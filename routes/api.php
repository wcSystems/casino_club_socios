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
Route::get('/levels/service', 'LevelsController@service')->name('levels.service');
Route::get('/sedes/service', 'SedesController@service')->name('sedes.service');
Route::get('/group_menus/service', 'GroupmenusController@service')->name('group_menus.service');
Route::get('/transportations/service', 'TransportationsController@service')->name('transportations.service');
Route::get('/juices/service', 'JuicesController@service')->name('juices.service');
Route::get('/foods/service', 'FoodsController@service')->name('foods.service');
Route::get('/drinks/service', 'DrinksController@service')->name('drinks.service');
Route::get('/machines/service', 'MachinesController@service')->name('machines.service');
Route::get('/tables/service', 'TablesController@service')->name('tables.service');
Route::get('/counting_table_stadistics/service', 'Counting_table_stadisticsController@service')->name('counting_table_stadistics.service');
Route::get('/domains/service', 'DomainsController@service')->name('domains.service');
Route::get('/emails/service', 'EmailsController@service')->name('emails.service');
Route::get('/ayb_items/service', 'Ayb_itemsController@service')->name('ayb_items.service');
Route::get('/ayb_commands/service', 'Ayb_commandsController@service')->name('ayb_commands.service');
Route::get('/attlogs/service', 'AttlogsController@service')->name('attlogs.service');



Route::get('/all_machines/service', 'All_machinesController@service')->name('all_machines.service');
Route::get('/brand_machines/service', 'Brand_machinesController@service')->name('brand_machines.service');
Route::get('/model_machines/service', 'Model_machinesController@service')->name('model_machines.service');
Route::get('/range_machines/service', 'Range_machinesController@service')->name('range_machines.service');
Route::get('/associated_machines/service', 'Associated_machinesController@service')->name('associated_machines.service');
Route::get('/play_machines/service', 'Play_machinesController@service')->name('play_machines.service');
Route::get('/value_machines/service', 'Value_machinesController@service')->name('value_machines.service');

Route::get('/all_machines/listModel', 'All_machinesController@listModel')->name('all_machines.listModel');



// ISAPI
Route::get('/isapi/getEvent', 'isapiController@getEvent')->name('isapi.getEvent');







// ALL JOINS DATABASE
Route::post('/ayb_commands/pjoin', 'Ayb_commandsController@pjoin')->name('ayb_commands.pjoin');