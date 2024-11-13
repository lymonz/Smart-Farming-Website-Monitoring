<?php

namespace App\Http\Controllers;

use App\Models\DataDashboard;
use App\Models\SensorIna219;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function bacategangan(){
        $bacaSensor = SensorIna219::all()->last();

        return view('battery/bacategangan', compact(['bacaSensor']));
    }
    public function bacaarus(){
        $bacaSensor = SensorIna219::all()->last();

        return view('battery/bacaarus', compact(['bacaSensor']));
    }
    public function bacadaya(){
        $bacaSensor = SensorIna219::all()->last();

        return view('battery/bacadaya', compact(['bacaSensor']));
    }

    // public function simpandata(){

    // }

    public function grafik(){
        
    }
}