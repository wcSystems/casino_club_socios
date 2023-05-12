<?php

namespace App\Http\Controllers;
use App\Models\Sede;
use App\Models\Fichas_casino;
use App\Models\Bancada_sede_casino;

use Illuminate\Http\Request;

class Bancada_sede_casinosController extends Controller
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
        $current_item = Bancada_sede_casino::updateOrCreate($request->id,$request->data);
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

    public function fichasBancada($sede_id)
    {
        $sede = Sede::where('id','LIKE','%'.$sede_id.'%')->first();
        $fichas = Fichas_casino::where('sede_id','LIKE','%'.$sede_id.'%')->get();
        $bancada = Bancada_sede_casino::where('sede_id','LIKE','%'.$sede_id.'%')->get();
        return response()->json([ 'type' => 'success','fichas' => $fichas,'bancada' => $bancada, 'sede_name'=> $sede->name]);
    }
}
