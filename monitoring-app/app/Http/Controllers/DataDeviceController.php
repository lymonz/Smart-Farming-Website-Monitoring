<?php

namespace App\Http\Controllers;

use App\Models\DataDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Summary of DataDeviceController
 */
class DataDeviceController extends Controller
{

    public function home(){
        $dataDevice = DataDevice::all();
        return view('device/home', compact(['dataDevice']));
    }
    public function tambah(){
        $dataDevice = DataDevice::latest()->first();
        $kodeDevice = "DVC-";
        
        if($dataDevice==null){
            $nomorUrut = '001';
        } else {
            $nomorUrut = substr($dataDevice->kode_device, 4,3) + 1;
            $nomorUrut = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);
        }
        
        $randomToken = (str::random(16));
        $kode_device = $kodeDevice . $nomorUrut;
        
        return view('device/tambah_device', compact(['kode_device', 'randomToken']));
    }

    public function simpan(Request $request){
        $request->validate([
            'kode' => 'required',
            'token'=> 'required',
            'description' => 'nullable',
            'name' => 'required',
        ], [
            'name.required' => 'Nama Device Tidak Boleh Kosong',
        ]);
            $data_simpan = [
                'token'=> $request->token,
                'kode_device' => $request->kode,
                'nama_device' => $request->name,
                'deskripsi_device' => $request->description,
                ];
        
                DataDevice::create($data_simpan);
                return redirect('device')->withSuccess('Berhasil Menambahkan Device');
    }

    public function edit($id){
        $dataDevice = DataDevice::findOrFail($id);
        
        return view('device/ubah_device', compact(['dataDevice']));
    }

    public function update($id,Request $request){
        $dataDevice = DataDevice::find($id);

        $dataDevice->update($request->validate([
            'kode_device' => 'required',
            'nama_device' => 'required',
            'deskripsi_device' => 'nullable',
        ]));

        return redirect('device')->withSuccess('Berhasil Mengubah Data');
    }
    
    public function destroy($id){
        $dataDevice = DataDevice::findOrFail($id);
        $hasil=$dataDevice->delete();

        if($hasil){
            return redirect('device')->withSuccess('Berhasil Menghapus Device '.$dataDevice->kode_device);
        } else{
            return redirect('device')->withErrors('Gagal Menghapus Device ');

        }
        // return redirect('device')->withSuccess('Berhasil Menghapus Device');
    }
}
