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
        /* $search = $request->get('search');
        $start = $request->get('start');
        $end = $request->get('end'); */

        /* QUERY FILTER */
        /* $query = DB::table('attlogs')
        
        ->orWhere(function($query) use ($search){
            $query->orWhere('employeeID','LIKE','%'.$search.'%');
            $query->orWhere('personName','LIKE','%'.$search.'%');
            $query->orWhere('authDate','LIKE','%'.$search.'%');
            $query->orWhere('authTime','LIKE','%'.$search.'%');
        })->select('employeeID', 'personName', 'authDate')->selectRaw('MIN(authTime) AS first, MAX(authTime) AS last')
        ->groupBy('authDate','employeeID','personName')
        ->orderBy('authDate', 'DESC')
        ->whereBetween('authDate', [$start, $end])
        ->get(); */

        





        $host = "http://190.121.239.210:8061/";
        ///$host = "http://192.168.5.181/";







        $resC = new Client();
        $totalMatches = json_decode($resC->post($host."ISAPI/AccessControl/AcsEvent?format=json" ,[
            'auth' =>  ['admin', 'Cas1n01234','digest'],
            'body' => json_encode([
                "AcsEventCond"=> [
                    "searchID"=> "1",
                    "searchResultPosition"=> 0,
                    "maxResults"=> 1,
                    "major"=> 5,
                    "minor"=> 75,
                    "startTime"=> "2022-01-01T00:00:00+00:00",
                    "endTime"=> "2022-12-31T23:59:00+0:00"
                ]
            ]),
            'headers' => [
                'X-Frame-Options' => 'SAMEORIGIN',
            ]
        ])->getBody()->getContents(), TRUE)["AcsEvent"]["totalMatches"];







        set_time_limit(240);
        $totalMatches = round($totalMatches/30, 0, PHP_ROUND_HALF_DOWN);
        
        $query = [];
        $searchResultPosition = 0;
        for ($i=0; $i < $totalMatches ; $i++) { 
            $res = new Client();
            $query2 = json_decode($res->post($host."ISAPI/AccessControl/AcsEvent?format=json" ,[
                'auth' =>  ['admin', 'Cas1n01234','digest'],
                'body' => json_encode([
                    "AcsEventCond"=> [
                        "searchID"=> "1",
                        "searchResultPosition"=> $searchResultPosition,
                        "maxResults"=> 30,
                        "major"=> 5,
                        "minor"=> 75,
                        "startTime"=> "2022-01-01T00:00:00+00:00",
                        "endTime"=> "2022-12-31T23:59:00+0:00"
                    ]
                ]),
                'headers' => [
                    'X-Frame-Options' => 'SAMEORIGIN',
                ]
            ])->getBody()->getContents(), TRUE)["AcsEvent"]["InfoList"];
            $query = array_merge( $query , $query2 );
            $searchResultPosition +=30;
        }



        $query_reverse = array_reverse($query);




        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count($query_reverse);
        $totalRecordswithFilter = count($query_reverse);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query_reverse
        ));
    }

}
