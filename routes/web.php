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

Auth::routes();
Route::middleware(['auth'])->group(function () {

    // VIEW AND CRUD - USERS
    Route::resource('users', 'UsersController')->names([
        'index' => 'users',
        'create' => 'users.create',
        'update' => 'users.update',
        'destroy' => 'users.destroy'
    ]);
    // VIEW AND CRUD - CLIENTS
    Route::resource('clients', 'ClientsController')->names([
        'index' => 'clients',
        'create' => 'clients.create',
        'update' => 'clients.update',
        'destroy' => 'clients.destroy'
    ]);


    Route::resource('levels', 'LevelsController')->names([
        'index' => 'levels',
        'create' => 'levels.create',
        'update' => 'levels.update',
        'destroy' => 'levels.destroy'
    ]);
    Route::resource('transportations', 'TransportationsController')->names([
        'index' => 'transportations',
        'create' => 'transportations.create',
        'update' => 'transportations.update',
        'destroy' => 'transportations.destroy'
    ]);
    Route::resource('juices', 'JuicesController')->names([
        'index' => 'juices',
        'create' => 'juices.create',
        'update' => 'juices.update',
        'destroy' => 'juices.destroy'
    ]);
    Route::resource('foods', 'FoodsController')->names([
        'index' => 'foods',
        'create' => 'foods.create',
        'update' => 'foods.update',
        'destroy' => 'foods.destroy'
    ]);
    Route::resource('drinks', 'DrinksController')->names([
        'index' => 'drinks',
        'create' => 'drinks.create',
        'update' => 'drinks.update',
        'destroy' => 'drinks.destroy'
    ]);
    Route::resource('machines', 'MachinesController')->names([
        'index' => 'machines',
        'create' => 'machines.create',
        'update' => 'machines.update',
        'destroy' => 'machines.destroy'
    ]);
    Route::resource('tables', 'TablesController')->names([
        'index' => 'tables',
        'create' => 'tables.create',
        'update' => 'tables.update',
        'destroy' => 'tables.destroy'
    ]);


    Route::resource('counting_table_stadistics', 'Counting_table_stadisticsController')->names([
        'index' => 'counting_table_stadistics',
        'create' => 'counting_table_stadistics.create',
        'update' => 'counting_table_stadistics.update',
        'destroy' => 'counting_table_stadistics.destroy'
    ]);
    Route::resource('domains', 'DomainsController')->names([
        'index' => 'domains',
        'create' => 'domains.create',
        'update' => 'domains.update',
        'destroy' => 'domains.destroy'
    ]);
    Route::resource('emails', 'EmailsController')->names([
        'index' => 'emails',
        'create' => 'emails.create',
        'update' => 'emails.update',
        'destroy' => 'emails.destroy'
    ]);


    // VIEW - GRAPHICS
    Route::get('/', 'GraphicsController@index')->name("graphics");

});
Route::get('{any}', function() {
    return redirect('login');
})->where('any', '.*');
