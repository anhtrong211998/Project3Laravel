<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use App\Feeship;
use App\FeeUser;
use App\City;
use App\Province;
use App\Wards;
use App\Order;
use App\Order_detail;
use App\Customer;
use App\Product;
use App\Coupon;
use Mail;
use Auth;
use App\User;
use App\Mail\ShoppingMail;
use Session;
session_start();

class PaymentController extends Controller
{
    //
	public function confirm_order1(Request $request){
        if(Session::has('delivery')){
            //get data form ajax/form
            $fee_matp=$request->fee_matp;
            $fee_maquanhuyen=$request->fee_maquanhuyen;
            $fee_maxaphuong=$request->fee_maxaphuong;
            $order_payment_method=$request->order_payment_method;
            // var_dump($order_payment_method);
            $customer_name=$request->customer_name;
            $customer_email=$request->customer_email;
            $customer_phone=$request->customer_phone;
            $customer_address=$request->customer_address;
            //get datetime now
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date("Y-m-d");
            //get last order id to render auto new order id
            $last_order_id=$this->get_oder_id_same_date($date);
            $order_id_auto = $this->auto_Order_id($date,$last_order_id);
            // dd($order_id_auto);
            $order_customer_id=$this->checkCustomer($customer_name,$customer_phone,$customer_email,$customer_address);
            $order_address = $this->render_address_customer_to_order($customer_address,$fee_maxaphuong,$fee_maquanhuyen,$fee_matp);
            $order_fee_ship=Session::get('delivery')['feeship']->fee_ship;
            $order_total_price=Session::get('delivery')['price_amout'];
            $this->confirm_order($order_id_auto, $order_customer_id, $order_address, $order_payment_method, $order_fee_ship,$customer_email);
            $request->session()->forget('delivery');
            return response()->json(['success'=>true,'message'=>'Đặt hàng thành công!','order_customer_id'=>$order_customer_id]);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Vui lòng chọn địa chỉ giao hàng']);
        }
    }
    public function user_confirm_order(Request $request){
        // dd($request->all());
        $order_payment_method=$request->order_payment_method;
        $feeuser = FeeUser::where('f_u_user_id',get_data_user('web'))->where('f_u_status','1')->first();
        $order_address = $feeuser->f_u_address;
        $order_customer_id=get_data_user('web');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date("Y-m-d");
        //get last order id to render auto new order id
        $last_order_id=$this->get_oder_id_same_date($date);
        $order_id_auto = $this->auto_Order_id($date,$last_order_id);
        if($feeuser->f_u_fee_id != 0){
            $order_fee_ship=$feeuser->Feeship->fee_ship;
        }
        else{
            $order_fee_ship=50000;
        }
        $customer_email = Auth::user()->email;
        $this->confirm_order($order_id_auto, $order_customer_id, $order_address, $order_payment_method, $order_fee_ship,$customer_email);
        return redirect()->route('user.checkout.view',$order_customer_id);
    }
    public function auto_Order_id($date,$order_id){
    	$stt =1;
    	if ($order_id != "")
    		{ $stt = substr($order_id,13) + 1; }
    	$order_id=strval($stt);
    	while(strlen($order_id) < 4) {$order_id ="0".$order_id; }
    	$order_id = $date.".HD".$order_id;
        return $order_id;
    }
    public function get_oder_id_same_date($date){
    	$order = Order::whereDate('created_at',$date)->orderBy('created_at','desc')->first();
    	if($order){
    		return $order->order_id;
    	}
    	else{
    		return "";
    	}
    }
    public function checkCustomer($customer_name,$customer_phone,$customer_email,$customer_address){
    	$customer = Customer::where('customer_name',$customer_name)->where('customer_phone',$customer_phone)->where('customer_email',$customer_email)->where('customer_address',$customer_address)->first();
        // dd($customer);
    	if($customer){
    		return $customer->customer_id;
    	}
        else{
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
            $customer = new Customer();
            $customer->customer_id=$customer_id;
            $customer->customer_name=$customer_name;
            $customer->customer_phone=$customer_phone;
            $customer->customer_email=$customer_email;
            $customer->customer_address=$customer_address; 
            $customer->save();
            return $customer->customer_id;
        }
    }
    public function render_address_customer_to_order($customer_address,$fee_maxaphuong,$fee_maquanhuyen,$fee_matp){
        $city_name = City::find($fee_matp)->name;
        $province_name = Province::find($fee_maquanhuyen)->name;
        $wards_name = Wards::find($fee_maxaphuong)->name;
        return $customer_address.','.$wards_name.','.$province_name.','.$city_name;
    }
    public function confirm_order($order_id_auto,$order_customer_id,$order_address,$order_payment_method,$order_fee_ship,$customer_email){
            $order = new Order;
            $order->order_id=$order_id_auto;
            $order->order_customer_id=$order_customer_id;
            // $order->order_address=$this->render_address_customer_to_order($customer_address,$fee_maxaphuong,$fee_maquanhuyen,$fee_matp);
            $order->order_address=$order_address;
            $order->order_payment_method=$order_payment_method;
            //get fee ship and new total price 
            $order->order_fee_ship=$order_fee_ship;
            if(Session::has('Cart')){
                $order->order_total_price=Session::get('Cart')->totalPrice+$order->order_fee_ship;
                //get coupon sale
                if(Session::has('session_coupon')){               
                    $order->order_coupon_sale=Session::get('session_coupon')['total_amout'];               
                }
                else{
                    $order->order_coupon_sale=0;
                }
                $order->order_total_price -= $order->order_coupon_sale;
                //get order_status
                $order->order_status=1;
                $order->save();
                $orders=$order;
                // dd($orders);
                $orderdetails = [];
            
                foreach(Session::get('Cart')->items as $key=>$item){
                    $price = $item['item']['product_price'] - ($item['item']['product_price'] * $item['item']['product_sale'])*0.01;
                    $order_details = new Order_detail;
                    $order_details->order_detail_order_id = $order_id_auto;
                    $order_details->order_detail_product_id = $item['item']['product_id'];
                    $order_details->order_detail_product_name = $item['item']['product_name'];
                    $order_details->order_detail_product_quanty = $item['qty'];
                    $order_details->order_detail_product_price =  $price;
                    $order_details->order_detail_total_price = $item['price'];
                    $order_details->order_detail_image = $item['item']['product_image'];
                    if($order_details->save()){
                        $orderdetails[$key]=$order_details;
                        // var_dump($order_details->order_detail_product_id);
                        $products = Product::find($order_details->order_detail_product_id);
                        $products->product_quantity -= $order_details->order_detail_product_quanty;
                        $products->product_total_pay +=1;
                        $products->save();
                    }    
                }
            }

            if(Session::has('session_coupon')){
                $get_coupon = Session::get('session_coupon')['coupon']->coupon_id;
                $coupons = Coupon::find($get_coupon);
                $coupons->coupon_time -= 1;
                $coupons->save();
            }
            Mail::to($customer_email)->send(new ShoppingMail($orders,$orderdetails));
            Session::forget('Cart');
            Session::forget('session_coupon');
    }
}