<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use File;
use Session;
use App\Http\Requests\StoreUserRequest;
use App\Feeship;
use App\City;
use App\Province;
use App\Wards;
use App\FeeUser;
session_start();

class FeeUserController extends Controller
{
    //
    public function view($id){

    	$userfee = FeeUser::where('f_u_user_id',$id)->paginate(5);
    	$user = User::find($id);
    	return view('admin.user.view')->with(['userfee'=>$userfee,'user'=>$user]);
    }
    public function search(Request $request){
        $id = $request->user_id;
        $name_search = $request->search_name;
        if($name_search != ""){
            // $userfee = FeeUser::where('f_u_user_id',$id)->where('')->paginate(5);
            $userfee = FeeUser::where('f_u_user_id',$id)->where('f_u_address','like','%'.$name_search.'%')->paginate(5);
        }
        else{
            $userfee = FeeUser::where('f_u_user_id',$id)->paginate(5);
        }
        $user = User::find($id);
        return view('admin.user.view')->with(['userfee'=>$userfee,'user'=>$user]);
    }
    public function edit($id){
    	$datas = FeeUser::find($id);
    	$feeship = Feeship::find($datas->f_u_fee_id);
    	return response()->json(['datas'=>$datas,'feeship'=>$feeship]);
    }
    public function render_address_user($f_u_address,$fee_maxaphuong,$fee_maquanhuyen,$fee_matp){
        $city_name = City::find($fee_matp)->name;
        $province_name = Province::find($fee_maquanhuyen)->name;
        $wards_name = Wards::find($fee_maxaphuong)->name;
        return $f_u_address.','.$wards_name.','.$province_name.','.$city_name;
    }
    public function store(Request $request){
        $hiddenid = $request->hiddenidfee;
        $id = $request->id;
        if($request->f_u_status == 1){
            $this->zero_status($id);
        }
        if($hiddenid == 0)
        {
        	// $this->zero_status($id);
            $datas = new FeeUser();
        }
        else
        {
            $datas = FeeUser::find($hiddenid);
            // if($datas->f_u_status != $request->f_u_status){
            //     $this->zero_status($id);
            // }
            $datas->updated_at =  Carbon::now();
        }
        $datas->f_u_status=$request->f_u_status;
        $datas->f_u_user_id =$id;
        $datas->f_u_address = $this->render_address_user($request->f_u_address_user,$request->fee_maxaphuong_user,$request->fee_maquanhuyen_user,$request->fee_matp_user);
        $feeship = Feeship::where('fee_matp',$request->fee_matp_user)->where('fee_maquanhuyen',$request->fee_maquanhuyen_user)->where('fee_maxaphuong',$request->fee_maxaphuong_user)->first();
        if($feeship){
            $datas->f_u_fee_id=$feeship->fee_id;
        }
        else{
            $datas->f_u_fee_id=0;
        }    
        if($datas->save())
        {
            Session::put('message','Thêm thành  thành công');
            return response()->json(['success'=>true,'ms'=>'Thêm  thành công','id'=>$id]); 
        }
        else
        {
            return response()->json(['ms'=>'Thêm thất bại']);
        }
    }
    public function zero_status($id){
    	$datas = FeeUser::where('f_u_user_id',$id)->where('f_u_status','1')->get();
    	if($datas){
    		foreach($datas as $key=>$item){
    			$item->f_u_status = 0;
    			$item->save();
    		}
    	}
    }
    public function change_status(Request $request,$id){
        $datas = FeeUser::find($id);
        $status=$request->status;
        if($status == 0){
        	$this->zero_status($datas->f_u_user_id);
        	 $datas->f_u_status = 1;
            
        }
        else{
        	$datas->f_u_status = 0;
           
        }

        if($datas->save()){
            Session::put('message','Thay đổi trạng thái thành công');
            return response()->json(['success'=>true,'ms'=>'Thay đổi trạng thái thành công','id'=>$datas->f_u_user_id]);
        }
        else{
            return response()->json(['ms'=>'Thay đổi trạng thái không thành công']);
        }
    }

}
