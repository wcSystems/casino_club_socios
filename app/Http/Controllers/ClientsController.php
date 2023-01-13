<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Sede;
use App\Models\Table;

use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::all();
        $clients = Client::all();
        $sedes = Sede::all();
        return view('clients.index')
                        ->with('tables',$tables)
                        ->with('sedes',$sedes)
                        ->with('clients',$clients);
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
        $current_item = Client::updateOrCreate($request["id"],$request["data"]);
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
        $current_item = Client::find($id);
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

        /* FIELDS TO FILTER */
        $search = $request->get('search');
        $search_transportation = $request->get('search_transportation');

        $search_club_vip = $request->get('search_club_vip');
        $search_referido = $request->get('search_referido');
        $search_vive_cerca = $request->get('search_vive_cerca');
        $search_trabaja_cerca = $request->get('search_trabaja_cerca');
        $search_solo_de_paso = $request->get('search_solo_de_paso');
        $search_descuento = $request->get('search_descuento');
        $search_puntos_por_canje = $request->get('search_puntos_por_canje');
        $search_ticket_souvenirs = $request->get('search_ticket_souvenirs');
        $search_ticket_machine = $request->get('search_ticket_machine');
        $search_ticket_table = $request->get('search_ticket_table');

        $query = Client::select(DB::raw('clients.*, sedes.name AS sede_name'))
                    ->orWhere(function($query) use ($search){
                        $query->orWhere('clients.name','LIKE','%'.$search.'%');
                        $query->orWhere('last_name','LIKE','%'.$search.'%');
                        $query->orWhere('cedula','LIKE','%'.$search.'%');
                        $query->orWhere('f_nac','LIKE','%'.$search.'%');
                        $query->orWhere('email','LIKE','%'.$search.'%');
                        $query->orWhere('address','LIKE','%'.$search.'%');
                        $query->orWhere('phone','LIKE','%'.$search.'%');
                    })
                    ->join('sedes', 'clients.sede_id', '=', 'sedes.id')
                    ->get();

        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Client::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
