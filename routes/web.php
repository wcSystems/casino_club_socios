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
use App\Models\Sede;
use App\Models\Group_menu;
use App\Models\Schedule_template;
use App\Models\Department;
use App\Models\Type_command;
use App\Models\Employee;

use App\Models\Ayb_command;
use App\Models\Ayb_item_command;
use App\Models\Table;
use App\Models\Year_month_group;
use App\Models\Horario;

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


    Route::resource('all_machines', 'All_machinesController')->names([
        'index' => 'all_machines',
        'create' => 'all_machines.create',
        'update' => 'all_machines.update',
        'destroy' => 'all_machines.destroy'
    ]);
    Route::resource('brand_machines', 'Brand_machinesController')->names([
        'index' => 'brand_machines',
        'create' => 'brand_machines.create',
        'update' => 'brand_machines.update',
        'destroy' => 'brand_machines.destroy'
    ]);
    Route::resource('model_machines', 'Model_machinesController')->names([
        'index' => 'model_machines',
        'create' => 'model_machines.create',
        'update' => 'model_machines.update',
        'destroy' => 'model_machines.destroy'
    ]);
    Route::resource('range_machines', 'Range_machinesController')->names([
        'index' => 'range_machines',
        'create' => 'range_machines.create',
        'update' => 'range_machines.update',
        'destroy' => 'range_machines.destroy'
    ]);
    Route::resource('associated_machines', 'Associated_machinesController')->names([
        'index' => 'associated_machines',
        'create' => 'associated_machines.create',
        'update' => 'associated_machines.update',
        'destroy' => 'associated_machines.destroy'
    ]);
    Route::resource('play_machines', 'Play_machinesController')->names([
        'index' => 'play_machines',
        'create' => 'play_machines.create',
        'update' => 'play_machines.update',
        'destroy' => 'play_machines.destroy'
    ]);
    Route::resource('value_machines', 'Value_machinesController')->names([
        'index' => 'value_machines',
        'create' => 'value_machines.create',
        'update' => 'value_machines.update',
        'destroy' => 'value_machines.destroy'
    ]);

    Route::resource('sexs', 'SexsController')->names([
        'index' => 'sexs',
        'create' => 'sexs.create',
        'update' => 'sexs.update',
        'destroy' => 'sexs.destroy'
    ]);

    Route::resource('departments', 'DepartmentsController')->names([
        'index' => 'departments',
        'create' => 'departments.create',
        'update' => 'departments.update',
        'destroy' => 'departments.destroy'
    ]);

    Route::resource('positions', 'PositionsController')->names([
        'index' => 'positions',
        'create' => 'positions.create',
        'update' => 'positions.update',
        'destroy' => 'positions.destroy'
    ]);

    Route::resource('employees', 'EmployeesController')->names([
        'index' => 'employees',
        'create' => 'employees.create',
        'update' => 'employees.update',
        'destroy' => 'employees.destroy'
    ]);
    Route::resource('schedule_templates', 'Schedule_templatesController')->names([
        'index' => 'schedule_templates',
        'create' => 'schedule_templates.create',
        'update' => 'schedule_templates.update',
        'destroy' => 'schedule_templates.destroy'
    ]);

    Route::resource('global_warehouses', 'Global_warehousesController')->names([
        'index' => 'global_warehouses',
        'create' => 'global_warehouses.create',
        'update' => 'global_warehouses.update',
        'destroy' => 'global_warehouses.destroy'
    ]);
 
    Route::resource('rooms', 'RoomsController')->names([
        'index' => 'rooms',
        'create' => 'rooms.create',
        'update' => 'rooms.update',
        'destroy' => 'rooms.destroy'
    ]);

    Route::resource('type_commands', 'Type_commandsController')->names([
        'index' => 'type_commands',
        'create' => 'type_commands.create',
        'update' => 'type_commands.update',
        'destroy' => 'type_commands.destroy'
    ]);

    Route::resource('year_month_groups', 'Year_month_groupsController')->names([
        'index' => 'year_month_groups',
        'create' => 'year_month_groups.create',
        'update' => 'year_month_groups.update',
        'destroy' => 'year_month_groups.destroy'
    ]);

    Route::resource('horarios', 'HorariosController')->names([
        'index' => 'horarios',
        'create' => 'horarios.create',
        'update' => 'horarios.update',
        'destroy' => 'horarios.destroy'
    ]);

    Route::resource('mesas_casinos', 'Mesas_casinosController')->names([
        'index' => 'mesas_casinos',
        'create' => 'mesas_casinos.create',
        'update' => 'mesas_casinos.update',
        'destroy' => 'mesas_casinos.destroy'
    ]);

    Route::resource('fichas_casinos', 'Fichas_casinosController')->names([
        'index' => 'fichas_casinos',
        'create' => 'fichas_casinos.create',
        'update' => 'fichas_casinos.update',
        'destroy' => 'fichas_casinos.destroy'
    ]);

    Route::resource('horas_casinos', 'Horas_casinosController')->names([
        'index' => 'horas_casinos',
        'create' => 'horas_casinos.create',
        'update' => 'horas_casinos.update',
        'destroy' => 'horas_casinos.destroy'
    ]);

    Route::resource('billetes_casinos', 'Billetes_casinosController')->names([
        'index' => 'billetes_casinos',
        'create' => 'billetes_casinos.create',
        'update' => 'billetes_casinos.update',
        'destroy' => 'billetes_casinos.destroy'
    ]);

    Route::resource('group_drops_casinos', 'Group_drops_casinosController')->names([
        'index' => 'group_drops_casinos',
        'create' => 'group_drops_casinos.create',
        'update' => 'group_drops_casinos.update',
        'destroy' => 'group_drops_casinos.destroy'
    ]);

    
    Route::resource('conteo_drop_cecom_casinos', 'Conteo_drop_cecom_casinosController')->names([
        'index' => 'conteo_drop_cecom_casinos',
        'create' => 'conteo_drop_cecom_casinos.create',
        'update' => 'conteo_drop_cecom_casinos.update',
        'destroy' => 'conteo_drop_cecom_casinos.destroy'
    ]);


    // VIEW - GRAPHICS
    Route::get('/', 'GraphicsController@index')->name("graphics");
});

