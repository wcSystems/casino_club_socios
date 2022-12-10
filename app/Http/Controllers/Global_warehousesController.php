<?php

namespace App\Http\Controllers;
use App\Models\Global_warehouse;
use App\Models\History_machine;
use App\Models\Shed;
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
        $sheds = Shed::all();
        return view('global_warehouses.index')->with('global_warehouses',$global_warehouses)->with('sheds',$sheds);
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
        $search_sheds = $request->get('search_sheds');
        /* QUERY FILTER */
        //$query = Global_warehouse::with("history")->where('name','LIKE','%'.$search.'%')->get();


        /* QUERY FILTER */
        $query = DB::table('global_warehouses')
            ->selectRaw('
                global_warehouses.*, 
                sheds.name AS shed_name
            ')
            ->orWhere(function($query) use ($search){
                $query->orWhere('global_warehouses.name','LIKE','%'.$search.'%');
                $query->orWhere('global_warehouses.cod','LIKE','%'.$search.'%');
                $query->orWhere('global_warehouses.description','LIKE','%'.$search.'%');
            })
            ->where(function($query) use ($search_sheds){
                if(!empty($search_sheds)){
                    $query->where('global_warehouses.shed_id', '=', $search_sheds);
                }else{};
            })
            ->join('sheds', 'global_warehouses.shed_id', '=', 'sheds.id')
            ->get();



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
}
