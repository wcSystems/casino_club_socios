<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
//use App\Models\Client_view;
use App\Models\Client;
use App\User;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;

class GraphicsController extends Controller
{
    public function index()
    {
        /* $charts = array();
        $charts["club_vip"] = [
            'labels' => DB::table('count_client_club_vip_views')->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Club Vip',
                    'data' => DB::table('count_client_club_vip_views')->pluck('total'),
                    'backgroundColor' => ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.2)'],
                    'borderColor' => ['rgba(54, 162, 235, 1)','rgba(255, 99, 132, 1)'],
                    'borderWidth' => 1
                ]
            ] 
        ];
        $charts["transportation"] = [
            'labels' => DB::table('count_client_transportation_views')->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Medio de Transporte',
                    'data' => DB::table('count_client_transportation_views')->pluck('total'),
                    'backgroundColor' => ['rgba(255, 159, 64, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)'],
                    'borderColor' => ['rgba(255, 159, 64, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)'],
                    'borderWidth' => 1
                ]
            ] 
        ];
        $charts["como_nos_conoce"] = [
            'labels' => [ 'Referido', 'Vive Cerca', 'Trabaja Cerca', 'Solo de Paso' ],
            'datasets' => [
                [
                    'label' => 'Si',
                    'data' => [
                        Client::select(DB::raw('count(*) as total'))->where("referido","=","1")->first()->total, 
                        Client::select(DB::raw('count(*) as total'))->where("vive_cerca","=","1")->first()->total, 
                        Client::select(DB::raw('count(*) as total'))->where("trabaja_cerca","=","1")->first()->total, 
                        Client::select(DB::raw('count(*) as total'))->where("solo_de_paso","=","1")->first()->total
                    ],
                    'backgroundColor' => ['rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)'],
                    'borderColor' => ['rgba(54, 162, 235, 1)','rgba(54, 162, 235, 1)','rgba(54, 162, 235, 1)','rgba(54, 162, 235, 1)'],
                    'borderWidth' => 1
                ],
                [
                    'label' => 'No',
                    'data' => [
                        Client::select(DB::raw('count(*) as total'))->where("referido","=","0")->first()->total, 
                        Client::select(DB::raw('count(*) as total'))->where("vive_cerca","=","0")->first()->total, 
                        Client::select(DB::raw('count(*) as total'))->where("trabaja_cerca","=","0")->first()->total, 
                        Client::select(DB::raw('count(*) as total'))->where("solo_de_paso","=","0")->first()->total
                    ],
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)'],
                    'borderColor' => ['rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)'],
                    'borderWidth' => 1
                ]
            ] 
        ];
        $charts["preferencias_por_beneficios"] = [
            'labels' => [ 'Descuentos', 'Puntos por canje', 'Ticket souvenirs' ],
            'datasets' => [
                [
                    'label' => 'Si',
                    'data' => [
                        Client::select(DB::raw('count(*) as total'))->where("descuento","=","1")->first()->total,
                        Client::select(DB::raw('count(*) as total'))->where("puntos_por_canje","=","1")->first()->total,
                        Client::select(DB::raw('count(*) as total'))->where("ticket_souvenirs","=","1")->first()->total
                    ],
                    'backgroundColor' => ['rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)'],
                    'borderColor' => ['rgba(54, 162, 235, 1)','rgba(54, 162, 235, 1)','rgba(54, 162, 235, 1)','rgba(54, 162, 235, 1)'],
                    'borderWidth' => 1
                ],
                [
                    'label' => 'No',
                    'data' => [
                        Client::select(DB::raw('count(*) as total'))->where("descuento","=","0")->first()->total,
                        Client::select(DB::raw('count(*) as total'))->where("puntos_por_canje","=","0")->first()->total,
                        Client::select(DB::raw('count(*) as total'))->where("ticket_souvenirs","=","0")->first()->total
                    ],
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)'],
                    'borderColor' => ['rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)'],
                    'borderWidth' => 1
                ]
            ]
        ];
        $charts["machine"] = [
            'labels' => DB::table('count_client_machine_views')->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Club Vip',
                    'data' => DB::table('count_client_machine_views')->pluck('total'),
                    'backgroundColor' => ['rgba(255, 159, 64, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)'],
                    'borderColor' => ['rgba(255, 159, 64, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)'],
                    'borderWidth' => 1
                ]
            ] 
        ];
        $charts["table"] = [
            'labels' => DB::table('count_client_table_views')->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Club Vip',
                    'data' => DB::table('count_client_table_views')->pluck('total'),
                    'backgroundColor' => ['rgba(255, 159, 64, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)'],
                    'borderColor' => ['rgba(255, 159, 64, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)'],
                    'borderWidth' => 1
                ]
            ] 
        ];
        $charts["food"] = [
            'labels' => DB::table('count_client_food_views')->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Club Vip',
                    'data' => DB::table('count_client_food_views')->pluck('total'),
                    'backgroundColor' => ['rgba(255, 159, 64, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)'],
                    'borderColor' => ['rgba(255, 159, 64, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)'],
                    'borderWidth' => 1
                ]
            ] 
        ];
        $charts["juice"] = [
            'labels' => DB::table('count_client_juice_views')->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Club Vip',
                    'data' => DB::table('count_client_juice_views')->pluck('total'),
                    'backgroundColor' => ['rgba(255, 159, 64, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)'],
                    'borderColor' => ['rgba(255, 159, 64, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)'],
                    'borderWidth' => 1
                ]
            ] 
        ];
        $charts["drink"] = [
            'labels' => DB::table('count_client_drink_views')->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Club Vip',
                    'data' => DB::table('count_client_drink_views')->pluck('total'),
                    'backgroundColor' => ['rgba(255, 159, 64, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)'],
                    'borderColor' => ['rgba(255, 159, 64, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)'],
                    'borderWidth' => 1
                ]
            ] 
        ];
        $charts = json_encode($charts);
        return view('graphics.index')->with('charts',$charts);  */
        $users = User::all();
        $levels = Level::all();
        return view('users.index')->with('users',$users)->with('id',Auth::id())->with('levels',$levels);;
    }
}
