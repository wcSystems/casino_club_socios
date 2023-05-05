<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group_cierre_boveda;
use App\Models\Conteo_arching_boveda_casino;
use Illuminate\Support\Facades\DB;

class Conteo_arching_boveda_casinosController extends Controller
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
      
        $current_item = Conteo_arching_boveda_casino::updateOrCreate($request->id,$request->data);
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
  

                        $list = DB::table('conteo_arching_boveda_casinos')
                        ->selectRaw('conteo_arching_boveda_casinos.*, fichas_casinos.name AS ficha_name')
                        ->where("group_cierre_boveda_id","=",$request["id"])
                        ->join('fichas_casinos', 'conteo_arching_boveda_casinos.fichas_casino_id', '=', 'fichas_casinos.id')
          
                        ->get();
    


        return response()->json([ 'list' => $list ]);
    }

}
