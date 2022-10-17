<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attlog;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;


class AttlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function index()
    {
        return view('attlogs.index');
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
        $start = $request->get('start');
        $end = $request->get('end');

        /* QUERY FILTER */
        $query = DB::table('attlogs')
        ->orWhere(function($query) use ($search){
            $query->orWhere('employeeNoString','LIKE','%'.$search.'%');
            $query->orWhere('name','LIKE','%'.$search.'%');
            $query->orWhere('time','LIKE','%'.$search.'%');
        })->select('employeeNoString', 'name', 'time','serialNo','pictureURL')
        ->selectRaw('
            MIN(time) AS first, 
            MAX(time) AS last, 
            MIN(pictureURL) AS first_pictureURL, 
            MAX(pictureURL) AS last_pictureURL, 
            STR_TO_DATE(time, "%Y-%m-%D") AS date
        ')
        ->groupBy('date','employeeNoString','name')
        //->whereBetween('date', [$start, $end])
        ->get();

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
