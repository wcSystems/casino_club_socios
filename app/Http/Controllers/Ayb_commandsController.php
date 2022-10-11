<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayb_command;
use App\Models\Ayb_item;
use App\Models\Ayb_item_command;
use Illuminate\Support\Facades\DB;
use App\User;

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
        $users = User::all();
        $ayb_item_commands = Ayb_item_command::all();
        return view('ayb_commands.index')->with('ayb_commands',$ayb_commands)->with('ayb_items',$ayb_items)->with('ayb_item_commands',$ayb_item_commands)->with('users',$users);
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
        $current_data_command = array(
            "user_id" => $request["data"]["user_id"],
        );
        $current_item_command = Ayb_command::updateOrCreate($request["id"],$current_data_command);

        $obj = $request["data"]["obj"];

        foreach ($obj as $key) {
            $current_item = Ayb_item_command::create([ 'ayb_item_id' => $key["ayb_item_id"], 'ayb_command_id' => $current_item_command->id, 'total' => $key["total"], 'option' => $key["option"], 'game' => $key["game"] ]);
        }

        if($current_item_command){
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
        $Ayb_commands = Ayb_item_command::where('ayb_command_id','=',$id);

        $Ayb_commands->each(function($item, $key) {
            $item->delete();
        });



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

        $query = Ayb_command::select(DB::raw('ayb_commands.*, ayb_commands.created_at AS group_name, users.name AS user_name'))
                    ->where('users.name','LIKE','%'.$search.'%')
                    ->orWhere('ayb_commands.created_at','LIKE','%'.$search.'%')
                    ->join('users', 'ayb_commands.user_id', '=', 'users.id')->get();

        $query->each(function ($item) {
            $item->group_name = DATE_FORMAT($item->created_at, "Y-m-d");
        });




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
    
    public function pjoin(Request $request)
    {
      
        $id = $request["id"];

        $list = Ayb_item_command::select(DB::raw('ayb_item_commands.*, ayb_items.name AS item_name, ayb_items.price AS price'))
                    ->where('ayb_item_commands.ayb_command_id','=',$id)
                    ->join('ayb_commands', 'ayb_item_commands.ayb_command_id', '=', 'ayb_commands.id')
                    ->join('ayb_items', 'ayb_item_commands.ayb_item_id', '=', 'ayb_items.id')
                    ->get();

        $aprobado = Ayb_command::select(DB::raw('users.name, ayb_commands.created_at AS fecha'))
                        ->where('ayb_commands.id','=',$id)
                        ->join('users', 'ayb_commands.user_id', '=', 'users.id')
                        ->first();

        //$list = Ayb_item_command::with($id);

        echo json_encode(array(
            "productos" => $list,
            "aprobado" => $aprobado->name,
            "fecha" => $aprobado->fecha,
        ));
    }


}
