<?php

namespace App\Models;

use App\Models\SensorBmp;
use App\Models\DataDashboard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataDevice extends Model
{
    use HasFactory;

    protected $table = "db_device";

    protected $guarded;

    public function dashboard()
    {
        return $this->hasMany(DataDashboard::class);
    }
    public function sensorBmp(){
        return $this->belongsTo(SensorBmp::class, 'device_id','device_id');
    }
    public function sensorThigrow(){
        return $this->belongsTo(SensorThigrow::class, 'token','device_token');
    }
    public function sensorThm30d(){
        return $this->belongsTo(SensorThm30::class, 'device_id','device_id');
    }
    public function sensorBn220(){
        return $this->belongsTo(SensorBn220::class, 'device_id','device_id');
    }
    public function sensorIna219(){
        return $this->belongsTo(SensorIna219::class, 'device_id','device_id');
    }
    // public function sensorBmp()
    // {
    //     return $this->hasMany(SensorBmp::class);
    // }
}
