<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Sex;
use App\Models\Department;
use App\Models\Position;
use App\Models\Sede;
use App\Models\Attlog;
use App\Models\Schedule_template;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $sexs = Sex::all();
        $departments = Department::all();
        $positions = Position::all();
        $sedes = Sede::all();
        $schedule_templates = Schedule_template::all();
        return view('employees.index')
            ->with('employees',$employees)
            ->with('schedule_templates',$schedule_templates)
            ->with('sexs',$sexs)
            ->with('departments',$departments)
            ->with('positions',$positions)
            ->with('sedes',$sedes);
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
        $current_item = Employee::updateOrCreate($request["id"],$request["data"]);
        if($current_item){
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
        Schedule_template::where('employee_id', $id)->delete();
        $current_item = Employee::find($id);
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
        $search_sede_employees = $request->get('search_sede_employees');
        $search_department_employees = $request->get('search_department_employees');
        $search_position_employees = $request->get('search_position_employees');
        $search_sex_employees = $request->get('search_sex_employees');

        /* QUERY FILTER */
        $query = Employee::where('name','LIKE','%'.$search.'%')->get();


        /* QUERY FILTER */
        $query = Employee::select(DB::raw('employees.*, sedes.name AS sedes_name, departments.name AS departments_name, positions.name AS positions_name, sexs.name AS sexs_name'))
                    ->orWhere(function($query) use ($search){
                        $query->orWhere('employees.name','LIKE','%'.$search.'%');
                    })
                    ->where(function($query) use ($search_sede_employees, $search_department_employees, $search_position_employees, $search_sex_employees){
                        if(!empty($search_sede_employees)){
                            $query->where('employees.sede_id', '=', $search_sede_employees);
                        }else{};
                        if(!empty($search_department_employees)){
                            $query->where('employees.department_id', '=', $search_department_employees);
                        }else{};
                        if(!empty($search_position_employees)){
                            $query->where('employees.position_id', '=', $search_position_employees);
                        }else{};
                        if(!empty($search_sex_employees)){
                            $query->where('employees.sex_id', '=', $search_sex_employees);
                        }else{};
                    })
                    ->join('sedes', 'employees.sede_id', '=', 'sedes.id')
                    ->join('departments', 'employees.department_id', '=', 'departments.id')
                    ->join('positions', 'employees.position_id', '=', 'positions.id')
                    ->join('sexs', 'employees.sex_id', '=', 'sexs.id')
                    ->orderBy('id', 'ASC')->get();



        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Employee::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }


    public function history(Request $request)
    {
        $id = $request["id"];
        $current_item = Employee::find($id);
        $search = $current_item->employeeNo;

        $query = DB::table('attlogs')
        ->orWhere(function($query) use ($search){
            $query->orWhere('employeeNoString','LIKE','%'.$search.'%');
        })
        ->select('*')
        ->selectRaw('
            STR_TO_DATE(time, "%Y-%m-%D") AS date
        ')
        ->get();


        return $query;



     
    }

}
