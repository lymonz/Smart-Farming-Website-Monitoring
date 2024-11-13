<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index(){
        return view('sesi/index');
    }
    function login(Request $request){
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi'
        ]);

        $infologin= [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        $infologin2= [
            'name'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($infologin)){
            return redirect('home')->with('success',' Berhasil Login');
        } else if(Auth::attempt($infologin2)){
            return redirect('home')->with('success',' Berhasil Login');
        } 
        
        else {
            return redirect('/')->withErrors("Username atau Password yang dimasukkan salah!");
        }
    }
    
    function logout(){
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil Log-out');
    }
}
