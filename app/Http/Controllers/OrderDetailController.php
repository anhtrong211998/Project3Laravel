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

class OrderDetailController extends Controller
{
    //
    public function view($id){

    	$orderdetail = Order_detail::where('order_detail_order_id',$id)->paginate(5);
    	$order = Order::find($id);
    	return view('admin.order.view')->with(['orderdetail'=>$orderdetail,'order'=>$order]);
    }
    public function search(Request $request){
        $id = $request->order_detail_id;
        $name_search = $request->search_name;
        $orderdetail = Order_detail::where('order_detail_order_id',$id)->get();
        // if($name_search != ""){
        //     // $userfee = FeeUser::where('f_u_user_id',$id)->where('')->paginate(5);
        //     $orderdetail = Order_detail::where('order_detail_order_id',$id)->where('f_u_address','like','%'.$name_search.'%')->paginate(5);
        // }
        // else{
        //     $orderdetail = Order_detail::where('order_detail_order_id',$id)->paginate(5);
        // }
        if($name_search != ""){ 
            $datas=$datas->filter(function($item) use ($name_search){
                return false !== stristr($item->Product->product_name, $name_search);
            });
        }
        $order = order::find($id);
        return view('admin.order.view')->with(['orderdetail'=>$orderdetail,'order'=>$order]);
    }
}
