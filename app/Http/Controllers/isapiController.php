<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use App\Models\Attlog;
use App\Models\Schedule_template;
use App\Models\Employee;
use App\Models\Ayb_command;
use App\Models\Device_hikvision_facial_casino;
use File;

use GuzzleHttp\Exception\RequestException;

class isapiController extends Controller
{
    // private $IP_PLC_MARCAJE = "http://192.168.1.111";
    // private $IP_PLC_MARCAJE = "http://190.121.239.210:8061";
    // private $IP_PLC_PASSWORD = "S0p0rt3S0p0rt3";
    

    public function getEvent(Request $request)
    {
        $credentials = Device_hikvision_facial_casino::where("sede_id","=",$request->sede_id)->first();

        $position = (int)$request->position;
        $res = new Client();
        $records = json_decode($res->post($credentials->public."/ISAPI/AccessControl/AcsEvent?format=json" ,[
            'auth' =>  ['admin', $credentials->password,'digest'],
            'body' => json_encode([
                "AcsEventCond"=> [
                    "searchID"=> "1",
                    "searchResultPosition" => $position,
                    "maxResults"=> 30,
                    "major"=> 5,
                    "minor"=> 75,
                    "startTime"=> $request->init,
                    "endTime"=> $request->year."-".$request->month."-".$request->end."T23:59:00+0:00"
                ]])])->getBody()->getContents(), TRUE)["AcsEvent"]["InfoList"];
        foreach ($records as $key => $value) { 
            Attlog::where( "serialNo","=",$value["serialNo"] )->delete(); 
            Attlog::create($value); 
        }
        return response()->json([ 'type' => 'success']);
      
        
    }
    public function getMatches(Request $request)
    {
        $credentials = Device_hikvision_facial_casino::where("sede_id","=",$request->sede_id)->first();
        $attlogs = Attlog::where('time','LIKE','%'.$request->year."-".$request->month.'%')->orderBy('time', 'desc')->first();
        if( !is_null($attlogs) ){
            try {
                $resC = new Client();
                $totalMatches = json_decode($resC->post($credentials->public."/ISAPI/AccessControl/AcsEvent?format=json" ,[
                    'auth' =>  ['admin', $credentials->password,'digest'], 'body' => json_encode([
                        "AcsEventCond"=> [
                            "searchID"=> "1",
                            "searchResultPosition"=> 0,
                            "maxResults"=> 30,
                            "major"=> 5,
                            "minor"=> 75,
                            "startTime"=> $attlogs->time,
                            "endTime"=> $request->year."-".$request->month."-".$request->end."T23:59:00+0:00"
                        ]
                    ])])->getBody()->getContents(), TRUE)["AcsEvent"]["totalMatches"];
                    
                if( $totalMatches == 0 ){
                    return response()->json([ 'type' => 'error']);
                }
                return response()->json([ 'type' => 'success', 'totalMatches' => $totalMatches, 'time' => $attlogs->time ]);
            } catch (RequestException $e) {
                return response()->json([ 'type' => 'error_server', 'info' => $e->getMessage()]);
            }
        }else{
            try {
                $resC = new Client();
                $totalMatches = json_decode($resC->post($credentials->public."/ISAPI/AccessControl/AcsEvent?format=json" ,[
                    'auth' =>  ['admin', $credentials->password,'digest'], 'body' => json_encode([
                        "AcsEventCond"=> [
                            "searchID"=> "1",
                            "searchResultPosition"=> 0,
                            "maxResults"=> 30,
                            "major"=> 5,
                            "minor"=> 75,
                            "startTime"=> $request->year."-".$request->month."-01T00:00:00+00:00",
                            "endTime"=> $request->year."-".$request->month."-".$request->end."T23:59:00+0:00"
                        ]
                    ])])->getBody()->getContents(), TRUE)["AcsEvent"]["totalMatches"];
                    
                if( $totalMatches == 0 ){
                    return response()->json([ 'type' => 'error']);
                }
                return response()->json([ 'type' => 'success', 'totalMatches' => $totalMatches, 'time' => $request->year."-".$request->month."-01T00:00:00+00:00" ]);
            } catch (RequestException $e) {
                return response()->json([ 'type' => 'error_server', 'info' => $e->getMessage()]);
            }
        }
    }

