<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule_template;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Horario;
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

        try {

            // EMPLOYEE
            $employee_schedule = DB::table('attlogs')
            ->selectRaw('
                attlogs.employeeNoString, 
                employees.name, 
                sedes.name AS sedes_name, 
                departments.name AS departments_name ,  
                positions.name AS positions_name, 
                sexs.name AS sexs_name, 
                schedule_templates.horario AS horario,
                year_month_groups.year AS year,
                year_month_groups.month AS month
            ')
            ->where('employees.employeeNo','=',$request->employeeNo)
            ->where('schedule_templates.id','=',$request->schedule_template_id)
            ->where('attlogs.time','LIKE','%'.$request->year_month.'%')
            ->join('employees', 'attlogs.employeeNoString', '=', 'employees.employeeNo')
            ->join('sedes', 'employees.sede_id', '=', 'sedes.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('sexs', 'employees.sex_id', '=', 'sexs.id')
            ->join('schedule_templates', 'employees.id', '=', 'schedule_templates.employee_id')
            ->join('year_month_groups', 'schedule_templates.year_month_group_id', '=', 'year_month_groups.id')
            ->first();

            //MARCAJES
            $marcajes = DB::table('attlogs')
            ->selectRaw('
                MIN(attlogs.time) AS first, 
                MAX(attlogs.time) AS last, 
                STR_TO_DATE(attlogs.time, "%Y-%m-%D") AS date
            ')
            ->where('employees.employeeNo','=',$request->employeeNo)
            ->where('schedule_templates.id','=',$request->schedule_template_id)
            ->where('attlogs.time','LIKE','%'.$request->year_month.'%')
            ->groupBy('date','employeeNoString','employees.name')
            ->orderBy('date')
            ->join('employees', 'attlogs.employeeNoString', '=', 'employees.employeeNo')
            ->join('sedes', 'employees.sede_id', '=', 'sedes.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('sexs', 'employees.sex_id', '=', 'sexs.id')
            ->join('schedule_templates', 'employees.id', '=', 'schedule_templates.employee_id')
            ->join('year_month_groups', 'schedule_templates.year_month_group_id', '=', 'year_month_groups.id')
            ->get();

            //TEMPLATE SCHEDULE
            $new_arr = [];
            $horario_arr = explode (",", $employee_schedule->horario); 
            foreach ($horario_arr as $key_horario_arr => $value_horario_arr) {
                $key_horario_arr_cero = ( ($key_horario_arr+1) <= 9 ) ? "0".($key_horario_arr+1) : "".($key_horario_arr+1);
                $horarioSchedule = Horario::where("id","=",$value_horario_arr)->first();
                array_push($new_arr, [
                    "dia" => $key_horario_arr_cero,
                    "turno" => $horarioSchedule->name,
                    "hora_entrada" => $horarioSchedule->hora_entrada,
                    "hora_trabajo" => $horarioSchedule->hora_trabajo,
                    "leyenda" => $horarioSchedule->leyenda,
                    "date" => $employee_schedule->year."-".$employee_schedule->month."-".($key_horario_arr_cero),
                    "status" => "NO MARCO",
                    "first" => "00:00:00",
                    "last" => "00:00:00"
                ]);
            }

            

            // MARCO
            foreach ($marcajes as $key_marcajes => $value_marcajes) {
                foreach ($new_arr as $key_new_arr => $value_new_arr) {
                    if( $value_new_arr['date'] == $value_marcajes->date ){
                        $new_arr[$key_new_arr]['status'] = "MARCO";
                        $new_arr[$key_new_arr]['first'] = $value_marcajes->first;
                        $new_arr[$key_new_arr]['last'] = $value_marcajes->last;
                    }  
                }
            }

            $employee_schedule->marcajes = $new_arr;
            return response()->json([ 'type' => 'success','employee_schedule' => $employee_schedule, "marcajes" => $marcajes  ]);

        } catch (\Exception $e) {
            return response()->json([ 'type' => 'error','message' => $e->getMessage() ]);
        }
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

    public function ViewYearMonthGroup(Request $request)
    {
        $schedules = DB::table('schedule_templates')->selectRaw('schedule_templates.id, year_month_groups.year AS year, year_month_groups.month AS month')
        ->where('employee_id','=',$request["employee_id"])
        ->join('year_month_groups', 'schedule_templates.year_month_group_id', '=', 'year_month_groups.id')
        ->get();
        return response()->json([ 'type' => 'success', 'schedules' => $schedules]);
    }

}
