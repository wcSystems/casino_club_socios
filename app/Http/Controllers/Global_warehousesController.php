<?php

namespace App\Http\Controllers;
use App\Models\Global_warehouse;
use App\Models\History_machine;
use App\Models\Room;
use App\Models\Room_group;
use App\Models\Associated_machine;
use App\Models\Associated_group;
use App\Models\Condicion_group;
use App\Models\Brand_machine;
use App\Models\Model_machine;
use App\Models\Img_global_warehouse;

use App\Models\Range_machine;
use App\Models\Value_machine;
use App\Models\Play_machine;

use App\Models\Novedades_type;

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
        $all_colors = [ "#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" , "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0", "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" , "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" , "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" , "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" , "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d", "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977", "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b", "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf", "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234", "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158", "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647", "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3", "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec", "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#21538e", "#89d534", "#d36647", "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3", "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec", "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#9cb64a", "#996c48", "#9ab9b7", "#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8", "#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16", "#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce", "#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997", "#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be", "#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba", "#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043", "#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56", "#28fcfd", "#bb09b", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f", "#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49", "#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9", "#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4", "#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06", "#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a", "#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065", "#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35", "#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44", "#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67", "#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff", "#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6", "#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca"];
        $global_warehouses = Global_warehouse::with("history")->with("imgs")->get();

        $rooms = Room::all();
        $room_groups = Room_group::all();
        $brand_machines = Brand_machine::all();
        $model_machines = Model_machine::all();
        $associated_machines = Associated_machine::all();
        $associated_groups = Associated_group::all();
        $condicion_groups = Condicion_group::all();

        $range_machines = Range_machine::all();
        $value_machines = Value_machine::all();
        $play_machines = Play_machine::all();

        $novedades_types = Novedades_type::all();

        return view('global_warehouses.index')
            ->with('global_warehouses',$global_warehouses)
            ->with('associated_machines',$associated_machines)
            ->with('associated_groups',$associated_groups)
            ->with('brand_machines',$brand_machines)
            ->with('model_machines',$model_machines)
            ->with('rooms',$rooms)
            ->with('room_groups',$room_groups)
            ->with('condicion_groups',$condicion_groups)

            ->with('range_machines',$range_machines)
            ->with('value_machines',$value_machines)
            ->with('play_machines',$play_machines)
            ->with('novedades_types',$novedades_types)
            ->with('all_colors',json_encode($all_colors));
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

        
        // IF EXISTS
        $current_db = Global_warehouse::where("id","=",$request["id"])->first();
        if( $current_db ){
            // SERIAL CAMBIADA
            if( $request["serial"] != $current_db->serial  ){
                History_machine::Create([
                    'name' => $current_db->serial. " -> ".$request["serial"],
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "2",
                ]);
            }
            // SOCIEDAD CAMBIADA
            if( $request["associated_machine_id"] != $current_db->associated_machine_id  ){

                $current = Associated_machine::select(DB::raw('associated_machines.*, associated_groups.name AS associated_group_name'))
                            ->where('associated_machines.id','=',$current_db->associated_machine_id)
                            ->join('associated_groups', 'associated_machines.associated_group_id', '=', 'associated_groups.id')
                            ->first();

                $new = Associated_machine::select(DB::raw('associated_machines.*, associated_groups.name AS associated_group_name'))
                            ->where('associated_machines.id','=',$request["associated_machine_id"])
                            ->join('associated_groups', 'associated_machines.associated_group_id', '=', 'associated_groups.id')
                            ->first();

                $text = "<span class='font-weight-bold' >" . $current->associated_group_name. ": </span>" . $current->name. " -> <span class='font-weight-bold' >" . $new->associated_group_name. ": </span>" . $new->name;
                History_machine::Create([
                    'name' => $text,
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "3",
                ]);
            }
            // MARCA CAMBIADA
            if( $request["brand_machine_id"] != $current_db->brand_machine_id || $request["model_machine_id"] != $current_db->model_machine_id ){

                $text = "<span class='font-weight-bold' >" . Brand_machine::find($current_db->brand_machine_id)->name. ": </span>" . Model_machine::find($current_db->model_machine_id)->name. " -> <span class='font-weight-bold' >" . Brand_machine::find($request["brand_machine_id"])->name. ": </span>" . Model_machine::find($request["model_machine_id"])->name;

                History_machine::Create([
                    'name' => $text ,
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "4",
                ]);
            }
            // CONDICION CAMBIADA
            if( $request["condicion_group_id"] != $current_db->condicion_group_id  ){

                

                $text =  Condicion_group::find($current_db->condicion_group_id)->name. " -> " . Condicion_group::find($request["condicion_group_id"])->name;

                History_machine::Create([
                    'name' => $text,
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "5",
                ]);
            }
            // SALA CAMBIADA
            if( $request["room_id"] != $current_db->room_id  ){

                $current = Room::select(DB::raw('rooms.*, room_groups.name AS room_group_name'))
                            ->where('rooms.id','=',$current_db->room_id)
                            ->join('room_groups', 'rooms.room_group_id', '=', 'room_groups.id')
                            ->first();

                $new = Room::select(DB::raw('rooms.*, room_groups.name AS room_group_name'))
                            ->where('rooms.id','=',$request["room_id"])
                            ->join('room_groups', 'rooms.room_group_id', '=', 'room_groups.id')
                            ->first();
                            
                $text = "<span class='font-weight-bold' >" . $current->room_group_name. ": </span>" . $current->name. " -> <span class='font-weight-bold' >" . $new->room_group_name. ": </span>" . $new->name;


                History_machine::Create([
                    'name' => $text,
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "6",
                ]);
            }

            // NOMBRE UNICO CAMBIADO
            if( $request["name_machine_room_active"] != $current_db->name_machine_room_active && $current_db->name_machine_room_active != null ){
                History_machine::Create([
                    'name' => $current_db->name_machine_room_active. " -> ".$request["name_machine_room_active"],
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "7",
                ]);
            }
            // DENOMINACION CAMBIADA
            if( $request["value_machine_id"] != $current_db->value_machine_id && $current_db->value_machine_id != null ){
                History_machine::Create([
                    'name' => "DENOMINACION CAMBIADA | ".Value_machine::find($current_db->value_machine_id)->name. " -> ".Value_machine::find($request["value_machine_id"])->name,
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "10",
                ]);
            }
            // JUEGO CAMBIADO
            if( $request["play_machine_id"] != $current_db->play_machine_id && $current_db->play_machine_id != null ){
                History_machine::Create([
                    'name' => "JUEGO CAMBIADO | ".Play_machine::find($current_db->play_machine_id)->name. " -> ".Play_machine::find($request["play_machine_id"])->name,
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "9",
                ]);
            }
            //  RANGO CAMBIADO
            if( $request["range_machine_id"] != $current_db->range_machine_id && $current_db->range_machine_id != null ){
                History_machine::Create([
                    'name' => "RANGO CAMBIADO | ".Range_machine::find($current_db->range_machine_id)->name. " -> ".Range_machine::find($request["range_machine_id"])->name,
                    'global_warehouse_id' => $current_db->id,
                    'novedades_type_id' => "8",
                ]);
            }
        }
    
        // TEMPLATE MODELS
        $current_data = array(
            "serial" => $request["serial"],
            "associated_machine_id" => $request["associated_machine_id"],
            "brand_machine_id" => $request["brand_machine_id"],
            "model_machine_id" => $request["model_machine_id"],
            "condicion_group_id" => $request["condicion_group_id"],
            "room_id" => $request["room_id"],
            "name_machine_room_active" => $request["name_machine_room_active"],
            "value_machine_id" => $request["value_machine_id"],
            "play_machine_id" => $request["play_machine_id"],
            "range_machine_id" => $request["range_machine_id"],
        );

        // NUEVO INGRESO
        $current_item = Global_warehouse::updateOrCreate([ 'id' => $request["id"] ],$current_data);

        // NEW INGRESO
        if( !$current_db ){
            History_machine::Create([
                'name' => " - - - ",
                'global_warehouse_id' => $current_item->id,
                'novedades_type_id' => "1",
            ]);
        }

        //NEW NOVEDAD
        if( $request["new_novedad"] ){
            History_machine::Create([
                'name' => $request["new_novedad"],
                'global_warehouse_id' => $current_item->id,
                'novedades_type_id' => "11",
            ]);
        }
    



        



        if($current_item){
            // UPLOAD WITH IMAGES
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
                room_groups.name AS room_group,
                room_groups.id AS room_group_id,

                associated_machines.name AS associated_name,
                associated_groups.name AS associated_group,
                condicion_groups.name AS condicion_group,

                range_machines.name AS range_group,
                play_machines.name AS play_group,
                value_machines.name AS value_group,

                brand_machines.name AS brand_name,
                model_machines.name AS model_name
            ')
            ->orWhere(function($query) use ($search){
                $query->orWhere('global_warehouses.serial','LIKE','%'.$search.'%');
            })
            ->where(function($query) use ($search_type_group_associated,$search_associated_select,$search_brand_machines_select,$search_model_machines_select,$search_type_group_room,$search_room_select,$search_condicion_select){
                

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
            ->get();

            $query->each(function ($item) {
                $item->group_name = "<span class='font-weight-bold'>". $item->room_group . ":&nbsp;</span>" . $item->room_name . "<br>";
                
                $history_global_warehouses = History_machine::where('global_warehouse_id','=',$item->id)->orderBy('created_at', 'DESC')->get();                
                $history_query = "";
                foreach ($history_global_warehouses as $key => $value) {
                    $history_query = $history_query ."<span class='font-weight-bold'>". $value["created_at"] . ":&nbsp;</span>" . $value["name"] . ".<br>";
                }

                //img exist
                $img_global_warehouses = Img_global_warehouse::where('global_warehouse_id','=',$item->id)->first();                
                $img_query = "SIN IMAGENES";
                if($img_global_warehouses){
                    $img_query = "CON IMAGENES";
                }

                //serial S/S               
                $serial_query = "CON SERIALES";
                if($item->serial == "S/S" || $item->serial == "" || $item->serial == null ){
                    $serial_query = "SIN SERIALES";
                }

                //Name Machine Room Active [ SOLO SI YA ESTA EN SALA ID 1 ]      
                $room_active_group = "borrar";
                if($item->room_group_id == 1){
                    if($item->name_machine_room_active == "" || $item->name_machine_room_active == null ){
                        $room_active_group = "SIN NOMBRES";
                    }else{
                        $room_active_group = "CON NOMBRES";
                    }
                }

                //Rangos [ SOLO SI YA ESTA EN SALA ID 1 ]      
                $range_group = "borrar";
                if($item->room_group_id == 1){
                    if($item->range_group == "" || $item->range_group == null ){
                        $range_group = "SIN RANGOS";
                    }else{
                        $range_group = $item->range_group;
                    }
                }

                //JUEGOS [ SOLO SI YA ESTA EN SALA ID 1 ]      
                $play_group = "borrar";
                if($item->room_group_id == 1){
                    if($item->play_group == "" || $item->play_group == null ){
                        $play_group = "SIN JUEGOS";
                    }else{
                        $play_group = $item->play_group;
                    }
                }

                //JUEGOS [ SOLO SI YA ESTA EN SALA ID 1 ]      
                $value_group = "borrar";
                if($item->room_group_id == 1){
                    if($item->value_group == "" || $item->value_group == null ){
                        $value_group = "SIN DENOMINACIONES";
                    }else{
                        $value_group = $item->value_group;
                    }
                }

                $item->range_group = $range_group;
                $item->play_group = $play_group;
                $item->value_group = $value_group;
                $item->room_active_group = $room_active_group;
                $item->serial_query = $serial_query;
                $item->img_query = $img_query;
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
