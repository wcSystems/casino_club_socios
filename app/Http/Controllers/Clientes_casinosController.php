<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion_cliente_casino;
use App\Models\Clientes_casino;
use App\Models\Sede;
use App\Models\Sex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;

use Illuminate\Http\Request;

class Clientes_casinosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = Auth::user();
        $clasificacion_cliente_casinos = Clasificacion_cliente_casino::all();
        $clientes_casinos = Clientes_casino::all();
        $sedes = Sede::all();
        $sexs = Sex::all();
        return view('clientes_casinos.index')
                        ->with('clasificacion_cliente_casinos',$clasificacion_cliente_casinos)
                        ->with('clientes_casinos',$clientes_casinos)
                        ->with('sedes',$sedes)
                        ->with('dataUser',$dataUser)
                        ->with('sexs',$sexs);
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
        $data = $request->all();
        $current_data = array(
            "name" => $data["name"],
            "sex_id" => $data["sex_id"],
            "sede_id" => $data["sede_id"],
            "description" => $data["description"],
            "clasificacion_cliente_casino_id" => $data["clasificacion_cliente_casino_id"]
        );
        $current_item = Clientes_casino::updateOrCreate([ 'id' => $data["id"] ],$current_data);
        if($current_item){
            if($request->file('image')){
                $file= $request->file('image');
                $file->move(public_path('public/clientes_casinos/'), $current_item->id.'.jpg');       
            }
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
        $current_item = Clientes_casino::find($id);
        
        if($current_item){
            if (File::exists(public_path('public/clientes_casinos/'.$id.'.jpg')) ) {
                File::delete(public_path('public/clientes_casinos/'.$id.'.jpg'));
            }

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

        $search_sede = $request->get('search_sede_all');
        $search_department = $request->get('search_department_all');
        $search_sex = $request->get('search_sex_all');

        /* QUERY FILTER */
        $query = Clientes_casino::where('name','LIKE','%'.$search.'%')->get();


        /* QUERY FILTER */
        $query = Clientes_casino::select(DB::raw('clientes_casinos.*, sedes.name AS sedes_name, clasificacion_cliente_casinos.name AS clasificacion_cliente_casinos_name, sedes.name AS group_name, sexs.name AS sexs_name'))
                    ->orWhere(function($query) use ($search){
                        $query->orWhere('clientes_casinos.name','LIKE','%'.$search.'%');
                    })
                    ->where(function($query) use ($search_sede, $search_department, $search_sex){
                        if(!empty($search_sede)){
                            $query->where('clientes_casinos.sede_id', '=', $search_sede);
                        }else{};
                        if(!empty($search_department)){
                            $query->where('clientes_casinos.clasificacion_cliente_casino_id', '=', $search_department);
                        }else{};
                        if(!empty($search_sex)){
                            $query->where('clientes_casinos.sex_id', '=', $search_sex);
                        }else{};
                    })
                    ->join('sedes', 'clientes_casinos.sede_id', '=', 'sedes.id')
                    ->join('clasificacion_cliente_casinos', 'clientes_casinos.clasificacion_cliente_casino_id', '=', 'clasificacion_cliente_casinos.id')
                    ->join('sexs', 'clientes_casinos.sex_id', '=', 'sexs.id')
                    ->orderBy('id', 'ASC')->get();



        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Clientes_casino::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
