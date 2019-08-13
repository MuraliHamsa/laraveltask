<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequests;
use App\Models\VehicleModels;
use Illuminate\Support\Facades\Validator;
date_default_timezone_set("Asia/Kolkata");

class ServiceRequestsController extends Controller {

  /**
   * [Display a paginated list of Service Requests in the system]
   * @return view
   */
  public function index(){
    $requests = ServiceRequests::with('vehicle','model')->orderBy('updated_at','desc')->paginate(20);
    return view('index',compact('requests'));
  }
  /**
   * [This is the method you should use to show the edit screen]
   * @param  ServiceRequests $serviceRequest [get the object you are planning on editing]
   * @return ...
   */


 public function deleteticket(request $request){
         
      $data = ServiceRequests::where('id',$request->ids)->delete();
      

      return back()->with('success','Ticket is Deleted !');
   



  }


  public function edit(request $request,$id){

      $data = ServiceRequests::find($id);
      $data->client_name  = $request->name;
      $data->client_phone = $request->number;
      $data->client_email = $request->email;
      $data->Vehicaltype = $request->VehicleType;
      $data->description = $request->desc;
      $data->save();

      return back()->with('success','Ticket is Updated !');
   



  }
  
  public function store(request $request){

       $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'VehicleType' => 'required',
      'number' => 'required|phone_unique:1',
      'model' => 'required',
      'name' => 'required|string|min:20|max:40',

  ], [
    'phone_unique' => 'Phone already exists!', 
  ]);
        
      $data = new ServiceRequests;
      $data->client_name  = $request->name;
      $data->client_phone = $request->number;
      $data->client_email = $request->email;
      $data->vehicle_model_id = $request->model;
      $data->Vehicaltype = $request->VehicleType;
      $data->description = $request->desc;

       if($data->save()){
        return back()->with('success',"Ticket is created !");
       }else{
        return back()->with('success',"Some issue please try again !");

       }
  
  }
 
}
