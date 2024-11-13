<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\DataDevice;
use Illuminate\Http\Request;
use App\Models\DataDashboard;
use App\Models\SensorIna219;
use App\Models\SensorThigrow;
use Illuminate\Support\Facades\Auth;

class HalamanController extends Controller
{

    public function home(){
        $dataDevice = DataDevice::all()->count();
        $dataUser = DataUser::all()->count();
        return view('home', compact(['dataDevice', 'dataUser']));
    }

    // public function device(){
    //     $dataDevice = DataDevice::all();
    //     return view('device/home', compact(['dataDevice']));
    // }

    // public function dashboard(){
    //     $dataDevice = DataDevice::all();
    //     return view('dashboardMonitoring/home', compact(['dataDevice']));
    // }

    
    // public function getKode($id){
    //     $device = DataDevice::with('sensorThigrow')->where('id', $id)->select('id','kode_device','nama_device')->get();

    //     $sensorThigrow = SensorThigrow::select('device_id', 'temperature', 'kelembaban_tanah','pH','created_at')->where('device_id', $id)->latest()->limit(10)->orderBy('created_at','asc')->get();
    //     // if($sensorThigrow==null){
    //     //     return response()->json([
    //     //         'message'=>'Empty Data!'
    //     //     ]);
    //     // }
    //     return response()->json(['device'=>$device, 'sensorThigrow'=>$sensorThigrow]);
    // }
    // public function thigrow(){
    //     $dataDevice = DataDevice::with('sensorThigrow')->select('id', 'kode_device','nama_device')->limit(4)->get();
    //     // $sensorThigrow = SensorThigrow::select('device_id', 'temperature', 'kelembaban_tanah','pH','created_at')->where('device_id', $dataDevice['id'])->latest()->limit(10)->get();
    //     // dd($dataDevice);
    //     return view('dashboardMonitoring/thigrow', compact(['dataDevice']));
    // }

    // public function ina219(){
    //     $dataDevice = DataDevice::where('id',5)->select('id','nama_device', 'kode_device')->get();
    //     // dd($dataDevice);
    //     return view('/dashboardMonitoring/ina219', compact(['dataDevice']));
    // }

    // public function getDevice(){

    // }
    
    // public function battery(){

    //     $dataTg = SensorIna219::latest()->limit(10)->get();
    //     foreach($dataTg as $item){
    //         $data['label'][]= $item->created_at->format('Y-m-d H:i:s');
    //         $data['data1'][]=(double)$item->tegangan;
    //         $data['data2'][]=(double)$item->arus;
    //     }
    //     $dataTg = json_encode($data);
    //     // dd($dataTg);
    //     // dd($dataTg);
    //     return view('battery/home', compact(['dataTg']));
    // }


    // public function pengguna(){

    //     $data=DataUser::all();
    //     return view('pengguna/pengguna', compact(['data']));
    // }
    // public function home()
    // {
    //     $data_device=DeviceIot::all();
    //     return view('dashboard/home', compact('data_device'));
    //     // return response()->json(Auth::user());
    // }

    // public function home2()
    // {
    //     $dataDashboard=DataDashboard::all();
    //     return view('dashboardMonitoring/home', compact(['dataDashboard']));
    // }

    // public function monitoring($id){
    //     $dataDashboard = DataDashboard::find($id);
    //     return view('/dashboardMonitoring/monitoring', compact(['dataDashboard']));
    // }
    // // public function monitoring($kode) {
    // //     $data_device=DeviceIot::find($kode);
    // //     return view('/dasboard/monitoring', compact('data_device'));
    // // }
    // public function device()
    // {
    //     $dataDevice = DeviceIot::all();
    //     return view('device/home')->with('data', $dataDevice);
    // }

