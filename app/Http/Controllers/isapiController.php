<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Attlog;

class isapiController extends Controller
{
    public function getEvent(Request $request)
    {
        $host = "";
        if( $request["ip"] == "190.121.239.210" ){
            $host = "http://192.168.5.181/";
        }else{
            $host = "http://190.121.239.210:8061/";
        }
        
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
                ]])])->getBody()->getContents(), TRUE)["AcsEvent"]["totalMatches"];
        
        $totalMatches30 = floor($totalMatches/30);
        $searchResultPosition = count(Attlog::all());
        
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
}
