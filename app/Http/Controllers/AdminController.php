<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\adminModel;
// use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
// session_start();

class AdminController extends Controller
{
    //
    
    public function loginForm(){
    	return view('admin.admin_login');
    }
    public function show_dashboard(){
        
    	return view('admin.dashboard');
    }
    public function post_login(Request $request){
    	$admin_email = $request->admin_email;
        // var_dump($admin_email);
    	$admin_password=md5($request->admin_password);
        // var_dump($admin_password);
    	// $admin = new adminModel;
    	$result=adminModel::where(['admin_email'=>$admin_email,'admin_password'=>$admin_password])->first();
    	// var_dump($result);
    	if($result){
    		Session::put('admin_name',$result->admin_name);
    		Session::put('admin_id',$result->admin_id);
    		return Redirect('admin/dashboard');
    	}
    	else{
    		Session::put('mgs','Tài khoản hoặc mật khẩu không đúng');
    		return Redirect('admin/login');
    	}
    }
    public function admin_logout(){
    	Session::put('admin_name',null);
    	Session::put('admin_id',null);
    	return Redirect('admin/login');
    }
}
