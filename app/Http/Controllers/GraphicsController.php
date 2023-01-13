<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\User;
use App\Models\Level;
use App\Models\Group_menu;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;

class GraphicsController extends Controller
{
    public function index()
    {
        
        $group_menus = Group_menu::all();
        $sedes = Sede::all();
        return view('graphics.index')->with('group_menus',$group_menus)->with('sedes',$sedes); 
        
    }
}
