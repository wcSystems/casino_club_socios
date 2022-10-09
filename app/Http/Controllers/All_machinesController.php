<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\All_machine;
use App\Models\Sede;
use App\Models\Brand_machine;
use App\Models\Model_machine;
use App\Models\Range_machine;
use App\Models\Associated_machine;
use App\Models\Value_machine;
use App\Models\Play_machine;
use Illuminate\Support\Facades\DB;

class All_machinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_machines = All_machine::all();
        $sedes = Sede::all();
        $brand_machines = Brand_machine::all();
        $model_machines = Model_machine::all();
        $range_machines = Range_machine::all();
        $associated_machines = Associated_machine::all();
        $value_machines = Value_machine::all();
        $play_machines = Play_machine::all();
        return view('all_machines.index')
                    ->with('sedes',$sedes)
                    ->with('all_machines',$all_machines)
                    ->with('brand_machines',$brand_machines)
                    ->with('model_machines',$model_machines)
                    ->with('range_machines',$range_machines)
                    ->with('associated_machines',$associated_machines)
                    ->with('value_machines',$value_machines)
                    ->with('play_machines',$play_machines);
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
        $current_item = All_machine::updateOrCreate($request["id"],$request["data"]);
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
        $current_item = All_machine::find($id);
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

        $search_sede_machines = $request->get('search_sede_machines');
        $search_brand_machines = $request->get('search_brand_machines');
        $search_model_machines = $request->get('search_model_machines');
        $search_range_machines = $request->get('search_range_machines');
        $search_associated_machines = $request->get('search_associated_machines');
        $search_value_machines = $request->get('search_value_machines');
        $search_play_machines = $request->get('search_play_machines');

        /* QUERY FILTER */
        $query = All_machine::select(DB::raw('all_machines.*, sedes.name AS group_name, brand_machines.name AS brand_name, model_machines.name AS model_name, range_machines.name AS range_name, associated_machines.name AS associated_name, value_machines.name AS value_name, play_machines.name AS play_name'))
                    ->orWhere(function($query) use ($search){
                        $query->orWhere('all_machines.name','LIKE','%'.$search.'%');
                    })
                    ->where(function($query) use ($search_sede_machines, $search_brand_machines, $search_model_machines, $search_range_machines, $search_associated_machines, $search_value_machines, $search_play_machines){
                        if(!empty($search_sede_machines)){
                            $query->where('all_machines.sede_id', '=', $search_sede_machines);
                        }else{};
                        if(!empty($search_brand_machines)){
                            $query->where('all_machines.brand_machine_id', '=', $search_brand_machines);
                        }else{};
                        if(!empty($search_model_machines)){
                            $query->where('all_machines.model_machine_id', '=', $search_model_machines);
                        }else{};
                        if(!empty($search_range_machines)){
                            $query->where('all_machines.range_machine_id', '=', $search_range_machines);
                        }else{};
                        if(!empty($search_associated_machines)){
                            $query->where('all_machines.associated_machine_id', '=', $search_associated_machines);
                        }else{};
                        if(!empty($search_value_machines)){
                            $query->where('all_machines.value_machine_id', '=', $search_value_machines);
                        }else{};
                        if(!empty($search_play_machines)){
                            $query->where('all_machines.play_machine_id', '=', $search_play_machines);
                        }else{};
                    })
                    ->join('sedes', 'all_machines.sede_id', '=', 'sedes.id')
                    ->join('brand_machines', 'all_machines.brand_machine_id', '=', 'brand_machines.id')
                    ->join('model_machines', 'all_machines.model_machine_id', '=', 'model_machines.id')
                    ->join('range_machines', 'all_machines.range_machine_id', '=', 'range_machines.id')
                    ->join('associated_machines', 'all_machines.associated_machine_id', '=', 'associated_machines.id')
                    ->join('value_machines', 'all_machines.value_machine_id', '=', 'value_machines.id')
                    ->join('play_machines', 'all_machines.play_machine_id', '=', 'play_machines.id')
                    ->orderBy('id', 'DESC')->get();
                    
        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(All_machine::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }

    public function listModel(Request $request)
    {   

        $id = $request->id;
        $current_item = Model_machine::where('brand_machine_id', '=', $id)->get();
        if($current_item){
            return response()->json([ 'type' => 'success','data' => $current_item ]);
        }else{
            return response()->json([ 'type' => 'error']);
        }
    }
}
