<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\DataDevice;
use App\Models\DataDashboard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SensorBmp extends Model
{
    use HasFactory;

    protected $table='db_sensor_bmp180';
    protected $guarded;

    public function dashboard()
    {
       return $this->hasMany(DataDashboard::class);
    }

    public function device(){
        return $this->hasMany(DataDevice::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:m:s');
    }
}
