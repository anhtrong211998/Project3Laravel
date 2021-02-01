<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
// use App\Http\Controllers\Auth\LoginController;
use Session;
session_start();

// class Brandcontroller extends LoginController
class Brandcontroller extends Controller
{
    //
    /////////////////////////////////////////////////////////////////////////
    //update
    public function list(Request $request)
    {
        $datas = Brand::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.brand.list')->with(['datas'=>$datas]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        if($name_search != ""){ 
            $datas=Brand::where('brand_name','like','%'.$name_search.'%')->paginate(5);
        }
        else{
            $datas = Brand::orderBy('updated_at','DESC')->paginate(5);
        }
        return view('admin.brand.load')->with('datas',$datas);
    }
    public function store(StoreBrandRequest $request){
        $brand_id = $request->brand_id;
        if($brand_id == "")
        {
            $datas = new Brand();
            $datas->brand_logo = '';
        }
        else
        {
            $datas = Brand::find($brand_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->brand_name = $request->brand_name;
        $datas->brand_status = $request->brand_status;

        $get_image = $request->file('brand_logo');
        // var_dump($get_image);
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('brand',$new_image);
            $datas->brand_logo = $new_image;
        }
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
        $datas=Brand::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Brand::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
    public function change_status(Request $request,$id){
        $datas = Brand::find($id);
        $status=$request->status;
        if($status == 1){
            $datas->brand_status = 0;
        }
        else{
            $datas->brand_status = 1;
        }
        if($datas->save()){
            Session::put('message','Thay đổi trạng thái thành công');
            return response()->json(['success'=>true,'ms'=>'Thay đổi trạng thái thành công']);
        }
        else{
            return response()->json(['ms'=>'Thay đổi trạng thái không thành công']);
        }
    }
}
