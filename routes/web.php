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

use App\Models\Ayb_item;

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
    Route::resource('sedes', 'SedesController')->names([
        'index' => 'sedes',
        'create' => 'sedes.create',
        'update' => 'sedes.update',
        'destroy' => 'sedes.destroy'
    ]);
    Route::resource('group_menus', 'GroupmenusController')->names([
        'index' => 'group_menus',
        'create' => 'group_menus.create',
        'update' => 'group_menus.update',
        'destroy' => 'group_menus.destroy'
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
    Route::resource('ayb_items', 'Ayb_itemsController')->names([
        'index' => 'ayb_items',
        'create' => 'ayb_items.create',
        'update' => 'ayb_items.update',
        'destroy' => 'ayb_items.destroy'
    ]);
    Route::resource('ayb_commands', 'Ayb_commandsController')->names([
        'index' => 'ayb_commands',
        'create' => 'ayb_commands.create',
        'update' => 'ayb_commands.update',
        'destroy' => 'ayb_commands.destroy'
    ]);
    Route::resource('attlogs', 'AttlogsController')->names([
        'index' => 'attlogs',
        'create' => 'attlogs.create',
        'update' => 'attlogs.update',
        'destroy' => 'attlogs.destroy'
    ]);


    // VIEW - GRAPHICS
    Route::get('/', 'GraphicsController@index')->name("graphics");
});

Route::get("/menu", function(){
        return view("qr.index")->with('ayb_items',Ayb_item::where(['sede_id' => "6",'group_menu_id' => "2" ])->with('imgs')->get() );
 });

Route::get('{any}', function() {
    return redirect('login');
})->where('any', '.*');
