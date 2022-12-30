<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associated_machine;
use App\Models\Associated_group;
use Illuminate\Support\Facades\DB;

class Associated_machinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associated_machines = Associated_machine::all();
        $associated_groups = Associated_group::all();
        return view('associated_machines.index')->with('associated_machines',$associated_machines)->with('associated_groups',$associated_groups);
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
        $current_item = Associated_machine::updateOrCreate($request["id"],$request["data"]);
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
        $current_item = Associated_machine::find($id);
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
        $search_asocciates_selects = $request->get('search_asocciates_selects');
        /* QUERY FILTER */
        $query = DB::table('associated_machines')->selectRaw('associated_machines.*,associated_groups.name AS group_name')
            ->orWhere(function($query) use ($search){
                $query->orWhere('associated_machines.name','LIKE','%'.$search.'%');
            })
            ->where(function($query) use ($search_asocciates_selects){
                if(!empty($search_asocciates_selects)){
                    $query->where('associated_machines.associated_group_id', '=', $search_asocciates_selects);
                }else{};
            })
            ->join('associated_groups', 'associated_machines.associated_group_id', '=', 'associated_groups.id')
            ->get();


        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Associated_machine::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
