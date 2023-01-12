<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use App\Models\Attlog;
use App\Models\Employee;

class isapiController extends Controller
{
    private $IP_PLC_MARCAJE = "http://192.168.5.181";
    //private $IP_PLC_MARCAJE = "http://190.121.239.210:8061";
    

    public function getEvent(Request $request)
    {
        $resC = new Client();
        $totalMatches = json_decode($resC->post($this->IP_PLC_MARCAJE."/ISAPI/AccessControl/AcsEvent?format=json" ,[
            'auth' =>  ['admin', 'Cas1n01234','digest'],
            'body' => json_encode([
                "AcsEventCond"=> [
                    "searchID"=> "1",
                    "searchResultPosition"=> 0,
                    "maxResults"=> 1,
                    "major"=> 5,
                    "minor"=> 75,
                    "startTime"=> "2023-01-01T00:00:00+00:00",
                    "endTime"=> "2023-12-31T23:59:00+0:00"
                ]])])->getBody()->getContents(), TRUE)["AcsEvent"]["totalMatches"];
        
        $totalMatches30 = floor($totalMatches/30);
        $searchResultPosition = count(Attlog::all());
        set_time_limit(1000);
        if( $totalMatches > $searchResultPosition ){
            for ($i=0; $i < $totalMatches30 ; $i++) {
                $res = new Client();
                $query2 = json_decode($res->post($this->IP_PLC_MARCAJE."/ISAPI/AccessControl/AcsEvent?format=json" ,[
                    'auth' =>  ['admin', 'Cas1n01234','digest'],
                    'body' => json_encode([
                        "AcsEventCond"=> [
                            "searchID"=> "1",
                            "searchResultPosition"=> $searchResultPosition,
                            "maxResults"=> 30,
                            "major"=> 5,
                            "minor"=> 75,
                            "startTime"=> "2023-01-01T00:00:00+00:00",
                            "endTime"=> "2023-12-31T23:59:00+0:00"
                        ]])])->getBody()->getContents(), TRUE)["AcsEvent"]["InfoList"];
                $searchResultPosition +=30;
                foreach ($query2 as $key => $value) { Attlog::create($value); }
            }
            
            
        }
    }

