<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feeship;
use App\City;
use App\Province;
use App\Wards;
use App\Http\Requests\StoreFeeshipRequest;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class FeeshipController extends Controller
{
    //
    public function ShareModelOther(){

        $cities=City::all();
        $provinces=Province::all();
        $wards=Wards::all();
        // $brand = Brand::all();
        return view()->share(['cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards]);
    }
    //get ajax province and wards
    public function get_province(Request $request,$matp){
        // $matp = $request->matp;
        if($matp){
            $provinces = Province::where('matp',$matp)->get();
        }
        else{
            $provinces = Province::get();
        }
        // dd($provinces);
        echo "<option value=''>--Chọn quận/huyện</option>";
        foreach($provinces as $key=>$province)
        {
            echo "<option value='".$province->maqh."'>".$province->name."</option>";
        }
    }
    public function get_wards(Request $request,$maqh){
        // $maqh = $request->maqh;
        if($maqh){
            $wards = Wards::where('maqh',$maqh)->get();
        }
        else{
            $wards = Wards::get();
        }
        // var_dump($cate);
        echo "<option value=''>--Chọn xã/phường</option>";
        foreach($wards as $key=>$ward)
        {
            echo "<option value='".$ward->xaid."'>".$ward->name."</option>";
        }
    }
    /////////////////////////////////////////////////////////////////
    //update
    public function list(Request $request)
    {
        $this->ShareModelOther();
        $datas = Feeship::orderBy('updated_at','DESC')->paginate(6);
        return view('admin.feeship.list')->with('datas',$datas);
    }
    public function Load_Data(Request $request){ 
        $id = $request->id;
        if($id){
            $datas=Feeship::where('fee_maxaphuong',$id)->orderBy('updated_at','DESC');
        }
        else{
            $datas=Feeship::orderBy('updated_at','DESC')->get();
        }
        return view('admin.feeship.load')->with('datas',$datas->paginate(6));
    }
    public function store(StoreFeeshipRequest $request){
        $fee_id = $request->fee_id;
        if($fee_id == "")
        {
            $datas = new Feeship();
        }
        else
        {
            $datas = Feeship::find($fee_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->fee_matp = $request->fee_matp;
        $datas->fee_maquanhuyen = $request->fee_maquanhuyen;
        $datas->fee_maxaphuong = $request->fee_maxaphuong;
        $datas->fee_ship = $request->fee_ship;
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
        $datas=Feeship::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Feeship::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
}
