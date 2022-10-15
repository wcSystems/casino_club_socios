<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class isapiController extends Controller
{
    private $host = "http://192.168.5.181/";
    private $username = "admin";
    private $password = "Cas1n01234";

    public function getimg(Request $request)
    {
        $res = new Client();
        $query = json_decode($res->get($request["url"] ,[
            'auth' =>  [$this->username, $this->password,'digest'],
        ])->getBody()->getContents(), TRUE);
        return $query;
    }
}
