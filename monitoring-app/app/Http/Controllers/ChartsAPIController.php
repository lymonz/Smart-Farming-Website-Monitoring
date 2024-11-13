<?php

namespace App\Http\Controllers;

use App\Models\SensorIna219;
use Illuminate\Http\Request;

class ChartsAPIController extends Controller
{
    public function updateChart(){
        $dataTg = SensorIna219::latest()->limit(10)->get()->sortBy('id');
        $label = $dataTg->pluck('created_at->format("Y-m-d H:i:s")');
        $data = $dataTg->pluck('tegangan');
        $data2 = $dataTg->pluck('arus');
        

        return response()->json(compact(['label','data','data2']));
    }
}