    public function addOrUpdateEmployee(Request $request)
    {

        $credentials = Device_hikvision_facial_casino::where("sede_id","=",$request->sede_id)->first();
        

        if (File::exists(public_path('public/employees/'.$request["employeeNo"].'.jpg')) && $request["id"] == "" ) {
            File::delete(public_path('public/employees/'.$request["employeeNo"].'.jpg'));
        }

        

        $resC = new Client();
        $current = json_decode($resC->put($credentials->public."/ISAPI/AccessControl/UserInfo/SetUp?format=json" ,[
            'auth' =>  ['admin', $credentials->password,'digest'],
            'body' => json_encode([
                "UserInfo"=> [
                    "employeeNo" =>$request["employeeNo"],
                    "name" =>$request["name"],
                    "userType" =>"normal",
                    "Valid"=>[
                        "enable"=> true,
                        "beginTime"=>"2023-01-01T00:00:00",
                        "endTime"=>"2023-12-31T23:59:59"
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

            
            if($current_item){


                if($request->file('image')){
                    $file= $request->file('image');
                    $file->move(public_path('public/employees/'), $request["employeeNo"].'.jpg');       
                }

                // busca si existe alguna imagen
                $imgGet = new Client();
                $imgGetIMG = json_decode($imgGet->post($credentials->public."/ISAPI/Intelligent/FDLib/FDSearch?format=json" ,[
                    'auth' =>  ['admin', $credentials->password,'digest'],
                    'body' => json_encode([
                    "searchResultPosition"=>0,
                    "maxResults"=>100,
                    "faceLibType"=>"blackFD",
                    "FDID"=>"1",
                    "FPID"=>$request["employeeNo"]
                ])])->getBody()->getContents(), TRUE)["responseStatusStrg"];

                
    

                // si existe borrala primero
                if($imgGetIMG == "OK"){
                    $imgDelete = new Client();
                    $imgDeleteIMG = json_decode($imgDelete->put($credentials->public."/ISAPI/Intelligent/FDLib/FDSearch/Delete?format=json&FDID=1&faceLibType=blackFD" ,[
                        'auth' =>  ['admin', $credentials->password,'digest'],
                        'body' => json_encode([
                                "FPID" => [[ "value"=> $request["employeeNo"]
                            ]]
                        ])])->getBody()->getContents(), TRUE)["statusString"];
                }

                // agrega la nueva imagen
                $imgSend = new Client();
                $imgSendIMG = json_decode($imgSend->post($credentials->public."/ISAPI/Intelligent/FDLib/FaceDataRecord?format=json" ,[
                    'auth' =>  ['admin', $credentials->password,'digest'],
                    'body' => json_encode([
                        "faceURL"=> $request["originIMG"],
                        "faceLibType"=>"blackFD",
                        "FDID"=> "1",
                        "FPID"=> $request["employeeNo"]
                    ])])->getBody()->getContents(), TRUE);
                    return response()->json([ 'imgSendIMG' => $imgSendIMG]);

    




                return response()->json([ 'type' => 'success']);
            }else{
                return response()->json([ 'type' => 'error']);
            }
        }
     
    }

    public function elimEmployee(Request $request)
    {
        $credentials = Device_hikvision_facial_casino::where("sede_id","=",$request->sede_id)->first();

        if (File::exists(public_path('public/employees/'.$request["employeeNo"].'.jpg')) ) {
            File::delete(public_path('public/employees/'.$request["employeeNo"].'.jpg'));
        }

        $resC = new Client();
        $current = json_decode($resC->put($credentials->public."/ISAPI/AccessControl/UserInfo/Delete?format=json" ,[
            'auth' =>  ['admin', $credentials->password,'digest'],
            'body' => json_encode([
                "UserInfoDelCond"=> [
                    "EmployeeNoList"=>[[
                        "employeeNo"=> $request["employeeNo"]
                    ]],
                ]])
        ])->getBody()->getContents(), TRUE);

        if( $current['statusCode'] == 1 ){

            Schedule_template::where('employee_id','=', $request["id"])->delete();
            Ayb_command::where('employee_id','=', $request["id"])->delete();
            
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
        $credentials = Device_hikvision_facial_casino::where("sede_id","=",$request->sede_id)->first();

        foreach ($request["upload"] as $key => $value) {
            $resC = new Client();
            $current = json_decode($resC->put($credentials->public."/ISAPI/AccessControl/UserInfo/SetUp?format=json" ,[
                'auth' =>  ['admin', $credentials->password,'digest'],
                'body' => json_encode([
                    "UserInfo"=> [
                        "employeeNo" =>$value["employeeNo"],
                        "name" =>$value["name"],
                        "userType" =>"normal",
                        "Valid"=>[
                            "enable"=> true,
                            "beginTime"=>"2000-01-01T00:00:00",
                            "endTime"=>"2037-12-31T23:59:59"
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
        $credentials = Device_hikvision_facial_casino::where("sede_id","=",$request->sede_id)->first();

        return response()->json([ 
            'first_pictureURL' => "http://admin@".$credentials->password."".$request["first_pictureURL"],
            'last_pictureURL' => "http://admin@".$credentials->password."".$request["last_pictureURL"]
        ]);  
    }



    public function sendImg(Request $request)
    {

        

        return "0";
    }



}
