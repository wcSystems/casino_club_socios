<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History_machine;
use App\Models\All_machine;
use App\Models\Sede;
use App\Models\Brand_machine;
use App\Models\Model_machine;
use App\Models\Range_machine;
use App\Models\Associated_machine;
use App\Models\Value_machine;
use App\Models\Play_machine;
use App\Models\Room_group;
use App\Models\Room;
use App\Models\Condicion_group;
use App\Models\Associated_group;
use App\Models\Novedades_type;
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

        $rooms = Room::all();
        $room_groups = Room_group::all();
        $associated_groups = Associated_group::all();
        $condicion_groups = Condicion_group::all();
        $novedades_types = Novedades_type::all();


        return view('all_machines.index')
                    ->with('sedes',$sedes)
                    ->with('all_machines',$all_machines)
                    ->with('brand_machines',$brand_machines)
                    ->with('model_machines',$model_machines)
                    ->with('range_machines',$range_machines)
                    ->with('associated_machines',$associated_machines)
                    ->with('value_machines',$value_machines)

                    ->with('rooms',$rooms)
                    ->with('room_groups',$room_groups)
                    ->with('associated_groups',$associated_groups)
                    ->with('condicion_groups',$condicion_groups)

                    ->with('novedades_types',$novedades_types)

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
        $search_type_group_associated = $request->get('search_type_group_associated');
        $search_type_group_room = $request->get('search_type_group_room');
        $search_associated_select = $request->get('search_associated_select');
        $search_room_select = $request->get('search_room_select');
        $search_brand_machines_select = $request->get('search_brand_machines_select');
        $search_model_machines_select = $request->get('search_model_machines_select');
        $search_condicion_select = $request->get('search_condicion_select');
        $search_novedad_select = $request->get('search_novedad_select');

        /* QUERY FILTER */
       

                    $query = DB::table('history_machines')
            ->selectRaw('
                history_machines.*, 
                rooms.name AS room_name,
                room_groups.name AS room_group,
                room_groups.id AS room_group_id,

                associated_machines.name AS associated_name,
                associated_groups.name AS associated_group,
                condicion_groups.name AS condicion_group,

                range_machines.name AS range_group,
                play_machines.name AS play_group,
                value_machines.name AS value_group,

                brand_machines.name AS brand_name,
                model_machines.name AS model_name,

                novedades_types.name AS novedad_name
            ')
            ->orWhere(function($query) use ($search){
                $query->orWhere('history_machines.name','LIKE','%'.$search.'%');
            })
            ->where(function($query) use ($search_novedad_select,$search_type_group_associated,$search_associated_select,$search_brand_machines_select,$search_model_machines_select,$search_type_group_room,$search_room_select,$search_condicion_select){
                

                if(!empty($search_novedad_select)){
                    $query->where('history_machines.novedades_type_id', '=', $search_novedad_select);
                }else{};

                if(!empty($search_type_group_associated)){
                    $query->where('associated_machines.associated_group_id', '=', $search_type_group_associated);
                }else{};

                if(!empty($search_type_group_room)){
                    $query->where('rooms.room_group_id', '=', $search_type_group_room);
                }else{};


                if(!empty($search_associated_select)){
                    $query->where('global_warehouses.associated_machine_id', '=', $search_associated_select);
                }else{};
                if(!empty($search_room_select)){
                    $query->where('global_warehouses.room_id', '=', $search_room_select);
                }else{};
                
                if(!empty($search_brand_machines_select)){
                    $query->where('global_warehouses.brand_machine_id', '=', $search_brand_machines_select);
                }else{};
                if(!empty($search_model_machines_select)){
                    $query->where('global_warehouses.model_machine_id', '=', $search_model_machines_select);
                }else{};

                if(!empty($search_condicion_select)){
                    $query->where('global_warehouses.condicion_group_id', '=', $search_condicion_select);
                }else{};
                
            })
            ->join('global_warehouses', 'history_machines.global_warehouse_id', '=', 'global_warehouses.id')
            ->join('rooms', 'global_warehouses.room_id', '=', 'rooms.id')
            ->join('associated_machines', 'global_warehouses.associated_machine_id', '=', 'associated_machines.id')
            ->join('brand_machines', 'global_warehouses.brand_machine_id', '=', 'brand_machines.id')
            ->join('model_machines', 'global_warehouses.model_machine_id', '=', 'model_machines.id')

            ->join('room_groups', 'rooms.room_group_id', '=', 'room_groups.id')
            ->join('associated_groups', 'associated_machines.associated_group_id', '=', 'associated_groups.id')
            ->join('condicion_groups', 'global_warehouses.condicion_group_id', '=', 'condicion_groups.id')

            ->leftjoin('range_machines', 'global_warehouses.range_machine_id', '=', 'range_machines.id')
            ->leftjoin('play_machines', 'global_warehouses.play_machine_id', '=', 'play_machines.id')
            ->leftjoin('value_machines', 'global_warehouses.value_machine_id', '=', 'value_machines.id')
            ->join('novedades_types', 'history_machines.novedades_type_id', '=', 'novedades_types.id')
            ->get();

            $query->each(function ($item) {
                $item->group_name = "<span class='font-weight-bold'>". $item->room_group . ":&nbsp;</span>" . $item->room_name . "<br>";
            });




























                    
        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(History_machine::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }

}
