<?php

namespace App\Http\Controllers;

use App\Models\SensorIna219;
use Illuminate\Http\Request;

class InsertDataSensor extends Controller
{
    //
    public function insert(){
        SensorIna219::create(['tegangan'=>rand(3.5, 8.5)]);
        sleep(3);

    }
}
