<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group_archings_casino;
use App\Models\Conteo_archings_cecom_casino;
use Illuminate\Support\Facades\DB;

class Conteo_archings_cecom_casinosController extends Controller
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
        $group_archings_casino = Group_archings_casino::find($request->group_archings_casino_id);
        $group_archings_casino->save();

        $current_item = Conteo_archings_cecom_casino::updateOrCreate($request->id,$request->data);
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
  

                        $list = DB::table('conteo_archings_cecom_casinos')
                        ->selectRaw('conteo_archings_cecom_casinos.*, fichas_casinos.name AS ficha_name')
                        ->where("group_archings_casino_id","=",$request["id"])
                        ->join('fichas_casinos', 'conteo_archings_cecom_casinos.fichas_casino_id', '=', 'fichas_casinos.id')
                        ->get();
    


        return response()->json([ 'list' => $list ]);
    }

}
