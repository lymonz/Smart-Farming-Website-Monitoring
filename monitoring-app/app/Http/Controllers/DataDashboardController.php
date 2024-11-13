<?php

namespace App\Http\Controllers;

use App\Models\DataDevice;
use Illuminate\Http\Request;
use App\Models\DataDashboard;
use App\Models\SensorBmp;
use App\Models\SensorThigrow;

class DataDashboardController extends Controller
{
    public function tambah(){
        $dataDashboard = DataDashboard::latest()->first();
        $kodeDashboard = "DSB-";
        
        if($dataDashboard==null){
            $nomorUrut = '001';
        } else {
            $nomorUrut = substr($dataDashboard->kode_dashboard, 4,3) + 1;
            $nomorUrut = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);
        }

        $kode_dashboard = $kodeDashboard . $nomorUrut;
        $dataDevice = DataDevice::select('id','nama_device')->get();
        return view('dashboardMonitoring/tambah', compact(['dataDevice','kode_dashboard']));
    }

    public function simpan(Request $request){
        $request->validate([
            'kode'=>'required',
            'device_id'=>'required',
            'name'=>'required',
            'description'=>'nullable',

        ], [
            'name.required'=>'Nama Dashboard Tidak Boleh Kosong',
        ]);

        $dataSimpan = [
            'kode_dashboard'=>$request->kode,
            'device_id'=>$request->device_id,
            'nama_dashboard'=>$request->name,
            'deskripsi_dashboard'=>$request->description,
        ];

        DataDashboard::create($dataSimpan);
        return redirect('dashboardMonitoring')->withSuccess('Berhasil Menambahkan Dashboard');
    }

    public function edit($id){
        $dataDashboard = DataDashboard::with('device')->findOrFail($id);
        $dataDevice = DataDevice::select('id', 'nama_device')->get();
        return view('/dashboardMonitoring/ubah', compact(['dataDashboard', 'dataDevice']));
    }

    public function update($id, Request $request){
        $dataDashboard = DataDashboard::with('device')->findOrFail($id);

        $dataDashboard->update($request->validate([
            'kode_dashboard'=>'required',
            'device_id'=>'required',
            'nama_dashboard'=>'required',
            'deskripsi_dashboard'=>'nullable',
        ]));

        return redirect('dashboardMonitoring')->withSuccess('Berhasil Mengubah Data Dashboard');
    }

    public function destroy($id){
        $dataDashboard = DataDashboard::findOrFail($id);
        $dataDashboard->delete();


        return redirect('dashboardMonitoring')->withSuccess('Berhasil Menghapus Data Dashboard');
    }

    public function show($id){
        $dataDashboard = DataDashboard::with(['device','sensorBmp','sensorThigrow','sensorThm30d'])->findOrFail($id);

        
        
        $dataSensor = SensorBmp::select('id','device_id', 'tekanan_udara', 'temperature','created_at')->where('device_id', $dataDashboard->device_id)->latest()->limit(10)->get();
        foreach($dataSensor as $item){
            $data['label'][]= $item->created_at->format('Y-m-d H:i:s');
            $data['data1'][]=(int)$item->tekanan_udara;
            $data['data2'][]=(float)$item->temperature;
        }
        $dataSensor=json_encode($data);

        $dataSensor2=SensorThigrow::select('id', 'device_id', 'temperature','kelembaban_tanah', 'kelembaban_udara','created_at')->where('device_id',$dataDashboard->device_id)->latest()->limit(10)->get();
        foreach($dataSensor2 as $item2){
            $data2['label'][]= $item2->created_at->format('Y-m-d H:i:s');
            $data2['data1'][]=(int)$item2->kelembaban_udara;
            $data2['data2'][]=(int)$item2->kelembaban_tanah;
            $data2['data3'][]=(float)$item2->temperature;
        }
        $dataSensor2=json_encode($data2);
    //   dd($dataSensor2);
        // $dataSensorBmp = SensorBmp::;
        // dd($dataDashboard,$dataSensor);
        // $readDataSensorBmp= SensorBmp::select(['id','device_id','tekanan_udara','temperature'])->where('device_id', $dataDashboard['device_id']);
        // dd($readDataSensorBmp);
        return view('/dashboardMonitoring/monitoring',compact(['dataDashboard','dataSensor','dataSensor2']));
    }

    public function bacaTknBmp(){
        $dataDashboard = DataDashboard::with(['device','sensorBmp']);
        $dataSensor = SensorBmp::all()->last();

        return view('/dashboardMonitoring/readTknBmp', compact(['dataSensor']));
    }
    // public function bacaTknBmp(){
    //     $dataSensor=SensorBmp::with(['device', 'dashboard']);
    //     dd($dataSensor);
    //     return view('/dashboardMonitoring/readTknBmp',compact(['dataSensor']));
    // }


}
