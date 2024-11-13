<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SensorIna219 extends Model
{
    use HasFactory;

    protected $table = 'db_sensor_ina219';
    protected $primary = 'id';
    protected $fillable = ['device_token','tegangan','arus','daya'];
    
    public $timestamps = true;

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:m:s');
    }
}
