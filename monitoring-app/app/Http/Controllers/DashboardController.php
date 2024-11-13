<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SensorBmp;
use App\Models\DataDevice;
use App\Models\SensorBn220;
use App\Models\SensorThm30;
use App\Models\SensorIna219;
use Illuminate\Http\Request;
use App\Models\SensorThigrow;

class DashboardController extends Controller
{
    public function home(){
        $dataDevice = DataDevice::all();
        return view('dashboardMonitoring/home', compact(['dataDevice']));
    }

    public function getKode($token){
        $dvc = DataDevice::where('token', $token)->select('id','token','kode_device','nama_device')->get();

        $thigrow = SensorThigrow::where('device_token', $token)->select('id','device_token','temperature','kelembaban_tanah_th','kelembaban_tanah_sm','battery','i_cahaya','kelembaban_udara','kadar_garam','created_at')->latest()->limit(10)->get();
        
        $bmp180 = SensorBmp::where('device_token', $token)->select('id','device_token','tekanan_udara','tinggi_permukaan','battery','created_at')->latest()->limit(10)->get();//temperature diganti ke tinggi_permukaan
        
        $thm30d = SensorThm30::where('device_token', $token)->select('id','device_token','temperature','kelembaban_udara','battery','created_at')->latest()->limit(10)->get();
        
        $bn220 = SensorBn220::where('device_token', $token)->select('id','device_token','latitude','longitude','battery','created_at')->latest()->get();
        
        $ina219 = SensorIna219::where('device_token', $token)->select('id','device_token','tegangan','arus','daya','created_at')->latest()->limit(10)->get();
        
        // $tegangan = mt_rand(350,800)/100;
        // $arus = mt_rand(5000, 7500)/100;
        // $daya = $tegangan * ($arus/1000);

        // SensorIna219::create([
        //     'device_token'=>'u0748htMt0tQqWft',
        //     'tegangan'=>$tegangan,
        //     'arus'=> $arus,
        //     'daya'=> $daya,
        //     'created_at'=>Carbon::now(),
        //     'updated_at'=>Carbon::now(),

        // ]);
        if(empty($thigrow)&&empty($bn220)&&empty($ina219)&&empty($thm30d)&&empty($bmp180)){
            return response()->json(['dvc'=>$dvc, 'thigrow'=>[], 'bn220'=>[], 'ina219'=>[],'thm30d'=>[],'bmp180'=>[]]);
        }
        
        // return response()->json(['dvc'=>$dvc]);
        return response()->json(['dvc'=>$dvc, 'thigrow'=>$thigrow,'bn220'=>$bn220,'ina219'=> $ina219,'thm30d'=> $thm30d,'bmp180'=>$bmp180]);
    }

    public function thigrow(){
        $dataDevice = DataDevice::all();

        return view('/dashboardMonitoring/thigrow', compact(['dataDevice']));
    }


    public function bmp(){

        $dataDevice = DataDevice::all();

        return view('/dashboardMonitoring/bmp', compact(['dataDevice']));
    }

    public function thm30d(){
        $dataDevice = DataDevice::all();

        return view('/dashboardMonitoring/thm30d', compact(['dataDevice']));
    }

    public function ina219(){
        $dataDevice = DataDevice::all();

        return view('/dashboardMonitoring/ina219', compact(['dataDevice']));
    }
}
