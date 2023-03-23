<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayb_command;
use App\Models\Ayb_item;
use App\Models\Ayb_item_command;
use App\Models\Table;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Group_menu;
use App\Models\Type_command;
use Illuminate\Support\Facades\DB;
use App\Models\Sede;
use App\User;

class Ayb_commandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayb_commands = Ayb_command::all();
        $ayb_item_commands = Ayb_item_command::all();
        $tables = Table::all();

        $ayb_items = Ayb_item::all();
        $users = User::all();
        $sedes = Sede::all();
        
        $group_menus = Group_menu::all();
        $type_commands = Type_command::all();
        $departments = Department::whereIn('id', [16])->get();
        $employees = Employee::whereIn('department_id', [16])->get();
        
        return view('ayb_commands.index')
                    ->with('ayb_commands',$ayb_commands)
                    ->with('ayb_items',$ayb_items)
                    ->with('ayb_item_commands',$ayb_item_commands)
                    ->with('sedes',$sedes)
                    ->with('tables',$tables)
                    ->with('employees',$employees)
                    ->with('group_menus',$group_menus)
                    ->with('type_commands',$type_commands)
                    ->with('departments',$departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_data_command = array(
            "type_command_id" => $request->type_command_id,
            "employee_id" => $request->employee_id,
        );
        $current_item_command = Ayb_command::create($current_data_command);

        $obj = $request->items;
        foreach ($obj as $value) {
            $current_item = Ayb_item_command::create([ 'ayb_command_id' => $current_item_command->id, 'ayb_item_id' => $value["ayb_item_id"],  'total' => $value["total"], 'table_id' => $value["table_id"] ]);
        }

        if($current_item_command){
            return response()->json([ 'type' => 'success']);
        }else{
            return response()->json([ 'type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Ayb_commands = Ayb_item_command::where('ayb_command_id','=',$id);

        $Ayb_commands->each(function($item, $key) {
            $item->delete();
        });



        $current_item = Ayb_command::find($id);
        if($current_item){
            $current_item->delete();
            return response()->json([ 'type' => 'success']);
        }else{
            return response()->json([ 'type' => 'error']);
        }
    }

    public function service(Request $request)
    {
        /* FIELDS TO FILTER */
        $search = $request->get('search');

        $query = Ayb_command::select(DB::raw('ayb_commands.*, ayb_commands.created_at AS group_name, employees.name AS employee_name,  type_commands.name AS type_command_name '))
                    ->orWhere('ayb_commands.created_at','LIKE','%'.$search.'%')
                    ->join('employees', 'ayb_commands.employee_id', '=', 'employees.id')
                    ->join('type_commands', 'ayb_commands.type_command_id', '=', 'type_commands.id')
                    ->get();

        $query->each(function ($item) {
            $item->group_name = DATE_FORMAT($item->created_at, "Y-m-d");
            if($item->tipo == "1"){ $item->tipo = "Venta"; }
            if($item->tipo == "2"){ $item->tipo = "Cortesia"; }
        });




        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Ayb_item_command::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
    
    public function pjoin(Request $request)
    {
      
        $id = $request["id"];

        $list = Ayb_item_command::select(DB::raw('ayb_item_commands.*, ayb_items.name AS item_name, ayb_items.price AS price, tables.name AS table_name'))
                    ->where('ayb_item_commands.ayb_command_id','=',$id)

                    ->join('ayb_commands', 'ayb_item_commands.ayb_command_id', '=', 'ayb_commands.id')
                    ->join('ayb_items', 'ayb_item_commands.ayb_item_id', '=', 'ayb_items.id')
                    ->join('tables', 'ayb_item_commands.table_id', '=', 'tables.id')
                    ->get();

        $command = Ayb_command::select(DB::raw('ayb_commands.*, employees.name AS employee_name, type_commands.name AS type_command_name'))
                        ->where('ayb_commands.id','=',$id)
                        ->join('employees', 'ayb_commands.employee_id', '=', 'employees.id')
                        ->join('type_commands', 'ayb_commands.type_command_id', '=', 'type_commands.id')
                        ->first();
                      

        echo json_encode(array(
            "productos" => $list,
            "command" => $command,
        ));
    }


}
