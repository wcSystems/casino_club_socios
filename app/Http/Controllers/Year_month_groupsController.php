<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year_month_group;
use App\Models\Department;
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
        $year_month_groups = Year_month_group::all();
        $horarios = Horario::all();
        $levels = Level::all();
        $schedule_templates = Schedule_template::all();
        $departments = Department::with("employees")->get();
        return view('year_month_groups.index')
                    ->with('levels',$levels)
                    ->with('year_month_groups',$year_month_groups)
                    ->with('horarios',$horarios)
                    ->with('departments',$departments)
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
        $current_item = Year_month_group::updateOrCreate($request["id"],$request["data"]);
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
        /* QUERY FILTER */

        $query = array();

        

        $dataUser = DB::table('users')
                    ->selectRaw('levels.name AS level_name')
                    ->where("users.id","=",  $user_data["id"] )
                    ->join('levels', 'users.level_id', '=', 'levels.id')->first();

        foreach (Year_month_group::all() as $key => $value) {
            if(  strncasecmp($dataUser->level_name, "horario", 7) === 0   ){
                
                
                $department = Department::where('name','LIKE','%'.substr($dataUser->level_name,7).'%')->get();
              
                foreach ( $department as $key => $valueDepartment) {
                    array_push($query, [ 'id' => $value->id, 'year' => $value->year, 'month' => $value->month, 'department_id' => $valueDepartment->id, 'department_name' => $valueDepartment->name, 'group_name' => $valueDepartment->name ]);
                }

            }else{
                foreach (Department::all() as $key => $valueDepartment) {
                    array_push($query, [ 'id' => $value->id, 'year' => $value->year, 'month' => $value->month, 'department_id' => $valueDepartment->id, 'department_name' => $valueDepartment->name, 'group_name' => $valueDepartment->name ]);
                }
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
