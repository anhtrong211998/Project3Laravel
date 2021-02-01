<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Provider;
use Carbon\Carbon;
use App\Http\Requests\StoreProviderRequest;
use Illuminate\Support\Facades\Redirect;
// use App\Http\Controllers\Auth\LoginController;
use Session;
session_start();

class Providercontroller extends Controller
{
    /////////////////////////////////////////////////////////////////////////
    //update
    public function list(Request $request)
    {
        $datas = Provider::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.provider.list')->with(['datas'=>$datas]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        if($name_search != ""){ 
            $datas=Provider::where('provider_name','like','%'.$name_search.'%')->paginate(5);
        }
        else{
            $datas = Provider::orderBy('updated_at','DESC')->paginate(5);
        }
        return view('admin.provider.load')->with('datas',$datas);
    }
    public function store(StoreProviderRequest $request){
        $provider_id = $request->provider_id;
        if($provider_id == "")
        {
            $datas = new Provider();
        }
        else
        {
            $datas = Provider::find($provider_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->provider_name = $request->provider_name;
        $datas->provider_address = $request->provider_address;
        $datas->provider_email = $request->provider_email;
        $datas->provider_phone = $request->provider_phone;
        $datas->provider_status = $request->provider_status;
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
        $datas=Provider::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Provider::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
    public function change_status(Request $request,$id){
        $datas = Provider::find($id);
        $status=$request->status;
        if($status == 1){
            $datas->provider_status = 0;
        }
        else{
            $datas->provider_status = 1;
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
