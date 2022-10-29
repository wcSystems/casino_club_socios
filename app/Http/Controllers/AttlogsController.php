<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attlog;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

use App\Models\Sex;
use App\Models\Department;
use App\Models\Position;
use App\Models\Sede;


class AttlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function index()
    {
        $sexs = Sex::all();
        $departments = Department::all();
        $positions = Position::all();
        $sedes = Sede::all();
        return view('attlogs.index')
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
        //
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

    public function service(Request $request)
    {
        /* FIELDS TO FILTER */
        $search = $request->get('search');
        $start = $request->get('start');
        $end = $request->get('end');
        $search_sede_attlogs = $request->get('search_sede_attlogs');
        $search_department_attlogs = $request->get('search_department_attlogs');
        $search_position_attlogs = $request->get('search_position_attlogs');
        $search_sex_attlogs = $request->get('search_sex_attlogs');

        /* QUERY FILTER */
        $query = DB::table('attlogs')
            ->selectRaw('employeeNoString, employees.name, employees.sede_id, sedes.name AS sedes_name, employees.department_id, departments.name AS departments_name ,  employees.position_id, positions.name AS positions_name, employees.sex_id, sexs.name AS sexs_name, serialNo, pictureURL, time, MIN(time) AS first, MAX(time) AS last, MIN(pictureURL) AS first_pictureURL, MAX(pictureURL) AS last_pictureURL, STR_TO_DATE(time, "%Y-%m-%D") AS date')
            ->orWhere(function($query) use ($search){
                $query->orWhere('employeeNoString','LIKE','%'.$search.'%');
                $query->orWhere('employees.name','LIKE','%'.$search.'%');
                $query->orWhere('time','LIKE','%'.$search.'%');
            })
            ->where(function($query) use ($search_sede_attlogs, $search_department_attlogs, $search_position_attlogs, $search_sex_attlogs){
                if(!empty($search_sede_attlogs)){
                    $query->where('employees.sede_id', '=', $search_sede_attlogs);
                }else{};
                if(!empty($search_department_attlogs)){
                    $query->where('employees.department_id', '=', $search_department_attlogs);
                }else{};
                if(!empty($search_position_attlogs)){
                    $query->where('employees.position_id', '=', $search_position_attlogs);
                }else{};
                if(!empty($search_sex_attlogs)){
                    $query->where('employees.sex_id', '=', $search_sex_attlogs);
                }else{};
            })
            ->groupBy('date','employeeNoString','employees.name')
            ->whereBetween('time', [$start, $end])
            ->join('employees', 'attlogs.employeeNoString', '=', 'employees.employeeNo')
            ->join('sedes', 'employees.sede_id', '=', 'sedes.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('sexs', 'employees.sex_id', '=', 'sexs.id')
            ->get();



        /* $query = Employee::select(DB::raw('employees.*, sedes.name AS sedes_name, departments.name AS departments_name, positions.name AS positions_name, sexs.name AS sexs_name'))
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
                    ->orderBy('id', 'ASC')->get(); */







        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count($query);
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }

}
