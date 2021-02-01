<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Http\Requests\StoreArticleRequest;
use Carbon\Carbon;
use File;
use Session;
session_start();

class BannerController extends Controller
{
    //
    public function list(Request $request)
    {
    	$categories = Category::all();
        $datas = Banner::orderBy('updated_at','DESC')->paginate(6);
        return view('admin.banner.list')->with(['datas'=>$datas,'categories'=>$categories]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        $id = $request->id;
        if($id){
            $datas=Banner::where('category_banner_id',$id)->orderBy('updated_at','DESC');
        }
        else{
            $datas=Banner::orderBy('updated_at','DESC')->get();
        }
        if($name_search != ""){ 
            $datas=$datas->filter(function($item) use ($name_search){
                return false !== stristr($item->banner_desc, $name_search);
            });
        } 
        return view('admin.banner.load')->with('datas',$datas->paginate(6));
    }
    public function store(Request $request){
        $hiddenid = $request->hiddenid;
        if($hiddenid == 0)
        {
            $datas = new Banner();
        }
        else
        {
            $datas = Banner::find($hiddenid);
            $datas->updated_at =  Carbon::now();
        }
        $datas->banner_desc = $request->banner_desc;
        $datas->category_banner_id = $request->category_banner_id;
        $datas->banner_status= $request->banner_status;
        $get_image = $request->file('banner_image');    
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('banner',$new_image);
            $datas->banner_image = $new_image;
        }
        if($datas->save())
        {
            Session::put('message','Thêm thành  thành công');
            return response()->json(['success'=>true,'ms'=>'Thêm  thành công']); 
        }
        else
        {
            return response()->json(['ms'=>'Thêm thất bại']);
        }
    }
    public function edit($id){
        $datas=Banner::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Banner::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
    public function change_status(Request $request,$id){
        $datas = Banner::find($id);
        $status=$request->status;
        if($status == 1){
            $datas->banner_status = 0;
        }
        else{
            $datas->banner_status = 1;
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
