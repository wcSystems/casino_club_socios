<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use App\Models\Level;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $levels = Level::all();
        return view('users.index')->with('users',$users)->with('id',Auth::id())->with('levels',$levels);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = User::where('email', $request["email"])->count() > 1;
        if($exist){
            return response()->json([ 'type' => 'repeat']);
        }

            if($request["password"]){
                $current_data = array(
                    "email" => $request["email"],
                    "name" => $request["name"],
                    "level_id" => $request["level_id"],
                    "password" => bcrypt($request["password"]),
                );
            }
            if(!$request["password"]){
                $current_data = array(
                    "email" => $request["email"],
                    "name" => $request["name"],
                    "level_id" => $request["level_id"],
                );
            }

            

            $current_item = User::updateOrCreate([ 'id' => $request["id"] ],$current_data);

            if($current_item){

                if($request->file('image')){
                    $file= $request->file('image');
                    $ext= $file->getClientOriginalExtension();
                    $file-> move(public_path('public/users/'), $current_item->id.".jpg");
                }

                return response()->json([ 'type' => 'success']);
            }else{
                return response()->json([ 'type' => 'error']);
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_item = User::find($id);
        if($current_item){
            $current_item->delete();
            return response()->json([ 'type' => 'success']);
        }else{
            return response()->json([ 'type' => 'error']);
        }
    }

    public function service(Request $request)
    {
        /* FIELDS TO FILTER */
        $search = $request->get('search');
        
        $query = User::select(DB::raw('users.*, levels.name AS level_name'))
        ->orWhere(function($query) use ($search){
            $query->orWhere('users.email','LIKE','%'.$search.'%');
            $query->orWhere('users.name','LIKE','%'.$search.'%');
            $query->orWhere('levels.name','LIKE','%'.$search.'%');
        })
        ->join('levels', 'users.level_id', '=', 'levels.id')
        ->get();




        /* FIELDS DEFAULTS DATATABLES */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(User::all());
        $totalRecordswithFilter = count($query);

        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query,
            "id" => Auth::user()
        ));
    }
}
