<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\Room;
use App\Models\Room_group;

use App\Models\Group_cierre_boveda;

use App\Models\Mesas_casino;
use App\Models\Billetes_casino;
use App\Models\Fichas_casino;
use App\Models\Stack_casino;
use App\Models\Global_warehouse;
use App\Models\Group_archings_casino;



use App\Models\Conteo_archings_cecom_casino;

use Illuminate\Support\Facades\DB;

class Cierre_mesasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::all();
        $rooms = Room::all();
        $global_warehouses = Global_warehouse::all();
        $room_groups = Room_group::all();
        $group_cierre_bovedas = Group_cierre_boveda::all();
        $mesas_casinos = Mesas_casino::all();
        $billetes_casinos = Billetes_casino::all();
        $fichas_casinos = Fichas_casino::all();
        $group_archings_casinos = Group_archings_casino::all();

        $stack_casinos = DB::table('stack_casinos')
                    ->selectRaw('stack_casinos.*, fichas_casinos.name AS ficha_name, sedes.id AS sede_id, sedes.name AS sede_name')
                    ->join('fichas_casinos', 'stack_casinos.fichas_casino_id', '=', 'fichas_casinos.id')
                    ->join('sedes', 'fichas_casinos.sede_id', '=', 'sedes.id')
                    ->get();

        return view('cierre_mesas.index')
                    ->with('sedes',$sedes)
                    ->with('rooms',$rooms)
                    ->with('room_groups',$room_groups)
                    ->with('global_warehouses',$global_warehouses)
                    ->with('group_cierre_bovedas',$group_cierre_bovedas)
                    ->with('group_archings_casinos',$group_archings_casinos)
                    ->with('mesas_casinos',$mesas_casinos)
                    ->with('billetes_casinos',$billetes_casinos)
                    ->with('fichas_casinos',$fichas_casinos)
                    ->with('stack_casinos',$stack_casinos);
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
        $current_item = Group_cierre_boveda::updateOrCreate($request["id"],$request["data"]);
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
        //
    }

    public function service(Request $request)
    {
        /* FIELDS TO FILTER */
        $search = $request->get('search');
        $search_sede_all = $request->get('search_sede_all');
        /* QUERY FILTER */
        $query = DB::table('group_cierre_bovedas')
                    ->selectRaw('group_cierre_bovedas.*, sedes.id AS sede_id, sedes.name AS sede_name,  DATE_FORMAT(group_cierre_bovedas.created_at, "%Y-%m-%d") AS group_name, DATE_FORMAT(group_cierre_bovedas.created_at, "%Y-%m-%d") AS created_at ')
                  
                    ->where(function($query) use ($search_sede_all){
                        if(!empty($search_sede_all)){
                            $query->where('group_cierre_bovedas.sede_id', '=', $search_sede_all);
                        }else{};
                    })
                    ->join('sedes', 'group_cierre_bovedas.sede_id', '=', 'sedes.id')
                    ->orderBy('group_cierre_bovedas.created_at', 'desc')
                    ->get();
        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Group_cierre_boveda::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }

    public function list(Request $request)
    {
  

        $list_archings = DB::table('conteo_arching_boveda_casinos')
            ->selectRaw('conteo_arching_boveda_casinos.*, fichas_casinos.name AS ficha_name')
            ->where("group_cierre_boveda_id","=",$request["id"])
            ->join('fichas_casinos', 'conteo_arching_boveda_casinos.fichas_casino_id', '=', 'fichas_casinos.id')
            ->get();

        $list_drops = DB::table('conteo_drop_boveda_casinos')
            ->selectRaw('conteo_drop_boveda_casinos.*, billetes_casinos.name AS billete_name')
            ->where("group_cierre_boveda_id","=",$request["id"])
            ->join('billetes_casinos', 'conteo_drop_boveda_casinos.billetes_casino_id', '=', 'billetes_casinos.id')
            ->get();

        $list_stacks = DB::table('stack_casinos')
            ->selectRaw('stack_casinos.*, fichas_casinos.name AS ficha_name')
            ->join('fichas_casinos', 'stack_casinos.fichas_casino_id', '=', 'fichas_casinos.id')
            ->get();

       


        return response()->json([ 'list_archings' => $list_archings,'list_drops' => $list_drops, 'list_stacks' => $list_stacks ]);
    }
}
