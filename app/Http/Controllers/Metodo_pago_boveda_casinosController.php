<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\Metodo_pago_boveda_casino;
use Illuminate\Support\Facades\DB;

class Metodo_pago_boveda_casinosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::all();
        $metodo_pagos = Metodo_pago_boveda_casino::all();
        return view('metodo_pago_casinos.index')->with('sedes',$sedes)->with('metodo_pagos',$metodo_pagos);
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
        $current_item = Metodo_pago_boveda_casino::updateOrCreate($request["id"],$request["data"]);
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
        $query = DB::table('metodo_pago_boveda_casinos')
                    ->selectRaw('metodo_pago_boveda_casinos.*, sedes.name AS sede_name, sedes.name AS group_name')
                    ->orWhere(function($query) use ($search){
                        $query->orWhere('metodo_pago_boveda_casinos.name','LIKE','%'.$search.'%');
                    })
                    ->where(function($query) use ($search_sede_all){
                        if(!empty($search_sede_all)){
                            $query->where('metodo_pago_boveda_casinos.sede_id', '=', $search_sede_all);
                        }else{};
                    })
                    ->join('sedes', 'metodo_pago_boveda_casinos.sede_id', '=', 'sedes.id')
                    ->get();
        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Metodo_pago_boveda_casino::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
