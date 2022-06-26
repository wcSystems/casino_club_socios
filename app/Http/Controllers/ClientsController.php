<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Transportation;
use App\Models\Machine;
use App\Models\Table;
use App\Models\Food;
use App\Models\Juice;
use App\Models\Drink;

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
        $transportations = Transportation::all();
        $machines = Machine::all();
        $tables = Table::all();
        $foods = Food::all();
        $juices = Juice::all();
        $drinks = Drink::all();
        return view('clients.index')
                        ->with('transportations',$transportations)
                        ->with('machines',$machines)
                        ->with('tables',$tables)
                        ->with('foods',$foods)
                        ->with('juices',$juices)
                        ->with('drinks',$drinks);
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
        $current_item = new Client($request->all());
        $current_item->save();
        $current_item->machines()->attach($request->client_machines);
        $current_item->tables()->attach($request->client_tables);
        $current_item->foods()->attach($request->client_foods);
        $current_item->juices()->attach($request->client_juices);
        $current_item->drinks()->attach($request->client_drinks);
        return response()->json([ 'type' => 'success', 'data' => $current_item]);
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

        $query = DB::table('clients')
        ->orWhere(function($query) use ($search){
            $query->orWhere('name','LIKE','%'.$search.'%');
            $query->orWhere('last_name','LIKE','%'.$search.'%');
            $query->orWhere('cedula','LIKE','%'.$search.'%');
            $query->orWhere('f_nac','LIKE','%'.$search.'%');
            $query->orWhere('email','LIKE','%'.$search.'%');
            $query->orWhere('address','LIKE','%'.$search.'%');
            $query->orWhere('phone','LIKE','%'.$search.'%');
        })
        ->where(function($query) use ($search_transportation,$search_club_vip,$search_referido,$search_vive_cerca,$search_trabaja_cerca,$search_solo_de_paso,$search_descuento,$search_puntos_por_canje,$search_ticket_souvenirs){
            if(!empty($search_transportation)){
                $query->where('transportation_id', '=', $search_transportation);
            }else{};
            if($search_club_vip==1){
                $query->where('club_vip', '=', 1);
            }else{};
            if(!empty($search_referido)){
                $query->where('referido', '=', $search_referido);
            }else{};
            if(!empty($search_vive_cerca)){
                $query->where('vive_cerca', '=', $search_vive_cerca);
            }else{};
            if(!empty($search_trabaja_cerca)){
                $query->where('trabaja_cerca', '=', $search_trabaja_cerca);
            }else{};
            if(!empty($search_solo_de_paso)){
                $query->where('solo_de_paso', '=', $search_solo_de_paso);
            }else{};
            if(!empty($search_descuento)){
                $query->where('descuento', '=', $search_descuento);
            }else{};
            if(!empty($search_puntos_por_canje)){
                $query->where('puntos_por_canje', '=', $search_puntos_por_canje);
            }else{};
            if(!empty($search_ticket_souvenirs)){
                $query->where('ticket_souvenirs', '=', $search_ticket_souvenirs);
            }else{};
            /* if(!empty($search_ticket_machine)){
                $query->where('machine', '=', $search_ticket_machine);
            }else{};
            if(!empty($search_ticket_table)){
                $query->where('table', '=', $search_ticket_table);
            }else{}; */
        })
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
