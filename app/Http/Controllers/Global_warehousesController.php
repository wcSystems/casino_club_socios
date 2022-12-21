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

            // SERIAL CAMBIADO
            if( $request["serial"] != $current_db->serial  ){
                History_machine::Create([
                    'name' => "SERIAL CAMBIADO | ".$current_db->serial. " -> ".$request["serial"],
                    'global_warehouse_id' => $current_db->id
                ]);
            }
        
            // SOCIEDAD CAMBIADA
            if( $request["associated_machine_id"] != $current_db->associated_machine_id  ){
                History_machine::Create([
                    'name' => "SOCIEDAD CAMBIADA / INVITADO CAMBIADO | ".Associated_machine::find($current_db->associated_machine_id)->name. " -> ".Associated_machine::find($request["associated_machine_id"])->name,
                    'global_warehouse_id' => $current_db->id
                ]);
            }

            // MARCA CAMBIADA
            if( $request["brand_machine_id"] != $current_db->brand_machine_id || $request["model_machine_id"] != $current_db->model_machine_id ){
                History_machine::Create([
                    'name' => "MARCA CAMBIADA / MODELO CAMBIADO | ".Brand_machine::find($current_db->brand_machine_id)->name. Model_machine::find($current_db->model_machine_id)->name ." -> ".Brand_machine::find($request["brand_machine_id"])->name . Model_machine::find($request["model_machine_id"])->name,
                    'global_warehouse_id' => $current_db->id
                ]);
            }

            // CONDICION CAMBIADA
            if( $request["condicion"] != $current_db->condicion  ){

                $current_condicion = "";
                if($current_db->condicion == 1){ $current_condicion = "Buen estado"; } 
                if($current_db->condicion == 2){ $current_condicion = "Defectuosa"; }
                if($current_db->condicion == 3){ $current_condicion = "Solo Carcasa"; } 
                if($current_db->condicion == 4){ $current_condicion = "Dañada ( Repuesto )"; }
                
                $new_condicion = "";
                if($request["condicion"] == 1){ $new_condicion = "Buen estado"; } 
                if($request["condicion"] == 2){ $new_condicion = "Defectuosa"; }
                if($request["condicion"] == 3){ $new_condicion = "Solo Carcasa"; } 
                if($request["condicion"] == 4){ $new_condicion = "Dañada ( Repuesto )"; }

                History_machine::Create([
                    'name' => "CONDICION CAMBIADA | ".$current_condicion. " -> ".$new_condicion,
                    'global_warehouse_id' => $current_db->id
                ]);
            }

            // SALA CAMBIADA
            if( $request["room_id"] != $current_db->room_id  ){
                History_machine::Create([
                    'name' => "SALA CAMBIADA / GALPON CAMBIADO | ".Room::find($current_db->room_id)->name. " -> ".Room::find($request["room_id"])->name,
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

        // NUEVO INGRESO
        $current_item = Global_warehouse::updateOrCreate([ 'id' => $request["id"] ],$current_data);
        if( !$current_db ){
            History_machine::Create([
                'name' => "NUEVO INGRESO",
                'global_warehouse_id' => $current_item->id
            ]);
        }

        // SERIAL DUPLICADO
        $duplicado_db = Global_warehouse::where("serial","=",$request["serial"])->first();
        if( $duplicado_db && $current_item->id != $request["id"] ){
            History_machine::Create([
                'name' => "SERIAL DUPLICADO | ".$request["serial"],
                'global_warehouse_id' => $current_item->id
            ]);  
        }

        if( $request["new_novedad"] ){
            History_machine::Create([
                'name' => "PERSONALIZADO | ".$request["new_novedad"],
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
                global_warehouses.condicion AS condicion_group,
                brand_machines.name AS brand_name,
                model_machines.name AS model_name
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
            ->join('model_machines', 'global_warehouses.model_machine_id', '=', 'model_machines.id')
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
                    $item->group_name = "Galpon: ".$item->room_name;
                }
                if($item->room_group == 1){
                    $item->room_group = "Sala";
                    $item->group_name = "Sala: ".$item->room_name;
                }

                if($item->associated_group == 2){
                    $item->associated_group = "Invitado";
                }
                if($item->associated_group == 1){
                    $item->associated_group = "Asociado";
                }

                $history_global_warehouses = History_machine::where('global_warehouse_id','=',$item->id)->orderBy('created_at', 'DESC')->get();                
                $history_query = "";
                foreach ($history_global_warehouses as $key => $value) {
                    $history_query = $history_query ."<span class='font-weight-bold'>". $value["created_at"] . ":&nbsp;</span>" . $value["name"] . ".<br>";
                }
                   
                $item->history_query = $history_query;
            });


            
            //return $query;

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
