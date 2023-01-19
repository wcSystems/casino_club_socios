<?php

namespace App\Http\Controllers;
use App\Models\Sede;
use App\Models\Group_drops_casino;
use App\Models\Conteo_drop_cecom_casino;
use App\Models\Billetes_casino;
use App\Models\Mesas_casino;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Group_drops_casinosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::all();
        $mesas_casinos = Mesas_casino::all();
        $billetes_casinos = Billetes_casino::all();
        $group_drops_casinos = Group_drops_casino::all();
        return view('group_drops_casinos.index')->with('group_drops_casinos',$group_drops_casinos)->with('sedes',$sedes)->with('billetes_casinos',$billetes_casinos)->with('mesas_casinos',$mesas_casinos);
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
        $current_item = Group_drops_casino::updateOrCreate($request["id"],$request["data"]);
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
        Conteo_drop_cecom_casino::where("group_drops_casino_id","=",$id)->delete();
        $current_item = Group_drops_casino::find($id);
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
        $query = DB::table('group_drops_casinos')
                    ->selectRaw('group_drops_casinos.*, sedes.id AS sede_id, sedes.name AS sede_name, sedes.name AS group_name')
                    ->join('sedes', 'group_drops_casinos.sede_id', '=', 'sedes.id')
                    ->get();
        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Group_drops_casino::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
