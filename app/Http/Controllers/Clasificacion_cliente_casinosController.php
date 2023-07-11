<?php

namespace App\Http\Controllers;
use App\Models\Clasificacion_cliente_casino;
use App\Models\Clientes_casino;
use App\Models\Sex;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Clasificacion_cliente_casinosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = Auth::user();
        $clasificacion_cliente_casinos = Clasificacion_cliente_casino::all();
        $clientes_casinos = Clientes_casino::all();
        $sexs = Sex::all();
        $sedes = Sede::all();
        return view('clasificacion_cliente_casinos.index')
                    ->with('sexs',$sexs)
                    ->with('sedes',$sedes)
                    ->with('clientes_casinos',$clientes_casinos)
                    ->with('dataUser',$dataUser)
                    ->with('clasificacion_cliente_casinos',$clasificacion_cliente_casinos);
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
        $current_item = Clasificacion_cliente_casino::updateOrCreate($request["id"],$request["data"]);
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
        $current_item = Clasificacion_cliente_casino::find($id);
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
        $query = DB::table('clasificacion_cliente_casinos')
                    ->selectRaw('clasificacion_cliente_casinos.*')
                    ->orWhere(function($query) use ($search){
                        $query->orWhere('clasificacion_cliente_casinos.name','LIKE','%'.$search.'%');
                    })
                    ->get();
        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Clasificacion_cliente_casino::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }

}
