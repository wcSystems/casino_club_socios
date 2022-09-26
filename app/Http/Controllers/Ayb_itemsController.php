<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayb_item;
use App\Models\Group_menu;
use App\Models\Sede;
use App\Models\Img_ayb_item;

class Ayb_itemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayb_items = Ayb_item::all();
        $sedes = Sede::all();
        $group_menus = Group_menu::all();
        return view('ayb_items.index')->with('ayb_items',$ayb_items)->with('sedes',$sedes)->with('group_menus',$group_menus);
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



        if($request->file('image')){
            
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('public/Ayb_item/'.$request["id"]), $filename);

            Img_ayb_item::create(array(
                'name'  => $filename,
                'ayb_item_id' => $request["id"]
            ));

        }

        

        /* $imgs = Img_ayb_item::where('ayb_item_id','=',$request["id"]);
        $imgs->each(function($item, $key) {
            $item->delete();
        }); */


        




        
        $data = $request->all();
        $current_data = array(
            "name" => $data["name"],
            "description" => $data["description"],
            "price" => $data["price"],
            "sede_id" => $data["sede_id"],
            "group_menu_id" => $data["group_menu_id"],
        );

        

        $current_item = Ayb_item::updateOrCreate([ 'id' => $data["id"] ], $current_data);


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
        $current_item = Ayb_item::find($id);
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
        /* QUERY FILTER */
        $query = Ayb_item::where('name','LIKE','%'.$search.'%')->get();
        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Ayb_item::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
