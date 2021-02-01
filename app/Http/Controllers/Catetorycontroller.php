<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Catetory;
use App\Category;
use Carbon\Carbon;
use App\Http\Requests\StoreCatetoryRequest;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Collection;

use Session;
session_start();

class Catetorycontroller extends Controller
{
    /////////////////////////////////////////////////////////////////////////
    //update
    public function list(Request $request)
    {
        $categories = Category::all();
        $datas = Catetory::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.catetory.list')->with(['datas'=>$datas,'categories'=>$categories]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        $id = $request->id;
        if($id){
            $datas=Catetory::where('category_catetory_id',$id)->orderBy('updated_at','DESC');
        }
        else{
            $datas=Catetory::orderBy('updated_at','DESC')->get();
        }
        if($name_search != ""){ 
            $datas=$datas->filter(function($item) use ($name_search){
                return false !== stristr($item->catetory_name, $name_search);
            });
        } 
        return view('admin.catetory.load')->with('datas',$datas->paginate(5));
    }
    public function store(StoreCatetoryRequest $request){
        $catetory_id = $request->catetory_id;
        if($catetory_id == "")
        {
            $datas = new Catetory();
        }
        else
        {
            $datas = Catetory::find($catetory_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->catetory_name = $request->catetory_name;
        $datas->catetory_desc = $request->catetory_desc;
        $datas->catetory_status = $request->catetory_status;
        $datas->category_catetory_id = $request->category_catetory_id;
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
        $datas=Catetory::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Catetory::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
    public function change_status(Request $request,$id){
        $datas = Catetory::find($id);
        $status=$request->status;
        if($status == 1){
            $datas->catetory_status = 0;
        }
        else{
            $datas->catetory_status = 1;
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
