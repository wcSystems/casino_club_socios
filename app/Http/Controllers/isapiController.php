<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use App\Models\Attlog;
use App\Models\Employee;

class isapiController extends Controller
{
    public function getEvent(Request $request)
    {
        
        $host = "http://190.121.239.210:8061/";
        
        
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
                    "startTime"=> "2000-01-01T00:00:00+00:00",
                    "endTime"=> "3000-12-31T23:59:00+0:00"
                ]])])->getBody()->getContents(), TRUE)["AcsEvent"]["totalMatches"];
        
        $totalMatches30 = floor($totalMatches/30);
        $searchResultPosition = count(Attlog::all());
        set_time_limit(1000);
        if( $totalMatches > $searchResultPosition ){
            for ($i=0; $i < $totalMatches30 ; $i++) {
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
                        ]])])->getBody()->getContents(), TRUE)["AcsEvent"]["InfoList"];
                $searchResultPosition +=30;
                foreach ($query2 as $key => $value) { Attlog::create($value); }
            }
            
            
        }
    }

    public function addOrUpdateEmployee(Request $request)
    {
        
        $host = "http://192.168.5.181/";
        //$host = "http://190.121.239.210:8061/";
        $resC = new Client();
        $current = json_decode($resC->put($host."ISAPI/AccessControl/UserInfo/SetUp?format=json" ,[
            'auth' =>  ['admin', 'Cas1n01234','digest'],
            'body' => json_encode([
                "UserInfo"=> [
                    "employeeNo" =>$request["data"]["employeeNo"],
                    "name" =>$request["data"]["name"],
                    "userType" =>"normal",
                    "Valid"=>[
                        "enable"=> true,
                        "beginTime"=>"2000-01-01T00:00:00",
                        "endTime"=>"2035-01-01T00:00:00"
                    ],
                    "PersonInfoExtends"=>[[
                        "value"=> "{sexo:".$request["data"]['sex_id'].",departamento:".$request["data"]['department_id'].",cargo:".$request["data"]['position_id'].",sede:".$request["data"]['sede_id'].",nacimiento:".$request["data"]['nacimiento']."}"
                    ]],
                ]])
        ])->getBody()->getContents(), TRUE);

        if( $current['statusCode'] == 1 ){
            $current_item = Employee::updateOrCreate($request["id"],$request["data"]);
            if($current_item){
                return response()->json([ 'type' => 'success']);
            }else{
                return response()->json([ 'type' => 'error']);
            }
        }

        return $current;
     
    }

    public function elimEmployee(Request $request)
    {
        
        $host = "http://192.168.5.181/";
        //$host = "http://190.121.239.210:8061/";
        $resC = new Client();
        $current = json_decode($resC->put($host."ISAPI/AccessControl/UserInfo/Delete?format=json" ,[
            'auth' =>  ['admin', 'Cas1n01234','digest'],
            'body' => json_encode([
                "UserInfoDelCond"=> [
                    "EmployeeNoList"=>[[
                        "employeeNo"=> $request["employeeNo"]
                    ]],
                ]])
        ])->getBody()->getContents(), TRUE);

        if( $current['statusCode'] == 1 ){
            $current_item = Employee::find($request["id"]);
            if($current_item){
                $current_item->delete();
                return response()->json([ 'type' => 'success']);
            }else{
                return response()->json([ 'type' => 'error']);
            }
        }

        return $current;
     
    }
}
