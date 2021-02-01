<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use File;
use Session;
use App\Http\Requests\AdminUserRequest;
use App\Feeship;
use App\City;
use App\Province;
use App\Wards;
use App\FeeUser;
session_start();

class UserController extends Controller
{
    //
    public function ShareModelOther(){
        $cities=City::all();
        $provinces=Province::all();
        $wards=Wards::all();
        // $brand = Brand::all();
        return view()->share(['cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards]);
    }
    public function list(){
    	$this->ShareModelOther();
        $datas = User::orderBy('updated_at','DESC')->paginate(6);
        return view('admin.user.list')->with('datas',$datas);
    }
    public function Load_Data(Request $request){
        $name_search = $request->name_search;
        if($name_search != ""){
            $datas = User::where('name','like','%'.$name_search.'%')->orderBy('updated_at','DESC')->paginate(6);
        }
        else{
            $datas = User::orderBy('updated_at','DESC')->paginate(6);
        } 
        return view('admin.user.load')->with('datas',$datas);
    }

    public function store(AdminUserRequest $request){
        $user = new User();
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $get_image = $request->file('avatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('article',$new_image);
            $datas->avatar = $new_image;   
        }
        if($user->save()){
            $fee_user = new FeeUser();
            $fee_user->f_u_user_id=$user->id;
            $feeship = Feeship::where('fee_matp',$request->fee_matp)->where('fee_maquanhuyen',$request->fee_maquanhuyen)->where('fee_maxaphuong',$request->fee_maxaphuong)->first();
            if($feeship){
                $fee_user->f_u_fee_id=$feeship->fee_id;
            }
            else{
                $fee_user->f_u_fee_id=0;
            }
            $fee_user->f_u_address=$this->render_address_user($request->f_u_address,$request->fee_maxaphuong,$request->fee_maquanhuyen,$request->fee_matp);
            if($fee_user->save()){
                Session::put('message','Thêm thành công');
                return response()->json(['success'=>true,'ms'=>'Thêm thành công']);
            }
            else{
                return response()->json(['success'=>false,'ms'=>'Thêm địa chỉ giao hàng thất bại']);
            }
        }
        else{
            return response()->json(['success'=>false,'ms'=>'Thêm user thất bại']);
        }
       
    }
    public function render_address_user($f_u_address,$fee_maxaphuong,$fee_maquanhuyen,$fee_matp){
        $city_name = City::find($fee_matp)->name;
        $province_name = Province::find($fee_maquanhuyen)->name;
        $wards_name = Wards::find($fee_maxaphuong)->name;
        return $f_u_address.','.$wards_name.','.$province_name.','.$city_name;
    }
    public function edit($id){
        $datas = User::find($id);
        // dd($user);
        return response()->json(['datas'=>$datas]); 
    }
    public function update(AdminUserRequest $request,$id){
        $user = User::find($id);
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->active=$request->active;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $get_image = $request->file('avatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('article',$new_image);
            $user->avatar = $new_image;   
        }
        if($user->save()){
            Session::put('message','Sửa thành công');
            return response()->json(['success'=>true,'ms'=>'Thêm thành công']);
        }
        else{
            return response()->json(['success'=>false,'ms'=>'Thêm địa chỉ giao hàng thất bại']);
        }
    }
    public function change_status(Request $request,$id){
        $datas = User::find($id);
        $status=$request->status;
        if($status == 1){
            $datas->active = 0;
        }
        else{
            $datas->active = 1;
        }
        if($datas->save()){
            Session::put('message','Thay đổi trạng thái thành công');
            return response()->json(['success'=>true,'ms'=>'Thay đổi trạng thái thành công']);
        }
        else{
            return response()->json(['ms'=>'Thay đổi trạng thái không thành công']);
        }
    }
    public function delete($id){
        $datas = User::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
}
