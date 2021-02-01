<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Brand;
use App\Cart;
use App\Feeship;
use Illuminate\Support\Facades\Redirect;
// use App\Http\Controllers\Auth\LoginController;
use Session;
session_start();

class CartController extends Controller
{
    //
    public function addCart(Request $request,$id){
    	$product = Product::where('product_id',$id)->first();
    	if($product != null){
            if($product->product_quantity > 0){
        		$oldCart = Session('Cart') ? Session('Cart') : null;
        		$newCart = new Cart($oldCart);
        		$newCart->Add($product,$id);
        		$request->session()->put('Cart',$newCart);
                return response()->json(['success'=>true,'message'=>'Thêm vào giỏ hàng thành công!']);
            }
            else{
                return response()->json(['success'=>false,'message'=>'Sản phẩm đã hết hàng!']);
            }
    	}

    	// return redirect()->back();
    	// return view('userpages.layout.cart_shopping');
    }
    // //add to cart with quantity > 1
    // public function addCart(Request $request,$id,$quantity){
    //     $product = Product::where('product_id',$id)->first();
    //     if($product != null){
    //         if($product->product_quantity > 0){
    //             if($product->product_quantity >= $quantity){
    //                 $oldCart = Session('Cart') ? Session('Cart') : null;
    //                 $newCart = new Cart($oldCart);
    //                 $newCart->Add($product,$id,$quantity);
    //                 $request->session()->put('Cart',$newCart);
    //                 return response()->json(['success'=>true,'message'=>'Thêm vào giỏ hàng thành công!']);
    //             }
    //             else{
    //                 return response()->json(['success'=>false,'message'=>'Số lượng sản phẩm không đủ!']);
    //             } 
    //         }
    //         else{
    //             return response()->json(['success'=>false,'message'=>'Sản phẩm đã hết hàng!']);
    //         }
              
    //     }
    // }
    public function deleteitemCart(Request $request, $id){
    	$oldCart = Session('Cart') ? Session('Cart') : null;
    	$newCart = new Cart($oldCart);
    	$newCart->Delete($id);
    	if(Count($newCart->items) > 0){
            $totalprice = $newCart->totalPrice;
            if(Session::has('session_coupon')){
                // $totalprice = $newCart->totalPrice; 
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
            if(Session::has('delivery')){
                // $totalprice = $newCart->totalPrice; 
                $feeship =  Session::get('delivery')['feeship'];
                $price_amout_feeship = Session::get('delivery')['price_amout'];
                $price_sub = $price_amout_feeship - $totalprice;
                $price_amout_feeship -= $price_sub;
                if($totalprice < 250000){
                    $getfeeship = Feeship::where('fee_id',$feeship->fee_id)->first();
                    $price_amout_feeship += $getfeeship->fee_ship;
                    $feeship->fee_ship=$getfeeship->fee_ship; 

                }
                Session::put('delivery',['feeship'=>$feeship,'price_amout'=>$price_amout_feeship,'totalprice'=>$totalprice]);               
            }
    		$request->session()->put('Cart',$newCart);
    	}
    	else{
    		$request->session()->forget('session_coupon');
            $request->session()->forget('delivery');
            $request->session()->forget('Cart');
    	}
    	// return view('userpages.layout.cart_shopping');
    }
    public function load_cart(){
        return view('userpages.layout.cart_shopping');
    }
}