    // public function tambahDevice()
    // {
    //     $cek = DeviceIot::count();
    //     if ($cek == 0){
    //         $urut = 001;
    //         $urut2= 1;
    //         $nomor = 'DVC-00'.$urut;
    //         $nomor2 = 'IoT Smart Farming '.$urut2;
    //         // dd($nomor);
    //     } else{
    //         // echo 'sasas';
    //         $ambil = DeviceIot::all()->last();
    //         $urut = (int)substr($ambil->kode, -3) +1;
    //         $urut2 = (int)substr($ambil->device, -3)+1;
    //         $nomor = 'DVC-00'.$urut;
    //         $nomor2='IoT Smart Farming '.$urut2;
    //     }
    //     return view('device/tambah_device', compact('nomor', 'nomor2'));
    // }

    // public function simpanDevice(Request $request)
    // {
    //     $request->validate([
    //         'kode' => 'required',
    //         'device' => 'required',
    //         'name' => 'required',
    //         'description' => 'nullable',
    //     ], [
    //         'name.required' => 'Nama Device Tidak Boleh Kosong',
    //     ]);
    //     $data_simpan = [
    //         'kode' => $request->kode,
    //         'device' => $request->device,
    //         'name' => $request->name,
    //         'description' => $request->description,
    //     ];

    //     DeviceIot::create($data_simpan);
    //     return redirect('device')->withSuccess('Berhasil Menambahkan Device');
    // }

    // public function editDevice($id)
    // {
    //     $data_device = DeviceIot::find($id);
    //     // dd($data_device);

    //     return view('device/ubah_device', compact(['data_device']));
    // }

    // public function updateDevice($id, Request $request)
    // {
    //     $data_device = DeviceIot::find($id);
    //     $data_device->update($request->validate([
    //         'kode' => 'required',
    //         'device' => 'required',
    //         'name' => 'required',
    //         'description' => 'nullable',
    //     ]));

    //     return redirect('device')->withSuccess('Berhasil Mengubah Data');
    // }

    // public function destroyDevice($id){
    //     $data_device = DeviceIot::find($id);
    //     $data_device->delete();

    //     $title = 'Delete Device!';
    //     $text = "Are you sure you want to delete?";
    //     confirmDelete($title, $text);
    //     return redirect('device')->withSuccess('Berhasil Menghapus Device');
    // }
    // public function battery()
    // {
    //     return view('dashboard/battery');
    // }
    // public function pengguna()
    // {
    //     $data = DataUsers::all();
    //     return view('pengguna/pengguna')->with('data', $data);
    // }

    // public function sensorTanah()
    // {
    //     return view('dashboard/soilm');
    // }

    // public function sensorUdara()
    // {
    //     return view('dashboard/temp');
    // }

    // public function tambahDashboard(){

    //     $cek = DataDashboard::count();
    //     if($cek == 0){
    //         $urut = 001;
    //         $nomor = 'DSB-00'.$urut;
    //     } else {
    //         $ambil = DataDashboard::all()->last();
    //         $urut = (int)substr($ambil->kode, -3) +1;
    //         $nomor = 'DSB-00'.$urut;
    //     }
    //     $dataDevice=DeviceIot::all();
    //     return view('dashboardMonitoring/tambah', compact(['dataDevice', 'nomor']));
    // }

    // public function simpanDashboard(Request $request)
    // {
    //     $request->validate([
    //         'kode' => 'required',
    //         'device' => 'required',
    //         'name' => 'required',
    //         'description' => 'nullable',
    //     ], [
    //         'name.required' => 'Nama Device Tidak Boleh Kosong',
    //     ]);
    //     $data_simpan = [
    //         'kode_dashboard' => $request->kode,
    //         'device' => $request->device,
    //         'nama_dashboard' => $request->name,
    //         'deskripsi_dashboard' => $request->description,
    //     ];

    //     DataDashboard::create($data_simpan);
    //     return redirect('dashboardMonitoring')->withSuccess('Berhasil Menambahkan Device');
    // }
    // public function editDashboard($id)
    // {
    //     $dataDashboard = DataDashboard::find($id);
    //     // dd($data_device);

    //     return view('dashboardMonitoring/ubah', compact(['dataDashboard']));
    // }


}
