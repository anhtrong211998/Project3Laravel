<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Brand;
use App\Cart;
use App\Coupon;
// use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use App\Feeship;
use App\FeeUser;
use App\City;
use App\Order;
use App\Province;
use App\Wards;
use Session;
session_start();

class CheckoutController extends Controller
{
    //
    public function ShareModelOther(){

        $cities=City::all();
        $provinces=Province::all();
        $wards=Wards::all();
        // $brand = Brand::all();
        return view()->share(['cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards]);
    }
    public function show_checkout(){
    	return view('userpages.checkout.show_checkout');
    }
    //update quanty
    public function editCart(Request $request,$id,$quanty){

        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $product = Product::where('product_id',$id)->first();
        if($product->product_quantity >= $quanty){
            $newCart->Update($id,$quanty);
            if(Session::has('session_coupon')){
                $totalprice = $newCart->totalPrice; 
                $coupon =  Session::get('session_coupon')['coupon'];
                if($coupon->coupon_condition == 2){
                    $total_amout = $coupon->coupon_number;
                    if($totalprice < $total_amout){
                        $total_amout = $totalprice;
                    }
                }
                else{
                    $total_amout = ($totalprice*$coupon->coupon_number)/100;
                    // $price_amout = $totalprice - $total_amout;
                }       
                    // $total_amout=Session::get('session_coupon')['total_amout'];
                $price_amout = $totalprice - $total_amout;
                Session::put('session_coupon',['total_amout'=>$total_amout,'price_amout'=>$price_amout,'totalprice'=>$totalprice,'coupon'=>$coupon]);               
            }

                // $request->session()->put('session_coupon',['total_amout'=>$total_amout,'price_amout'=>$price_amout,'totalprice'=>$totalprice]);
            $request->session()->put('Cart',$newCart);
            return response()->json(['success'=>true,'message'=>'Sửa số lượng thành công!']);
        }
        else{
            $quanty=$product->product_quantity;
            $newCart->Update($id,$quanty);
            if(Session::has('session_coupon')){
                $totalprice = $newCart->totalPrice; 
                $coupon =  Session::get('session_coupon')['coupon'];
                if($coupon->coupon_condition == 2){
                    $total_amout = $coupon->coupon_number;
                    if($totalprice < $total_amout){
                        $total_amout = $totalprice;
                    }
                }
                else{
                    $total_amout = ($totalprice*$coupon->coupon_number)/100;
                    // $price_amout = $totalprice - $total_amout;
                }       
                    // $total_amout=Session::get('session_coupon')['total_amout'];
                $price_amout = $totalprice - $total_amout;
                Session::put('session_coupon',['total_amout'=>$total_amout,'price_amout'=>$price_amout,'totalprice'=>$totalprice,'coupon'=>$coupon]);               
            }

                // $request->session()->put('session_coupon',['total_amout'=>$total_amout,'price_amout'=>$price_amout,'totalprice'=>$totalprice]);
            $request->session()->put('Cart',$newCart);
            return response()->json(['success'=>false,'message'=>'Số lượng sản phẩm còn tồn kho '.$product->product_quantity.'!']);
        }   
        // return view('userpages.checkout.load_checkout');
    }
    //delete item
    public function delete_itemcheckoutCart(Request $request, $id){
    	$oldCart = Session('Cart') ? Session('Cart') : null;
    	$newCart = new Cart($oldCart);
    	$newCart->Delete($id);
    	if(Count($newCart->items) > 0){
    		if(Session::has('session_coupon')){
    			$totalprice = $newCart->totalPrice; 
    			$coupon =  Session::get('session_coupon')['coupon'];
    			if($coupon->coupon_condition == 2){
    				$total_amout = $coupon->coupon_number;
    			}
    			else{
    				$total_amout = ($totalprice*$coupon->coupon_number)/100;
    			}
    			$price_amout = $totalprice - $total_amout;
    			Session::put('session_coupon',['total_amout'=>$total_amout,'price_amout'=>$price_amout,'totalprice'=>$totalprice,'coupon'=>$coupon]);               
    		}
    		$request->session()->put('Cart',$newCart);
    	}
    	else{
    		$request->session()->forget('session_coupon');
    		$request->session()->forget('Cart');
    	}
    	// return view('userpages.checkout.load_checkout');
    }
    //coupon
    // public function apply_coupon(Request $request){
    public function apply_coupon($coupon_code){
        // $coupon_code = $request->coupon_code;
        // var_dump($coupon_code)
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        // var_dump($coupon);
        if($coupon){
            if($coupon->coupon_time > 0){
                $detail = Session::get('Cart');
                $totalprice = $detail->totalPrice;
                if($coupon->coupon_condition == 2){
                    $total_amount = $coupon->coupon_number;
                    if($totalprice < $total_amount){
                        $total_amount = $totalprice;
                    }

                    // $price_amout = $totalprice - $total_amount;
                }
                else{
                    $total_amount = ($totalprice*$coupon->coupon_number)/100;
                    // $price_amout = $totalprice - $total_amount;
                }
                $price_amout = $totalprice - $total_amount;
                Session::put('session_coupon',['total_amout'=>$total_amount,'price_amout'=>$price_amout,'totalprice'=>$totalprice,'coupon'=>$coupon]);
                return response()->json(['success'=>true,'total_amount'=>$total_amount,'price_amout'=>$price_amout,'totalprice'=>$totalprice,'message'=>'Giảm giá thành công']);
            }
            else{
                return response()->json(['success'=>false,'message'=>'Mã giảm giá hết hạn']);
            }       
        }
        else{
            return response()->json(['success'=>false,'message'=>'Mã giảm giá không đúng']);
        }
    }
    public function clear_coupon(Request $request){
        $request->session()->forget('session_coupon');
        // return view('userpages.checkout.load_checkout');
    }
    public function cart_payment(Request $request){
        $this->ShareModelOther(); 
        return view('userpages.checkout.cart_payment');
    }
    public function user_cart_payment(Request $request){
        $this->ShareModelOther(); 
        $feeship = FeeUser::where('f_u_user_id',get_data_user('web'))->where('f_u_status','1')->first();
        return view('userpages.checkout.user_cart_payment')->with(['feeship'=>$feeship]);
    }
    public function apply_coupon_payment($coupon_code){
        // $coupon_code = $request->coupon_code;
        // var_dump($coupon_code)
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        // var_dump($coupon);
        if($coupon){
            if($coupon->coupon_time > 0){
                $detail = Session::get('Cart');
                $totalprice = $detail->totalPrice;
                if($coupon->coupon_condition == 2){
                    $total_amount = $coupon->coupon_number;
                    if($totalprice < $total_amount){
                        $total_amount = $totalprice;
                    }
                }
                else{
                    $total_amount = ($totalprice*$coupon->coupon_number)/100;
                    // $price_amout = $totalprice - $total_amount;
                }
                $price_amout = $totalprice - $total_amount;
                // if(Session::has('delivery')){
                //     $fee_ship_delivery=Session::get('delivery')['feeship']->fee_ship;
                //     $price_amout +=$fee_ship_delivery;
                // }
                Session::put('session_coupon',['total_amout'=>$total_amount,'price_amout'=>$price_amout,'totalprice'=>$totalprice,'coupon'=>$coupon]);
                return response()->json(['success'=>true,'total_amount'=>$total_amount,'price_amout'=>$price_amout,'totalprice'=>$totalprice,'message'=>'Giảm giá thành công']);
            }
            else{
                return response()->json(['success'=>false,'message'=>'Mã giảm giá hết hạn']);
            }       
        }
        else{
            return response()->json(['success'=>false,'message'=>'Mã giảm giá không đúng']);
        }
    }
    public function order_view($id){
        $orders = Order::where('order_customer_id',$id)->get();
        return view('userpages.checkout.order_view')->with('orders',$orders);
    }
    public function load_checkout(){
        return view('userpages.checkout.load_checkout');
    }
    public function load_payment_user(){
        $this->ShareModelOther(); 
        $feeship = FeeUser::where('f_u_user_id',get_data_user('web'))->where('f_u_status','1')->first();
    	return view('userpages.checkout.load_payment_user')->with(['feeship'=>$feeship]);
    } 
    public function load_payment(){
        return view('userpages.checkout.load_payment');
    }    
    public function clear_coupon_payment(Request $request){
        $request->session()->forget('session_coupon');
        // return view('userpages.checkout.load_payment');
    }
    public function apply_delevery(Request $request){
        $fee_matp =$request->fee_matp;
        $fee_maquanhuyen =$request->fee_maquanhuyen;
        $fee_maxaphuong =$request->fee_maxaphuong;
        $feeship = Feeship::where('fee_matp',$fee_matp)->where('fee_maquanhuyen',$fee_maquanhuyen)->where('fee_maxaphuong',$fee_maxaphuong)->first();
        if($feeship){
            $fee_ship=$feeship->fee_ship;
             
        }
        else{
            $fee_ship=50000;
            $feeship = new Feeship();
            $feeship->fee_matp=$fee_matp;
            $feeship->fee_maquanhuyen=$fee_maquanhuyen;
            $feeship->fee_maxaphuong=$fee_maxaphuong;
            $feeship->fee_ship=$fee_ship;
        }
        if(Session::has('Cart')){
                $totalprice = Session::get('Cart')->totalPrice;
                if($totalprice >= 250000){
                    $fee_ship = 0;
                    $feeship->fee_ship=$fee_ship;
                }
                $price_amout = $totalprice + $fee_ship;
                
            }
        $request->session()->put('delivery',['feeship'=>$feeship,'price_amout'=>$price_amout,'totalprice'=>$totalprice]);
        return response()->json(['success'=>true,'message'=>'Thêm phí vận chuyển thành công']);
    }
    
}