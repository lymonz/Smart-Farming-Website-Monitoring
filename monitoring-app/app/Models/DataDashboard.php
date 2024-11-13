<?php

namespace App\Models;

use App\Models\SensorBmp;
use App\Models\DataDevice;
use App\Models\SensorThm30;
use App\Models\SensorThigrow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataDashboard extends Model
{
    use HasFactory;

    protected $table = 'db_dashboard';

    protected $guarded;

    public function device()
    {
        return $this->belongsTo(DataDevice::class);
    }
    public function sensorBmp(){
        return $this->belongsTo(SensorBmp::class, 'device_id','device_id');
    }
    public function sensorThigrow(){
        return $this->belongsTo(SensorThigrow::class, 'device_id','device_id');
    }
    public function sensorThm30d(){
        return $this->belongsTo(SensorThm30::class, 'device_id','device_id');
    }
    
}
