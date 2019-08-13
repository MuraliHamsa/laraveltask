<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleModels;
date_default_timezone_set("Asia/Kolkata");

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function getmodels(request $request ){
       
         $data =VehicleModels::where('vehicle_make_id',$request->name)->get(); 


         return response()->json($data);
    }
}
