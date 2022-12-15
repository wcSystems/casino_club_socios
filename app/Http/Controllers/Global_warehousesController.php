<?php

namespace App\Http\Controllers;
use App\Models\Global_warehouse;
use App\Models\History_machine;
use App\Models\Room;
use App\Models\Associated_machine;
use App\Models\Brand_machine;
use App\Models\Model_machine;

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
        $global_warehouses = Global_warehouse::with("history")->get();
        $rooms = Room::all();
        $brand_machines = Brand_machine::all();
        $associated_machines = Associated_machine::all();
        return view('global_warehouses.index')
            ->with('global_warehouses',$global_warehouses)
            ->with('associated_machines',$associated_machines)
            ->with('brand_machines',$brand_machines)
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
        if( $request["id"] ){
            $current_db = Global_warehouse::where("id","=",$request["id"])->first();
            if( $request["data"]["serial"] != $current_db->serial ){
                History_machine::Create([
                    'name' => "SERIAL CAMBIADO, Antes: ".$current_db->serial. ", Nuevo: ".$request["data"]["serial"],
                    'global_warehouse_id' => $current_db->id
                ]);
            }
        }
        
        $current_item = Global_warehouse::updateOrCreate($request["id"],$request["data"]);
        if( $request["new_novedad"] ){
            History_machine::Create([
                'name' => $request["new_novedad"],
                'global_warehouse_id' => $current_item->id
            ]);
        }
        
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
        /* QUERY FILTER */
        //$query = Global_warehouse::with("history")->where('name','LIKE','%'.$search.'%')->get();


        /* QUERY FILTER */
        $query = DB::table('global_warehouses')
            ->selectRaw('
                global_warehouses.*, 
                rooms.name AS room_name,
                rooms.group AS room_group
            ')
            ->orWhere(function($query) use ($search){
                $query->orWhere('global_warehouses.serial','LIKE','%'.$search.'%');
            })
            ->where(function($query) use ($search_rooms){
                if(!empty($search_rooms)){
                    $query->where('global_warehouses.room_id', '=', $search_rooms);
                }else{};
            })
            ->join('rooms', 'global_warehouses.room_id', '=', 'rooms.id')
            ->get();

            $query->each(function ($item) {

                if($item->condicion == 0){
                    $item->condicion = "Buen estado";
                }
                if($item->condicion == 1){
                    $item->condicion = "Defectuosa";
                }
                if($item->condicion == 2){
                    $item->condicion = "Solo Carcasa";
                }
                if($item->condicion == 3){
                    $item->condicion = "Dañada ( Repuesto )";
                }

                if($item->room_group == 0){
                    $item->room_group = "Galpon";
                }
                if($item->room_group == 1){
                    $item->room_group = "Sala";
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
