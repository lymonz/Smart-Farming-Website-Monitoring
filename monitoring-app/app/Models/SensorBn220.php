<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorBn220 extends Model
{
    use HasFactory;
    protected $table = 'db_sensor_beitian220';
    protected $primary = 'id';
    protected $fillable = ['latitude','longitude','hazemod'];
    public function device(){
        return $this->hasMany(DataDevice::class);
    }
}
