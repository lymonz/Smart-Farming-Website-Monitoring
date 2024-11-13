<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\DataUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataUsersController extends Controller
{
    // function index(){
    //     $data = DataUsers::all();
    //     return view('dashboard/home');
    // }
    

    public function home(){
        $data=DataUser::all();
        return view('pengguna/pengguna', compact(['data']));
    }
    public function tambah(){

        return view('pengguna/tambah');
    }

    public function simpan(Request $request){
        $request->validate([
            'usernamex'=>'required',
            'emailx'=>'required',
            'passwords'=>'required',
            'role_id'=>'required',
        ], [
            'usernamex.required'=>'Username User Wajib Di isi',
            'emailx.required'=>'Email Wajib di Isi',
            'passwords.required'=>'Anda Lupa Memasukkan Password',
            'role_id.required'=>'Role Wajib di Isi',
        ]);

        $simpan = [
            'name'=>$request->usernamex,
            'email'=>$request->emailx,
            'password'=>$request->passwords,
            'role'=>$request->role_id,
        ];

        $simpan['password']= Hash::make($simpan['password']);

        DataUser::create($simpan);
        return redirect('pengguna')->withSuccess('Berhasil Menambahkan Pengguna');
    }

    public function edit($id){
        $dataUser = DataUser::findOrFail($id);

        return view('/pengguna/ubah', compact(['dataUser']));
    }
    public function update($id, Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'role'=>'required'
        ]);
        $ubah = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>$request->role,
        ];

        $ubah['password']=Hash::make($ubah['password']);

        $dataUser = DataUser::findOrFail($id)->update($ubah);

        return redirect('pengguna')->withSuccess('Berhasil Mengubah Data Pengguna');
    }
    public function destroy($id){
        $dataUser = DataUser::findOrFail($id);
        $hasil=$dataUser->delete();

        if($hasil){
            return redirect('pengguna')->withSuccess('Berhasil Menghapus Pengguna '.$dataUser->name);
        } else{
            return redirect('pengguna')->withErrors('Gagal Menghapus Pengguna ');

        }
    }
}
