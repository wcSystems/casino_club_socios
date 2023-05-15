<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Operaciones_mesas_casinosController extends Controller
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
        //
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
  

                        $list = DB::table('operaciones_mesas_casinos')
                        ->selectRaw('operaciones_mesas_casinos.*, billetes_casinos.name AS billete_name')

                        ->where("operaciones_mesas_casinos.group_cierre_boveda_casino_id","=",$request["id"])

                        ->join('billetes_casinos', 'operaciones_mesas_casinos.billetes_casino_id', '=', 'billetes_casinos.id')
                        ->join('mesas_casinos', 'operaciones_mesas_casinos.mesas_casino_id', '=', 'mesas_casinos.id')
                        ->join('fichas_casinos', 'operaciones_mesas_casinos.fichas_casino_id', '=', 'fichas_casinos.id')

                        ->get();
    


        return response()->json([ 'list' => $list ]);
    }
}
