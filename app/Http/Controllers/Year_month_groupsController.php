<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year_month_group;
use App\Models\Sex;
use App\Models\Department;
use App\Models\Position;
use App\Models\Sede;
use App\Models\Horario;
use App\Models\Schedule_template;
use App\Models\Level;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Year_month_groupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = Auth::user();
        $year_month_groups = Year_month_group::all();
        $horarios = Horario::all();
        $levels = Level::all();
        $schedule_templates = Schedule_template::all();
        $departments = Department::with("employees")->get();
        $sexs = Sex::all();
        $positions = Position::all();
        $sedes = Sede::all();
        return view('year_month_groups.index')
                    ->with('levels',$levels)
                    ->with('year_month_groups',$year_month_groups)
                    ->with('horarios',$horarios)
                    ->with('departments',$departments)

                    ->with('sexs',$sexs)
                    ->with('positions',$positions)
                    ->with('sedes',$sedes)
                    ->with('dataUser',$dataUser)

                    ->with('schedule_templates',$schedule_templates);
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
        $id = $request["id"];
        $data = $request["data"];

        $current_item = Year_month_group::where([
            ['year', '=', $data['year']],
            ['month', '=', $data['month']]
        ])->first();

        if($current_item){
            $id = [ "id" => $current_item->id ];
        }

        $current_item = Year_month_group::updateOrCreate($id,$data);
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
        Schedule_template::where("year_month_group_id","=",$id)->delete();
        $current_item = Year_month_group::find($id);
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
        $user_data = $request->get('user_data');

        $search_sede_employees = $request->get('search_sede_employees');
        $search_department_employees = $request->get('search_department_employees');
        $search_position_employees = $request->get('search_position_employees');
        $search_sex_employees = $request->get('search_sex_employees');


        /* QUERY FILTER */

        $query = array();

        

        $dataUser = DB::table('users')->selectRaw('*')->where("users.id","=",  $user_data["id"] )->first();

            if(  $dataUser->level_id > 2   ){
                
                
                $department = Department::where('id','=',$dataUser->department_id)->get();
              
                foreach ( $department as $key => $valueDepartment) {
                    array_push($query,  $valueDepartment);
                }

            }else{
                foreach (Department::all() as $key => $valueDepartment) {
                    array_push($query,  $valueDepartment);
                
                }
            }
        
        
        
        




        /* FIELDS DEFAULTS DATATABLES */
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