    public function addOrUpdateEmployee(Request $request)
    {
        $resC = new Client();
        $current = json_decode($resC->put($this->IP_PLC_MARCAJE."/ISAPI/AccessControl/UserInfo/SetUp?format=json" ,[
            'auth' =>  ['admin', 'Cas1n01234','digest'],
            'body' => json_encode([
                "UserInfo"=> [
                    "employeeNo" =>$request["employeeNo"],
                    "name" =>$request["name"],
                    "userType" =>"normal",
                    "Valid"=>[
                        "enable"=> true,
                        "beginTime"=>"2000-01-01T00:00:00",
                        "endTime"=>"2035-01-01T00:00:00"
                    ],
                    "PersonInfoExtends"=>[[
                        "value"=> "{sexo:".$request['sex_id'].",departamento:".$request['department_id'].",cargo:".$request['position_id'].",sede:".$request['sede_id'].",nacimiento:".$request['nacimiento']."}"
                    ]],
                ]])
        ])->getBody()->getContents(), TRUE);

        if( $current['statusCode'] == 1 ){
            $current_data = array(
                "employeeNo" => $request["employeeNo"],
                "name" => $request["name"],
                "nacimiento" => $request["nacimiento"],
                "sex_id" => $request["sex_id"],
                "department_id" => $request["department_id"],
                "sede_id" => $request["sede_id"],
                "position_id" => $request["position_id"],
            );

            $current_item = Employee::updateOrCreate([ 'id' => $request["id"] ],$current_data);

            if($request->file('image')){
                $file= $request->file('image');
                $file->move(public_path('public/employees/'), $current_item->employeeNo.".jpg");       
            }

            $imgGet = new Client();
            $imgGetIMG = json_decode($imgGet->post($this->IP_PLC_MARCAJE."/ISAPI/Intelligent/FDLib/FDSearch?format=json" ,[
                'auth' =>  ['admin', 'Cas1n01234','digest'],
                'body' => json_encode([
                "searchResultPosition"=>0,
                "maxResults"=>100,
                "faceLibType"=>"blackFD",
                "FDID"=>"1",
                "FPID"=>$request["employeeNo"]
            ])])->getBody()->getContents(), TRUE)["responseStatusStrg"];

            if($imgGetIMG == "OK"){
                $imgDelete = new Client();
                $imgDeleteIMG = json_decode($imgDelete->put($this->IP_PLC_MARCAJE."/ISAPI/Intelligent/FDLib/FDSearch/Delete?format=json&FDID=1&faceLibType=blackFD" ,[
                    'auth' =>  ['admin', 'Cas1n01234','digest'],
                    'body' => json_encode([
                            "FPID" => [[ "value"=> $request["employeeNo"]
                        ]]
                    ])])->getBody()->getContents(), TRUE)["statusString"];
                if($imgDeleteIMG == "OK"){
                    $imgSend = new Client();
                    $imgSendIMG = json_decode($imgSend->post($this->IP_PLC_MARCAJE."/ISAPI/Intelligent/FDLib/FaceDataRecord?format=json" ,[
                        'auth' =>  ['admin', 'Cas1n01234','digest'],
                        'body' => json_encode([
                        "faceURL"=> $request["originIMG"],
                        "faceLibType"=> "blackFD",
                        "FDID"=> "1",
                        "FPID"=> $request["employeeNo"],
                        "name"=> $request["name"],
                        "gender"=> "male",
                        "featurePointType"=>"face"
                    ])])->getBody()->getContents(), TRUE);
                }
            }else{
                $imgSend = new Client();
                $imgSendIMG = json_decode($imgSend->post($this->IP_PLC_MARCAJE."/ISAPI/Intelligent/FDLib/FaceDataRecord?format=json" ,[
                    'auth' =>  ['admin', 'Cas1n01234','digest'],
                    'body' => json_encode([
                    "faceURL"=> $request["originIMG"],
                    "faceLibType"=> "blackFD",
                    "FDID"=> "1",
                    "FPID"=> $request["employeeNo"],
                    "name"=> $request["name"],
                    "gender"=> "male",
                    "featurePointType"=>"face"
                ])])->getBody()->getContents(), TRUE);
            }

            
            

            

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
        $resC = new Client();
        $current = json_decode($resC->put($this->IP_PLC_MARCAJE."/ISAPI/AccessControl/UserInfo/Delete?format=json" ,[
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

    public function uploadEmployees(Request $request)
    {
        foreach ($request["upload"] as $key => $value) {
            $resC = new Client();
            $current = json_decode($resC->put($this->IP_PLC_MARCAJE."/ISAPI/AccessControl/UserInfo/SetUp?format=json" ,[
                'auth' =>  ['admin', 'Cas1n01234','digest'],
                'body' => json_encode([
                    "UserInfo"=> [
                        "employeeNo" =>$value["employeeNo"],
                        "name" =>$value["name"],
                        "userType" =>"normal",
                        "Valid"=>[
                            "enable"=> true,
                            "beginTime"=>"2000-01-01T00:00:00",
                            "endTime"=>"2035-01-01T00:00:00"
                        ],
                        "PersonInfoExtends"=>[[
                            "value"=> "{sexo:".$value['sex_id'].",departamento:".$value['department_id'].",cargo:".$value['position_id'].",sede:".$value['sede_id'].",nacimiento:".$value['nacimiento']."}"
                        ]],
                    ]])
            ])->getBody()->getContents(), TRUE);

            if( $current['statusCode'] == 1 ){
                $current_delete = Employee::where("employeeNo","=",$value["employeeNo"])->delete();
                $current_item = Employee::Create($value);
                
            }
        }
    }

    public function authImgIsapi(Request $request)
    {    
        return response()->json([ 
            'first_pictureURL' => "http://admin:Cas1n01234@".$request["first_pictureURL"],
            'last_pictureURL' => "http://admin:Cas1n01234@".$request["last_pictureURL"]
        ]);  
    }
}
