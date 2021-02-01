<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Session;
// use Illuminate\Support\Facades\Redirect;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // public function AuthLogin(){
    //     $admin_id = Session::get('admin_id');
    //     // var_dump($admin_id);      
    //     if($admin_id){
    //         return Redirect('admin/dashboard');
    //     }
    //     else{
    //         return Redirect('admin/login')->send();
    //     }
    // }
}
