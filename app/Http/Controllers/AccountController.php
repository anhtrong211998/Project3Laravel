<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Admin;
// use App\Http\Requests\StoreBrandRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
// use App\Http\Controllers\Auth\LoginController;
use Session;

class AccountController extends Controller
{
    //
    public function list(Request $request)
    {
        $datas = Admin::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.account.list')->with(['datas'=>$datas]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        if($name_search != ""){ 
            $datas=Admin::where('email','like','%'.$name_search.'%')->paginate(5);
        }
        else{
            $datas = Admin::orderBy('updated_at','DESC')->paginate(5);
        }
        return view('admin.account.load')->with('datas',$datas);
    }
    public function store(Request $request){
        $id = $request->id;
        if($id == "")
        {
            $datas = new Admin();
        }
        else
        {
            $datas = Admin::find($brand_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->email = $request->email;
        $datas->role = $request->role;
        $datas->password=bcrypt($request->password);
        $datas->active=$request->active;
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
        $datas=Admin::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Admin::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
    public function change_status(Request $request,$id){
        $datas = Admin::find($id);
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
}
