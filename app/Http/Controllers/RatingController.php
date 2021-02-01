<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\Product;
use App\User;

class RatingController extends Controller
{
    //
    public function submit_comment(Request $request,$product_id){
        // echo 'chay duoc';
        $rating_user_id = get_data_user('web');
        $rates = Rating::where('rating_product_id',$product_id)->where('rating_user_id',$rating_user_id)->first();
        $product = Product::find($product_id);
        if($rates){
        	//get total rating without this rates
        	$product->product_total_rating -=$rates->rating_number;
        	//update rating
        	$rates->rating_number=$request->rating_number;
        	$rates->rating_content=$request->rating_content;
        	$rates->save();
        	//update total rate and total number in product
        	$product->product_total_rating +=$rates->rating_number;
        	// $product->rating_product_total += 1;
        	$product->save();

        	
        }
        else{
        	$rates = new Rating;
        	$rates->rating_product_id=$product_id;
        	$rates->rating_user_id=$rating_user_id;
        	$rates->rating_number=$request->rating_number;
        	$rates->rating_content=$request->rating_content;
        	$rates->save();
        	$product->product_total_rating +=$rates->rating_number;
        	$product->rating_product_total += 1;
        	$product->save();
        }
        return redirect()->back();

    }
}
