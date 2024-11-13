<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SensorThm30 extends Model
{
    use HasFactory;
    protected $table ='db_sensor_thm30d';

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
