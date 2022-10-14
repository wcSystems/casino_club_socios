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

        $body =  [
            "UserInfoSearchCond" =>
            [
                "searchID" => "0",
                "searchResultPosition" => 0,
                "maxResults" => 30
            ]
        ];

        $client = new Client();
        $res = $client->post('http://192.168.5.181/ISAPI/AccessControl/UserInfo/Search?format=json' ,[
            'auth' =>  ['admin', 'Cas1n01234','digest'],
            'body' => json_encode($body)
        ]);
        

        echo $res->getStatusCode();
        echo $res->getBody();




        



        /* $attlogs = Attlog::all();
        return view('attlogs.index')->with('attlogs',$attlogs); */
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
    {+
        /* FIELDS TO FILTER */
        $search = $request->get('search');
        $start = $request->get('start');
        $end = $request->get('end');

        /* QUERY FILTER */
        $query = DB::table('attlogs')
        
        ->orWhere(function($query) use ($search){
            $query->orWhere('employeeID','LIKE','%'.$search.'%');
            $query->orWhere('personName','LIKE','%'.$search.'%');
            $query->orWhere('authDate','LIKE','%'.$search.'%');
            $query->orWhere('authTime','LIKE','%'.$search.'%');
        })->select('employeeID', 'personName', 'authDate')//->selectRaw('MIN(authTime) AS first, MAX(authTime) AS last')
        ->groupBy('authDate','employeeID','personName')
        ->orderBy('authDate', 'DESC')
        ->whereBetween('authDate', [$start, $end])
        ->get();

        

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Attlog::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }

}
