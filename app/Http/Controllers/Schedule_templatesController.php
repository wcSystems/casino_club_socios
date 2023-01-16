<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule_template;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Department;
use Carbon\Carbon;

class Schedule_templatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $current_item = Schedule_template::updateOrCreate($request["id"],$request["data"]);
        return response()->json([ 'type' => 'success','item' => $current_item]);
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
        //
    }

    public function viewSchedule(Request $request)
    {
        $all_data = Schedule_template::all();

        $query = DB::table('attlogs')
        ->selectRaw('
            attlogs.employeeNoString, 
            employees.id AS employee_id, 
            employees.name, 
            employees.sede_id, 
            sedes.name AS sedes_name, 
            employees.department_id, 
            departments.name AS departments_name ,  
            employees.position_id, 
            positions.name AS positions_name, 
            employees.sex_id, 
            sexs.name AS sexs_name, 
            attlogs.serialNo, 
            attlogs.pictureURL, 
            attlogs.time, 
            MIN(attlogs.time) AS first, 
            MAX(attlogs.time) AS last, 
            MIN(attlogs.pictureURL) AS first_pictureURL, 
            MAX(attlogs.pictureURL) AS last_pictureURL, 
            STR_TO_DATE(attlogs.time, "%Y-%m-%D") AS date
        ')
        
        ->groupBy('date','employeeNoString','employees.name')
        ->join('employees', 'attlogs.employeeNoString', '=', 'employees.employeeNo')
        ->join('sedes', 'employees.sede_id', '=', 'sedes.id')
        ->join('departments', 'employees.department_id', '=', 'departments.id')
        ->join('positions', 'employees.position_id', '=', 'positions.id')
        ->join('sexs', 'employees.sex_id', '=', 'sexs.id')
        ->get();





        $current = DB::table('schedule_templates')->selectRaw('year, month, employee_id')->where('employee_id','=',$request["employee_id"])
                        ->groupBy('year','month','employee_id')
                        ->orderBy('year','desc')
                        ->orderBy('month','desc')
                        ->get();





            /* $employees = Employee::All();
            foreach ($employees as $key => $valueEmployee) {
    
                $employee_schedule_template = DB::table('schedule_templates')->selectRaw('year, month, employee_id')->where('employee_id','=',$value["valueEmployee"])
                                                ->groupBy('year','month','employee_id')
                                                ->orderBy('year','desc')
                                                ->orderBy('month','desc')
                                                ->get();
    

                foreach ($employee_schedule_template as $key => $valueGroupSchedule) {
                    echo $valueGroupSchedule;
                }
                                             
                $employee_attlog = DB::table('attlogs')->selectRaw('attlogs.employeeNoString, employees.id AS employee_id, employees.name, employees.sede_id, sedes.name AS sedes_name, employees.department_id, departments.name AS departments_name ,  
                            employees.position_id, positions.name AS positions_name, employees.sex_id, sexs.name AS sexs_name, attlogs.serialNo, attlogs.pictureURL, attlogs.time, MIN(attlogs.time) AS first, MAX(attlogs.time) AS last, 
                            MIN(attlogs.pictureURL) AS first_pictureURL, MAX(attlogs.pictureURL) AS last_pictureURL, STR_TO_DATE(attlogs.time, "%Y-%m-%D") AS date')->groupBy('date','employeeNoString','employees.name')
                        ->join('employees', 'attlogs.employeeNoString', '=', 'employees.employeeNo')->join('sedes', 'employees.sede_id', '=', 'sedes.id')
                        ->join('departments', 'employees.department_id', '=', 'departments.id')->join('positions', 'employees.position_id', '=', 'positions.id')
                        ->join('sexs', 'employees.sex_id', '=', 'sexs.id')->get();
            } */






            $new_data = Employee::with("group_schedule")->with("schedule_templates")->get();


                        
        return response()->json([ 'type' => 'success','data' => $current,'all_data' => $all_data,'query' => $query, 'new_data' => $new_data]);
    }

    public function viewScheduleAll(Request $request)
    {
        $employees = Department::where('id','=',$request["department_id"])->with("employees")->first();
        

        $schedules = DB::table('schedule_templates')->selectRaw('schedule_templates.*, employees.name AS employee_name, departments.id AS department_id, departments.name AS department_name, employees.employeeNo AS employeeNo, year_month_groups.year AS year, year_month_groups.month AS month')
            ->where('departments.id','=',$request["department_id"])
            ->where('year_month_group_id','=',$request["year_month_group_id"])
            ->join('year_month_groups', 'schedule_templates.year_month_group_id', '=', 'year_month_groups.id')
            ->join('employees', 'schedule_templates.employee_id', '=', 'employees.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->get();



        return response()->json([ 'type' => 'success','employees' => $employees, 'schedules' => $schedules]);
    }
}
