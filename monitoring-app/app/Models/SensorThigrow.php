<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SensorThigrow extends Model
{
    use HasFactory;

    protected $table ='db_sensor_thigrow';

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
    // public function device2(){

    //     return $this->belongsToMany(DataDevice::class, 'db_sensor_thigrow');
    // }
    
    public function getTableColumns() {
        return Schema::getColumnListing((new self())->getTable());
    }
}
