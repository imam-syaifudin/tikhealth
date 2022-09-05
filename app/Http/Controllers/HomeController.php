<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Copyleaks\Copyleaks;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function home(){

        $member = Member::paginate(10);
        $arr = [
            "title" => "Home"
        ];

        $columnName = DB::getSchemaBuilder()->getColumnListing('members');
        unset($columnName[0]);
        unset($columnName[9]);
        unset($columnName[10]);
        unset($columnName[8]);

        foreach ( $columnName as $col ){
            $array[] = preg_split('/(?=[A-Z])/', $col);
        }
        $i = 0;
        foreach ( $array as $data){
            $array[$i] = implode(" ",$data);
            $i++;
        }
        return view('home',compact('member','columnName','arr','array'));

    }
    


    public function cari(Request $request){
        $columnName = DB::getSchemaBuilder()->getColumnListing('members');
        $key = $request->key;
        $pecahKey = preg_split('/(?=[A-Z])/', $key);
        $soloKey = implode(" ",$pecahKey);
        unset($columnName[0]);
        unset($columnName[9]);
        unset($columnName[10]);
        unset($columnName[8]);
        foreach ( $columnName as $col ){
            $array[] = preg_split('/(?=[A-Z])/', $col);
        }
        $i = 0;
        foreach ( $array as $data){
            $array[$i] = implode(" ",$data);
            $i++;
        }

        if ( empty($request->key)){
            $member = Member::where("nama","like", "%" . $request->value . "%")->paginate(10)->withQueryString();
        } else {
            $member = Member::where($request->key,"like","%". $request->value . "%")->paginate(10)->withQueryString();
        }
        
        $arr = [
            "title" => "Pencarian {$request->value} " 
        ];
        
        return view('/home',compact('member','arr','columnName','key','array','soloKey'));
    }

}
