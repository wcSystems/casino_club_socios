<?php

namespace App\Http\Controllers;
use App\Models\Group_cierre_boveda;
use App\Models\Propina_mesa_casino;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Propina_mesa_casinosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $current_item = Propina_mesa_casino::updateOrCreate($request->id,$request->data);
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

    public function list(Request $request)
    {
        $list = DB::table('propina_mesa_casinos')
        ->selectRaw('propina_mesa_casinos.*, mesas_casinos.name AS mesa_name')
        ->where("group_cierre_boveda_casino_id","=",$request["id"])
        ->join('mesas_casinos', 'propina_mesa_casinos.mesas_casino_id', '=', 'mesas_casinos.id')
        ->get();
    
        return response()->json([ 'list' => $list ]);
    }
}
