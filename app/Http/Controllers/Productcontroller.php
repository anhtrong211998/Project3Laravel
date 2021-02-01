<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Brand;
use App\Catetory;
use App\Category;
use App\Provider;
use App\Rating;
use Carbon\Carbon;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Redirect;
// use App\Http\Controllers\Auth\LoginController;
use Session;
session_start();

class Productcontroller extends Controller
{
    //for admin
    public function ShareModelOther(){

        $catetory=Catetory::all();
        $category=Category::all();
        $provider=Provider::all();
        $brand = Brand::all();
        return view()->share(['catetory'=>$catetory,'category'=>$category,'provider'=>$provider,'brand'=>$brand]);
    }
    public function get_catetory($categoryID){
        if($categoryID){
            $datas = Catetory::where('category_catetory_id',$categoryID)->get();
        }
        else{
            $datas = Catetory::get();
        }
        echo "<option value=''>--Chọn loại sản phẩm--</option>";
        foreach($datas as $key=>$item)
        {
            echo "<option value='".$item->catetory_id."'>".$item->catetory_name."</option>";
        }
    }
    //end admin
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //update
    public function list(Request $request)
    {
        $this->ShareModelOther();
        $datas = Product::orderBy('updated_at','DESC')->paginate(3);
        return view('admin.product.list')->with('datas',$datas);
    }
    public function Load_Data(Request $request){
        $name_search=$request->name_search;  
        $id = $request->id;
        if($id){
            $datas=Product::where('catetory_product_id',$id)->orderBy('updated_at','DESC')->get();
        }
        else{
            $datas=Product::orderBy('updated_at','DESC')->get();
        }
        if($name_search != ""){ 
            $datas=$datas->filter(function($item) use ($name_search){
                return false !== stristr($item->product_name, $name_search);
            });
        }
        // dd($datas->paginate(3));
        return view('admin.product.load')->with('datas',$datas->paginate(3));
    }
    public function getCreate(){
        $this->ShareModelOther();
        return view('admin.product.create');
    }
    public function edit($id){
        $this->ShareModelOther();
        $data = Product::find($id);
        return view('admin.product.edit')->with('datas',$data);

    }
    public function store(StoreProductRequest $request){
        if($this->InsertOrUpdate($request)){
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect('admin/product/list');
        }
        else{
            return Redirect('admin/product/create');
        }
    }
    public function update(StoreProductRequest $request,$id){
        if($this->InsertOrUpdate($request,$id)){
            Session::put('message','Sửa sản phẩm thành công');
            return Redirect('admin/product/list');
        }
        else{
            return Redirect('admin/product/edit');
        }
    }
    public function InsertOrUpdate($request,$id = ''){
        // $product_id = $request->product_id;
        if($id)
        {
            $datas = Product::find($id);
            $datas->updated_at =  Carbon::now();
            
        }
        else
        {
            $datas = new Product();
            $datas->product_image = '';
        }

        $datas->catetory_product_id = $request->catetory_product_id;
        $datas->product_name = $request->product_name;
        $datas->product_price = $request->product_price;
        $datas->product_sale = $request->product_sale;
        $datas->product_quantity = $request->product_quantity;
        $datas->product_content = $request->product_content;
        $datas->product_status = $request->product_status;
        $datas->product_desc = $request->product_desc;
        $datas->provider_product_id = $request->provider_product_id;
        $datas->brand_product_id = $request->brand_product_id;
        $get_image = $request->file('product_image');    
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('adminpages/images',$new_image);
            $datas->product_image = $new_image;
        }
        $datas->save();
        return true;
    }
    public function change_status(Request $request,$id){
        $datas = Product::find($id);
        $status=$request->status;
        if($status == 1){
            $datas->product_status = 0;
        }
        else{
            $datas->product_status = 1;
        }
        if($datas->save()){
            Session::put('message','Thay đổi trạng thái thành công');
            return response()->json(['success'=>true,'ms'=>'Thay đổi trạng thái thành công']);
        }
        else{
            return response()->json(['ms'=>'Thay đổi trạng thái không thành công']);
        }
    }
    //
    public function delete($id){
        $datas = Product::find($id);
        if($datas->delete()){
            Session::put('message','xóa sản phẩm thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa sản phẩm thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }
    //user pages
    
    
}
