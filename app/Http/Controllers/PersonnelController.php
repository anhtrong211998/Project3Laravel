<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personnel;
use App\Http\Requests\StorePersonnelRequest;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class PersonnelController extends Controller
{
    //
    public function list(Request $request)
    {
        $datas = Personnel::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.personnel.list')->with(['datas'=>$datas]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        if($name_search != ""){ 
            $datas=Personnel::where('personnel_name','like','%'.$name_search.'%')->paginate(5);
        }
        else{
            $datas = Personnel::orderBy('updated_at','DESC')->paginate(5);
        }
        return view('admin.personnel.load')->with('datas',$datas);
    }
    public function store(StorePersonnelRequest $request){
        $personnel_id = $request->personnel_id;
        if($personnel_id == "")
        {
            $datas = new Personnel();
        }
        else
        {
            $datas = Personnel::find($personnel_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->personnel_name = $request->personnel_name;
        $datas->personnel_email = $request->personnel_email;
        $datas->personnel_phone = $request->personnel_phone;
        $datas->personnel_position = $request->personnel_position;
        $datas->personnel_birth = $request->personnel_birth;
        $datas->personnel_sex = $request->personnel_sex;
        $datas->personnel_address = $request->personnel_address;
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
        $datas=Personnel::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Personnel::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
}
