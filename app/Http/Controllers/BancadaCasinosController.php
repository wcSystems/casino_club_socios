<?php

namespace App\Http\Controllers;
use App\Models\Sede;
use App\Models\Fichas_casino;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class BancadaCasinosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::all();
        $fichas_casinos = Fichas_casino::all();
        return view('bancada_casinos.index')->with('sedes',$sedes)->with('fichas_casinos',$fichas_casinos);
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
    public function service(Request $request)
    {
        /* FIELDS TO FILTER */
        $search = $request->get('search');
        $search_sede_all = $request->get('search_sede_all');
        /* QUERY FILTER */
        $query = DB::table('sedes')
                    ->selectRaw('sedes.*, sedes.name AS sede_name')
                    ->orWhere(function($query) use ($search){
                        $query->orWhere('name','LIKE','%'.$search.'%');
                    })
                    ->where(function($query) use ($search_sede_all){
                        if(!empty($search_sede_all)){
                            $query->where('sedes.id', '=', $search_sede_all);
                        }else{};
                    })
                    ->get();
        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Sede::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
