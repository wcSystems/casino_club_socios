<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group_drops_casino;
use App\Models\Conteo_drop_cecom_casino;
use Illuminate\Support\Facades\DB;

class Conteo_drop_cecom_casinosController extends Controller
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
        $group_drops_casino = Group_drops_casino::find($request->group_drops_casino_id);
        $group_drops_casino->extra = $request->extra;
        $group_drops_casino->save();

        $current_item = Conteo_drop_cecom_casino::updateOrCreate($request->id,$request->data);
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
  

                        $list = DB::table('conteo_drop_cecom_casinos')
                        ->selectRaw('conteo_drop_cecom_casinos.*, billetes_casinos.name AS billete_name')
                        ->where("group_drops_casino_id","=",$request["id"])
                        ->join('billetes_casinos', 'conteo_drop_cecom_casinos.billetes_casino_id', '=', 'billetes_casinos.id')
                        ->get();
    


        return response()->json([ 'list' => $list ]);
    }

}
