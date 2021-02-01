<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\StoreCustomerRequest;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CustomerController extends Controller
{
    //
    public function list(Request $request)
    {
        $datas = Customer::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.customer.list')->with(['datas'=>$datas]);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        if($name_search != ""){ 
            $datas=Customer::where('customer_name','like','%'.$name_search.'%')->paginate(5);
        }
        else{
            $datas = Customer::orderBy('updated_at','DESC')->paginate(5);
        }
        return view('admin.customer.load')->with('datas',$datas);
    }
    public function store(StoreCustomerRequest $request){
        $customer_id = $request->customer_id;
        if($customer_id == "")
        {
        	$stt = Customer::select('customer_id')->orderBy('created_at','DESC')->first();
            
            // dd($stt);
            if ($stt != ""){
                $stt = substr($stt->customer_id,3)+1;
            }
            else{
                $stt=1;
            }
            $customer_id=strval($stt);
            while(strlen($customer_id) < 4) {$customer_id ="0".$customer_id; }
            $customer_id ="KH.".$customer_id;
            // dd($customer_id);
            $datas = new Customer();
            $datas->customer_id=$customer_id;
        }
        else
        {
            $datas = Customer::find($customer_id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->customer_name = $request->customer_name;
        $datas->customer_email = $request->customer_email;
        $datas->customer_phone = $request->customer_phone;
        $datas->customer_address = $request->customer_address;
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
        $datas=Customer::find($id);
        return response()->json(['datas'=>$datas]);
    }
    public function delete($id){
        $datas = Customer::find($id);
        if($datas->delete()){
            Session::put('message','xóa thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
}