// VIEW - MENU DINAMIC
Route::get("/menu/{sede_id}", function($sede_id){
        return view("qr.index")
            ->with('ayb_items',Ayb_item::where(['sede_id' => $sede_id])->with('imgs')->get() )
            ->with('sede',Sede::where(['id' => $sede_id])->first() )
            ->with('group_menus',Group_menu::all() );
});

// VIEW - MENU DINAMIC
Route::get("/new_command/", function( ){
        return view("new_command.index")
            ->with('ayb_items',Ayb_item::all() )
            ->with('sede',Sede::all() )
            ->with('group_menus',Group_menu::all() )
            ->with('type_commands',Type_command::all() )
            
            ->with('ayb_commands',Ayb_command::all())
            ->with('ayb_item_commands',Ayb_item_command::all())
            ->with('tables',Table::all())

            ->with('employees',Employee::whereIn('department_id', [16])->get()  );
});

// VIEW - SCHEDULE DEPARTMENT
Route::get("/schedule_department/{department_id}/{year_month_group_id}/{day_init}/{day_end}", function($department_id,$year_month_group_id,$day_init,$day_end){


        $department = Department::where("id","=",$department_id)->first();
        $year_month_group = Year_month_group::where("id","=",$year_month_group_id)->first();
        $horarios = Horario::all();

        $schedule = DB::table('schedule_templates')->selectRaw('schedule_templates.*, employees.name AS employee_name, departments.id AS department_id, departments.name AS department_name, employees.employeeNo AS employeeNo, year_month_groups.year AS year, year_month_groups.month AS month')
            ->where('departments.id','=',$department_id)
            ->where('year_month_group_id','=',$year_month_group_id)
            ->join('year_month_groups', 'schedule_templates.year_month_group_id', '=', 'year_month_groups.id')
            ->join('employees', 'schedule_templates.employee_id', '=', 'employees.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->get();

        return view("schedule_department.index")->with('schedule',$schedule )->with('department',$department )->with('year_month_group',$year_month_group )->with('horarios',$horarios )->with('day_init',$day_init )->with('day_end',$day_end );
});



Route::get('{any}', function() {
    return redirect('login');
})->where('any', '.*');
