<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use File;
use App\Http\Requests\AdminUserRequest;
use App\Feeship;
use App\City;
use App\Province;
use App\Wards;
use App\Order;
use App\Order_detail;
use App\Customer;
use App\Product;
use App\Coupon;
use Mail;
use App\User;
use App\Mail\ShoppingMail;
use Session;
session_start();

class OrderController extends Controller
{
    //
    public function ShareModelOther(){
        $cities=City::all();
        $provinces=Province::all();
        $wards=Wards::all();
        // $brand = Brand::all();
        return view()->share(['cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards]);
    }
    public function list_default(){
    	// $this->ShareModelOther();
        $datas = Order::where('order_status','1')->orderBy('updated_at','DESC')->paginate(6);
        return view('admin.order.list_default')->with('datas',$datas);
    }
    public function list_info(){
        // $this->ShareModelOther();
        $datas = Order::where('order_status','2')->orderBy('updated_at','DESC')->paginate(6);
        return view('admin.order.list_info')->with('datas',$datas);
    }
    public function list_warning(){
        // $this->ShareModelOther();
        $datas = Order::where('order_status','2')->orderBy('updated_at','DESC')->paginate(6);
        return view('admin.order.list_warning')->with('datas',$datas);
    }
    public function list_success(){
        // $this->ShareModelOther();
        $datas = Order::where('order_status','2')->orderBy('updated_at','DESC')->paginate(6);
        return view('admin.order.list_success')->with('datas',$datas);
    }
    public function list_danger(){
        // $this->ShareModelOther();
        $datas = Order::where('order_status','2')->orderBy('updated_at','DESC')->paginate(6);
        return view('admin.order.list_danger')->with('datas',$datas);
    }
    public function Load_Data(Request $request){
        $name_search = $request->name_search;
        $status = $request->status;

        if($name_search != ""){
            $datas = Order::where('order_status',$status)->where('order_address','like','%'.$name_search.'%')->orderBy('updated_at','DESC')->paginate(6);
        }
        else{
            $datas = Order::where('order_status',$status)->orderBy('updated_at','DESC')->paginate(6);
        } 
        // dd($datas);
        return view('admin.order.load')->with('datas',$datas);
    }
    public function change_status(Request $request,$id){
        $datas = Order::find($id);
        $status = $request->status;
        $datas->order_status=$status;
        if($datas->save()){
            if($datas->order_status==5){
                $Order_detail = Order_detail::where('order_detail_order_id',$datas->order_id)->get();
                foreach($Order_detail as $key=>$item){
                    $pro = Product::find($item->order_detail_product_id);
                    $pro->product_quantity +=$item->order_detail_product_quanty;
                    $pro->save();
                }
            }
            Session::put('message','Thay đổi trạng thái thành công');
            return response()->json(['success'=>true,'ms'=>'Thay đổi trạng thái thành công','status'=>$status]);
        }
        else{
            return response()->json(['ms'=>'Thay đổi trạng thái không thành công']);
        }
    }
}
