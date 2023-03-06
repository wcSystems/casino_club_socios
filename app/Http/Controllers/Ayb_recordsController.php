<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use Illuminate\Support\Facades\DB;

class Ayb_recordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::all();
        return view('ayb_records.index')
                    ->with('sedes',$sedes);
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
        $search_rooms = $request->get('search_rooms');

        /* QUERY FILTER */
       
            $query = DB::table('ayb_item_commands')
            ->selectRaw('
                ayb_item_id, 
                ayb_items.name AS ayb_item_name,
                sedes.name AS sede_name,
                sedes.name AS group_name,
                type_commands.name AS type_command_name,
                DATE_FORMAT(ayb_item_commands.created_at, "%Y-%m-%d") AS created_at , 
                sum(ayb_item_commands.total) AS cantidad,
                ayb_items.price,
                sum( ayb_item_commands.total * ayb_items.price  ) AS total_menu
            ')
            ->join('ayb_items', 'ayb_item_commands.ayb_item_id', '=', 'ayb_items.id')
            ->join('ayb_commands', 'ayb_item_commands.ayb_command_id', '=', 'ayb_commands.id')
            ->join('type_commands', 'ayb_commands.type_command_id', '=', 'type_commands.id')
            ->join('sedes', 'ayb_items.sede_id', '=', 'sedes.id')
            ->groupBy('ayb_item_id', DB::raw("DATE_FORMAT(ayb_item_commands.created_at, '%Y-%m-%d')"), 'ayb_items.sede_id', 'ayb_commands.type_command_id' )
            ->orderBy('ayb_item_commands.created_at','desc')->orderBy('type_commands.name','desc')
            ->get();

            


            


            $query->each(function ($item) {

                    $query2 = DB::table('ayb_item_commands')
                    ->selectRaw('
                        sedes.name AS sede_name,
                        type_commands.name AS type_command_name,
                        DATE_FORMAT(ayb_item_commands.created_at, "%Y-%m-%d") AS created_at , 
                        sum(ayb_item_commands.total) AS cantidad,
                        ayb_items.price,
                        sum( ayb_item_commands.total * ayb_items.price  ) AS total_menu
                    ')
                    ->join('ayb_items', 'ayb_item_commands.ayb_item_id', '=', 'ayb_items.id')
                    ->join('ayb_commands', 'ayb_item_commands.ayb_command_id', '=', 'ayb_commands.id')
                    ->join('type_commands', 'ayb_commands.type_command_id', '=', 'type_commands.id')
                    ->join('sedes', 'ayb_items.sede_id', '=', 'sedes.id')
                    ->groupBy( DB::raw("DATE_FORMAT(ayb_item_commands.created_at, '%Y-%m-%d')"), 'ayb_items.sede_id', 'ayb_commands.type_command_id' )
                    ->get();

                    foreach ($query2 as $key => $value) {
                        if( $item->created_at == $value->created_at && $item->sede_name == $value->sede_name && $item->type_command_name == $value->type_command_name ){

                            $item->group_name = "<span class='font-weight-bold'>".$item->created_at ."&nbsp;|&nbsp;".$item->sede_name."&nbsp;|&nbsp;".$item->type_command_name."&nbsp;|&nbsp;$&nbsp;".$value->total_menu."</span>";
               
                        }
                    }
            });
           


            
            //return $query;

        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count($query);
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }

}
