<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Http\Requests\StoreCouponRequest;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    //////////////////////////////////////////////////////////////////////////////////
    //update
    public function list(Request $request)
    {
        $datas = Coupon::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.coupon.list')->with(['datas'=>$datas]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        if($name_search != ""){ 
            $datas=Coupon::where('coupon_name','like','%'.$name_search.'%')->paginate(5);
        }
        else{
            $datas = Coupon::orderBy('updated_at','DESC')->paginate(5);
        }
        return view('admin.coupon.load')->with('datas',$datas);
    }
    public function store(StoreCouponRequest $request){
        $coupon_id = $request->coupon_id;
        if($coupon_id == "")
        {
            $datas = new Coupon();
        }
        else
        {
            $datas = Coupon::find($coupon_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->coupon_name = $request->coupon_name;
        $datas->coupon_code = $request->coupon_code;
        $datas->coupon_time = $request->coupon_time;
        $datas->coupon_condition = $request->coupon_condition;
        $datas->coupon_number = $request->coupon_number;
        if($datas->save())
        {
            Session::put('message','Thực hiện thành  thành công');
            return response()->json(['success'=>true,'ms'=>'Thực hiện  thành công']); 
        }
        else
        {
            return response()->json(['ms'=>'Thực hiện thất bại']);
        }
    }
    public function edit($id){
        $datas=Coupon::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Coupon::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
}
