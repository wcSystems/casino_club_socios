<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayb_command;
use App\Models\Ayb_item;
use App\Models\Ayb_item_command;
use Illuminate\Support\Facades\DB;

class Ayb_commandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayb_commands = Ayb_command::all();
        $ayb_items = Ayb_item::all();
        $ayb_item_commands = Ayb_item_command::all();
        return view('ayb_commands.index')->with('ayb_commands',$ayb_commands)->with('ayb_items',$ayb_items)->with('ayb_item_commands',$ayb_item_commands);
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
        $current_item = new Ayb_command();
        $current_item->save();

        $current_data = array(
            "ayb_item_id" => $request["data"]["ayb_item_id"],
            "ayb_command_id" => $current_item->id,
            "total" => $request["data"]["total"],
            "option" => $request["data"]["option"],
            "game" => $request["data"]["game"],
            "aprobado" => $request["data"]["aprobado"],
        );


        $current_item = Ayb_item_command::updateOrCreate($request["id"],$current_data);


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
        $current_item = Ayb_command::find($id);
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
        /* QUERY FILTER */
        //$query = Ayb_command::where('ayb_item_id','LIKE','%'.$search.'%')->get();
        //$query = Ayb_item_command::all();

        $query = Ayb_item_command::select(DB::raw('ayb_item_commands.*, DATE_FORMAT(ayb_item_commands.created_at, "%Y-%m-%d") AS group_name, ayb_items.name AS item_name'))
                    ->where('ayb_items.name','LIKE','%'.$search.'%')
                    ->orWhere('ayb_item_commands.option','LIKE','%'.$search.'%')
                    ->orWhere('ayb_item_commands.game','LIKE','%'.$search.'%')
                    ->orWhere('ayb_item_commands.aprobado','LIKE','%'.$search.'%')
                    ->orWhere('ayb_item_commands.total','LIKE','%'.$search.'%')
                    ->orWhere('ayb_item_commands.created_at','LIKE','%'.$search.'%')
                    ->join('ayb_items', 'ayb_item_commands.ayb_item_id', '=', 'ayb_items.id')->get();


        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Ayb_item_command::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
