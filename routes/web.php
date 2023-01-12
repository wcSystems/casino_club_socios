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
Route::get("/schedule_department/{department_id}/{year}/{mont}", function($department_id,$year,$month){


    $all_group = Schedule_template::selectRaw('year, month')
                    ->where('year','=',$year)
                    ->where('month','=',$month)
                    ->groupBy('year','month')->orderBy('year','desc')
                    ->orderBy('month','desc')
                    ->get();
        

    $schedule_group_employee = DB::table('schedule_templates')->selectRaw('year, month, employee_id, employees.name AS employee_name, departments.id AS department_id, departments.name AS department_name, employees.employeeNo AS employeeNo')
                    ->where('department_id','=',$department_id)
                    ->join('employees', 'schedule_templates.employee_id', '=', 'employees.id')
                    ->join('departments', 'employees.department_id', '=', 'departments.id')
                    ->groupBy('year','month','employee_id')
                    ->orderBy('year','desc')
                    ->orderBy('month','desc')
                    ->get();

        foreach ($schedule_group_employee as $key => $value_schedule_group_employee) {
            
            $value_schedule_group_employee->schedule = DB::table('schedule_templates')->selectRaw('schedule_templates.*,employees.name AS employee_name, departments.id AS department_id, departments.name AS department_name')
                                                        ->where('employee_id','=',$value_schedule_group_employee->employee_id)
                                                        ->where('year','=',$value_schedule_group_employee->year)
                                                        ->where('month','=',$value_schedule_group_employee->month)
                                                        ->join('employees', 'schedule_templates.employee_id', '=', 'employees.id')
                                                        ->join('departments', 'employees.department_id', '=', 'departments.id')->get();
        }

        $department = Department::find($department_id);



        return view("schedule_department.index")->with('schedule_group_employee',$schedule_group_employee )->with('all_group',$all_group )->with('department',$department )->with('year',$year )->with('month',$month );
});



Route::get('{any}', function() {
    return redirect('login');
})->where('any', '.*');
