<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use Carbon\Carbon;
use App\Http\Requests\StorCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class Categorycontroller extends Controller
{
    /////////////////////////////////////////////////////////////////////////
    //update
    public function list(Request $request)
    {
        // $categories = Category::all();
        $datas = Category::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.category.list')->with(['datas'=>$datas]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        // $id = $request->id;
        if($name_search != ""){ 
            $datas=Category::where('category_name','like','%'.$name_search.'%')->paginate(5);
        }
        else{
            $datas = Category::orderBy('updated_at','DESC')->paginate(5);
        } 
        return view('admin.category.load')->with('datas',$datas);
    }
    public function store(StorCategoryRequest $request){
        // dd($request->all());
        $category_id = $request->category_id;
        if($category_id == "")
        {
            $datas = new Category();
        }
        else
        {
            $datas = Category::find($category_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->category_name = $request->category_name;
        $datas->category_desc = $request->category_desc;
        $datas->category_status= $request->category_status;
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
        $datas=Category::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Category::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
    public function change_status(Request $request,$id){
        $datas = Category::find($id);
        $status=$request->status;
        if($status == 1){
            $datas->category_status = 0;
        }
        else{
            $datas->category_status = 1;
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
