<?php

namespace App\Http\Controllers;
use App\Models\Global_warehouse;
use App\Models\History_machine;
use App\Models\Room;
use App\Models\Associated_machine;
use App\Models\Brand_machine;
use App\Models\Model_machine;
use App\Models\Img_global_warehouse;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Global_warehousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $global_warehouses = Global_warehouse::with("history")->with("imgs")->get();
        $rooms = Room::all();
        $brand_machines = Brand_machine::all();
        $model_machines = Model_machine::all();
        $associated_machines = Associated_machine::all();
        return view('global_warehouses.index')
            ->with('global_warehouses',$global_warehouses)
            ->with('associated_machines',$associated_machines)
            ->with('brand_machines',$brand_machines)
            ->with('model_machines',$model_machines)
            ->with('rooms',$rooms);
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
        $current_db = Global_warehouse::where("id","=",$request["id"])->first();
        if( $current_db ){
            if( $request["serial"] != $current_db->serial  ){
                History_machine::Create([
                    'name' => "SERIAL CAMBIADO: ".$current_db->serial. " -> ".$request["serial"],
                    'global_warehouse_id' => $current_db->id
                ]);
            }
        }
        $current_data = array(
            "serial" => $request["serial"],
            "associated_machine_id" => $request["associated_machine_id"],
            "brand_machine_id" => $request["brand_machine_id"],
            "model_machine_id" => $request["model_machine_id"],
            "condicion" => $request["condicion"],
            "room_id" => $request["room_id"],
        );
        $current_item = Global_warehouse::updateOrCreate([ 'id' => $request["id"] ],$current_data);
        if( !$current_db ){
            History_machine::Create([
                'name' => "A LA FECHA, SE INGRESA MAQUINA AL SISTEMA",
                'global_warehouse_id' => $current_item->id
            ]);
        }

        if( $request["new_novedad"] ){
            History_machine::Create([
                'name' => $request["new_novedad"],
                'global_warehouse_id' => $current_item->id
            ]);
        }
        
        if($current_item){
            if($request->file('images')){
                foreach ($request->file('images') as $value) {
                    $file= $value;
                    $filename= $file->getClientOriginalName();
                    $file-> move(public_path('public/warehouses/'.$current_item->id), $filename);
                    Img_global_warehouse::create(array('name'  => $filename,'global_warehouse_id' => $current_item->id));
                }
            }
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

        if( History_machine::where('global_warehouse_id','=',$id)->get() ){
            $history_global_warehouses = History_machine::where('global_warehouse_id','=',$id)->get();
            $history_global_warehouses->each(function($itemHistory, $key) {
                $itemHistory->delete();
            });
        }

        if( Img_global_warehouse::where('global_warehouse_id','=',$id)->get() ){
            $img_global_warehouses = Img_global_warehouse::where('global_warehouse_id','=',$id)->get();
            $img_global_warehouses->each(function($itemImg, $key) {
                $itemImg->delete();
            });
        }

        if (\File::exists('public/warehouses/'.$id)) \File::deleteDirectory('public/warehouses/'.$id);
    
        $current_item = Global_warehouse::find($id);
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
        $search_rooms = $request->get('search_rooms');
        $search_type_group_associated = $request->get('search_type_group_associated');
        $search_type_group_room = $request->get('search_type_group_room');
        $search_associated_select = $request->get('search_associated_select');
        $search_room_select = $request->get('search_room_select');
        $search_brand_machines_select = $request->get('search_brand_machines_select');
        $search_model_machines_select = $request->get('search_model_machines_select');
        $search_condicion_select = $request->get('search_condicion_select');

        /* QUERY FILTER */
        $query = DB::table('global_warehouses')
            ->selectRaw('
                global_warehouses.*, 
                rooms.name AS room_name,
                rooms.group AS room_group,
                associated_machines.name AS associated_name,
                associated_machines.group AS associated_group,
                global_warehouses.condicion AS condicion_group
            ')
            ->orWhere(function($query) use ($search){
                $query->orWhere('global_warehouses.serial','LIKE','%'.$search.'%');
            })
            ->where(function($query) use ($search_type_group_associated,$search_associated_select,$search_brand_machines_select,$search_model_machines_select,$search_type_group_room,$search_room_select,$search_condicion_select){
                

                if(!empty($search_type_group_associated)){
                    $query->where('associated_machines.group', '=', $search_type_group_associated);
                }else{};
                if(!empty($search_type_group_room)){
                    $query->where('rooms.group', '=', $search_type_group_room);
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
                    $query->where('global_warehouses.condicion', '=', $search_condicion_select);
                }else{};
                
            })
            ->join('rooms', 'global_warehouses.room_id', '=', 'rooms.id')
            ->join('associated_machines', 'global_warehouses.associated_machine_id', '=', 'associated_machines.id')
            ->join('brand_machines', 'global_warehouses.brand_machine_id', '=', 'brand_machines.id')
            ->get();

            $query->each(function ($item) {

                if($item->condicion_group == 1){
                    $item->condicion_group = "Buen estado";
                }
                if($item->condicion_group == 2){
                    $item->condicion_group = "Defectuosa";
                }
                if($item->condicion_group == 3){
                    $item->condicion_group = "Solo Carcasa";
                }
                if($item->condicion_group == 4){
                    $item->condicion_group = "Dañada ( Repuesto )";
                }

                if($item->room_group == 2){
                    $item->room_group = "Galpon";
                }
                if($item->room_group == 1){
                    $item->room_group = "Sala";
                }

                if($item->associated_group == 2){
                    $item->associated_group = "Invitado";
                }
                if($item->associated_group == 1){
                    $item->associated_group = "Asociado";
                }

            });



        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Global_warehouse::all());
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
