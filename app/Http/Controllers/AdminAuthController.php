<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    //
    public function getLogin(){
    	return view('auth.loginAdmin');
    }
    public function postLogin(Request $request){
    	$data = $request->only('email','password');
        // dd($credentials);
        if(\Auth::guard('admins')->attempt($data)){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back();
    	// dd($request->all());
    	// return view('auth.loginAdmin');
    }
    public function getLogout(){
        \Auth::guard('admins')->logout();
        return redirect()->route('admin.login');
    }
}
