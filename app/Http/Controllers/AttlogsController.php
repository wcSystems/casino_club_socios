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
            ->selectRaw('
                attlogs.employeeNoString, 
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

                sedes.name AS group_name, 

                device_hikvision_facial_casinos.local AS device_local,
                device_hikvision_facial_casinos.public AS device_public,
                device_hikvision_facial_casinos.password AS device_password,

                STR_TO_DATE(attlogs.time, "%Y-%m-%D") AS date
            ')
            ->orWhere(function($query) use ($search){
                $query->orWhere('attlogs.employeeNoString','LIKE','%'.$search.'%');
                $query->orWhere('employees.name','LIKE','%'.$search.'%');
                $query->orWhere('attlogs.time','LIKE','%'.$search.'%');
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
            ->groupBy('employeeNoString','employees.name')
            ->whereBetween('attlogs.time', [$start, $end])
            ->join('employees', 'attlogs.employeeNoString', '=', 'employees.employeeNo')
            ->join('sedes', 'employees.sede_id', '=', 'sedes.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('sexs', 'employees.sex_id', '=', 'sexs.id')
            ->join('device_hikvision_facial_casinos', 'sedes.id', '=', 'device_hikvision_facial_casinos.sede_id')
            ->get();

            


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

    public function marcajesEmployee(Request $request){
      
        $query = DB::table('attlogs')
            ->selectRaw('
                attlogs.employeeNoString, 
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
                sedes.name AS group_name, 
                device_hikvision_facial_casinos.local AS device_local,
                device_hikvision_facial_casinos.public AS device_public,
                device_hikvision_facial_casinos.password AS device_password,
                STR_TO_DATE(attlogs.time, "%Y-%m-%D") AS date
            ')
            ->join('employees', 'attlogs.employeeNoString', '=', 'employees.employeeNo')
            ->join('sedes', 'employees.sede_id', '=', 'sedes.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('sexs', 'employees.sex_id', '=', 'sexs.id')
            ->join('device_hikvision_facial_casinos', 'sedes.id', '=', 'device_hikvision_facial_casinos.sede_id')   
            ->where('attlogs.employeeNoString','=',$request['employeeNoString'])     
            ->orderBy('attlogs.serialNo','desc')    
            ->get();

            if($query){
                return response()->json([ 'type' => 'success', 'query' => $query]);
            }else{
                return response()->json([ 'type' => 'error']);
            }
    }

}
