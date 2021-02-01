<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Catetory;
use App\Category;
use App\Provider;
use App\Rating;

class GetProductController extends Controller
{
    //
    public function details_product($id){

        $rates = Rating::where('rating_product_id',$id)->get();
        $detail = Product::find($id);
        $samedeltai = Product::where('catetory_product_id',$detail->catetory_product_id)->limit(8)->get();
        return view('userpages.product.product_detail')->with(['sp'=>$detail,'spsame'=>$samedeltai,'rates'=>$rates]);
    }
    public function cate_product($id){
        $detail = Product::where('catetory_product_id',$id)->where('product_status','1')->paginate(8);
        // $samedeltai = Product::where('catetory_product_id',$detail->catetory_product_id)->limit(8)->get();
        return view('userpages.product.product_bycatetory')->with(['lsp'=>$detail]);
    }
    public function brand_product($id){
        $detail = Product::where('brand_product_id',$id)->where('product_status','1')->paginate(8);
        // $samedeltai = Product::where('catetory_product_id',$detail->catetory_product_id)->limit(8)->get();
        return view('userpages.product.product_bycatetory')->with(['lsp'=>$detail]);
    }
}
