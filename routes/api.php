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
Route::get('/ayb_records/service', 'Ayb_recordsController@service')->name('ayb_records.service');
Route::get('/attlogs/service', 'AttlogsController@service')->name('attlogs.service');
Route::get('/all_machines/service', 'All_machinesController@service')->name('all_machines.service');
Route::get('/brand_machines/service', 'Brand_machinesController@service')->name('brand_machines.service');
Route::get('/model_machines/service', 'Model_machinesController@service')->name('model_machines.service');
Route::get('/range_machines/service', 'Range_machinesController@service')->name('range_machines.service');
Route::get('/associated_machines/service', 'Associated_machinesController@service')->name('associated_machines.service');
Route::get('/play_machines/service', 'Play_machinesController@service')->name('play_machines.service');
Route::get('/value_machines/service', 'Value_machinesController@service')->name('value_machines.service');
Route::get('/sexs/service', 'SexsController@service')->name('sexs.service');
Route::get('/departments/service', 'DepartmentsController@service')->name('departments.service');
Route::get('/positions/service', 'PositionsController@service')->name('positions.service');
Route::get('/employees/service', 'EmployeesController@service')->name('employees.service');
Route::get('/global_warehouses/service', 'Global_warehousesController@service')->name('global_warehouses.service');
Route::get('/rooms/service', 'RoomsController@service')->name('rooms.service');
Route::get('/type_commands/service', 'Type_commandsController@service')->name('type_commands.service');
Route::get('/year_month_groups/service', 'Year_month_groupsController@service')->name('year_month_groups.service');
Route::get('/horarios/service', 'HorariosController@service')->name('horarios.service');
Route::get('/mesas_casinos/service', 'Mesas_casinosController@service')->name('mesas_casinos.service');
Route::get('/stack_casinos/service', 'Stack_casinosController@service')->name('stack_casinos.service');
Route::get('/fichas_casinos/service', 'Fichas_casinosController@service')->name('fichas_casinos.service');
Route::get('/horas_casinos/service', 'Horas_casinosController@service')->name('horas_casinos.service');
Route::get('/billetes_casinos/service', 'Billetes_casinosController@service')->name('billetes_casinos.service');
Route::get('/group_drops_casinos/service', 'Group_drops_casinosController@service')->name('group_drops_casinos.service');
Route::get('/group_archings_casinos/service', 'Group_archings_casinosController@service')->name('group_archings_casinos.service');
Route::get('/condicion_groups/service', 'Condicion_groupsController@service')->name('condicion_groups.service');
Route::get('/novedades_types/service', 'Novedades_typesController@service')->name('novedades_types.service');
Route::get('/cierre_mesas/service', 'Cierre_mesasController@service')->name('cierre_mesas.service');

Route::get('/metodo_pagos/service', 'Metodo_pago_boveda_casinosController@service')->name('metodo_pagos.service');







// ISAPI
//POST
Route::post('/isapi/getEvent', 'isapiController@getEvent')->name('isapi.getEvent');
Route::post('/isapi/getMatches', 'isapiController@getMatches')->name('isapi.getMatches');


Route::post('/isapi/addOrUpdateEmployee', 'isapiController@addOrUpdateEmployee')->name('isapi.addOrUpdateEmployee');
Route::post('/isapi/elimEmployee', 'isapiController@elimEmployee')->name('isapi.elimEmployee');


Route::post('/isapi/uploadEmployees', 'isapiController@uploadEmployees')->name('isapi.uploadEmployees');
Route::post('/isapi/sendImg', 'isapiController@sendImg')->name('isapi.sendImg');




//GET
Route::post('/isapi/authImgIsapi', 'isapiController@authImgIsapi')->name('isapi.authImgIsapi');


Route::post('/schedule_templates/viewSchedule', 'Schedule_templatesController@viewSchedule')->name('schedule_templates.viewSchedule');
Route::post('/schedule_templates/viewScheduleAll', 'Schedule_templatesController@viewScheduleAll')->name('schedule_templates.viewScheduleAll');
Route::post('/schedule_templates/viewYearMonthGroup', 'Schedule_templatesController@viewYearMonthGroup')->name('schedule_templates.viewYearMonthGroup');

// list
Route::post('/all_machines/listModel', 'All_machinesController@listModel')->name('all_machines.listModel');
Route::post('/global_warehouses/listModel', 'Global_warehousesController@listModel')->name('global_warehouses.listModel');

// history
Route::post('/employees/history', 'EmployeesController@history')->name('employees.history');

// ALL JOINS DATABASE
Route::post('/ayb_commands/pjoin', 'Ayb_commandsController@pjoin')->name('ayb_commands.pjoin');

// LIST
Route::post('/conteo_drop_cecom_casinos/list', 'Conteo_drop_cecom_casinosController@list')->name('conteo_drop_cecom_casinos.list');
Route::post('/conteo_archings_cecom_casinos/list', 'Conteo_archings_cecom_casinosController@list')->name('conteo_archings_cecom_casinos.list');

// LIST
Route::post('/conteo_drop_boveda_casinos/list', 'Conteo_drop_boveda_casinosController@list')->name('conteo_drop_boveda_casinos.list');
Route::post('/conteo_arching_cecom_casinos/list', 'Conteo_arching_boveda_casinosController@list')->name('conteo_arching_boveda_casinos.list');
Route::post('/conteo_efectivo_cecom_casinos/list', 'Conteo_efectivo_boveda_casinosController@list')->name('conteo_efectivo_boveda_casinos.list');




// LIST FICHAS SEDES
Route::get('/stack_casinos/fichas/sede/{sede_id}/{mesa_casino_id}', 'Stack_casinosController@fichasSede')->name('stack_casinos.fichasSede');