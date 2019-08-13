<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceRequests extends Model {
  protected $guarded = ['id'];
   use SoftDeletes;
    public $timestamps = true;
         use LogsActivity;

protected static $logFillable = true;

     protected static $logOnlyDirty = true; 

      protected static $causerId = 3;

     protected $fillable = [
        'client_name',
        'client_email',
        'description',
        'client_phone',
        'status',
        'vehicle_model_id',
        'Vehicaltype',
        'vehicle_model_id'
    ];










  public function vehicle()
    {
      return $this->hasOne('App\Models\VehicleMakes','id','Vehicaltype');
    
    } 

    public function model()
    {
      return $this->hasOne('App\Models\VehicleModels','id','vehicle_model_id');
    
    } 



}
