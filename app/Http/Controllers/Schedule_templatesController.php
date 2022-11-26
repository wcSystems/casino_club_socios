<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule_template;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Employee;

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
        $valid = false;
        if( $request["type"] == "employee" ){
            foreach ($request["data"] as $key => $value) {
                $valid = false;
                Schedule_template::updateOrCreate($value["id"],$value["schedule"]);
                $valid = true;
            }
        }

        if( $request["type"] == "department" ){
            $employee_department= Department::with("employees")->where("id","=",$request["department"])->first();
            foreach ($employee_department["employees"] as $key => $valueEmployees) {

                foreach ($request["data"] as $key => $value) {
                    $valid = false;
                    $curent_delete = Schedule_template::where("year","=",$request["year"])->where("month","=",$request["month"])->where("employee_id","=",$valueEmployees["id"])->first();
                    
                    if( $curent_delete ){
                        $valid = true;
                    }
                    
                }

                foreach ($request["data"] as $key => $value) {
                    $valid = false;
                    Schedule_template::Create([
                        "employee_id" => $valueEmployees["id"],
                        "hora_entrada" => $value["schedule"]["hora_entrada"],
                        "horas_trabajo" => $value["schedule"]["horas_trabajo"],
                        "turno" => $value["schedule"]["turno"],
                        "year" => $value["schedule"]["year"],
                        "month" => $value["schedule"]["month"],
                        "day" => $value["schedule"]["day"],
                        "date" => $value["schedule"]["date"],
                    ]);
                    $valid = true;
                }

            }
        }
        if( $valid == true ){
            return response()->json([ 'type' => 'success']);
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
        //
    }

    public function viewSchedule(Request $request)
    {
        $all_data = Schedule_template::all();

        //Historico Global de marcaje
        





        


        $employees = Employee::All();
        foreach ($employees as $key => $value) {

            $employee_schedule_template = DB::table('schedule_templates')->selectRaw('year, month, employee_id')->where('employee_id','=',$value["id"])
                                            ->groupBy('year','month','employee_id')
                                            ->orderBy('year','desc')
                                            ->orderBy('month','desc')
                                            ->get();

            $employee_attlog = DB::table('attlogs')->selectRaw('attlogs.employeeNoString, employees.id AS employee_id, employees.name, employees.sede_id, sedes.name AS sedes_name, employees.department_id, departments.name AS departments_name ,  
                        employees.position_id, positions.name AS positions_name, employees.sex_id, sexs.name AS sexs_name, attlogs.serialNo, attlogs.pictureURL, attlogs.time, MIN(attlogs.time) AS first, MAX(attlogs.time) AS last, 
                        MIN(attlogs.pictureURL) AS first_pictureURL, MAX(attlogs.pictureURL) AS last_pictureURL, STR_TO_DATE(attlogs.time, "%Y-%m-%D") AS date')->groupBy('date','employeeNoString','employees.name')
                    ->join('employees', 'attlogs.employeeNoString', '=', 'employees.employeeNo')->join('sedes', 'employees.sede_id', '=', 'sedes.id')
                    ->join('departments', 'employees.department_id', '=', 'departments.id')->join('positions', 'employees.position_id', '=', 'positions.id')
                    ->join('sexs', 'employees.sex_id', '=', 'sexs.id')->get();
        }

        


        return response()->json([ 'type' => 'success','data' => $current,'all_data' => $all_data,'query' => $query]);
    }
}
