<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Brand;
use App\Catetory;
use App\Category;
use App\Provider;
use App\Contact;
use App\Banner;
use Carbon\Carbon;
use App\Article;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Support\Facades\Redirect;
use Mail;
use App\Order;
use App\Mail\ContactMail;
use Session;
session_start();

class Homecontroller extends Controller
{
    //
    public function shareMoredatas(){
        $catetory=Catetory::where('catetory_status','1')->get();
        $category=Category::where('category_status','1')->get();
        return view()->share(['catetory'=>$catetory,'category'=>$category]);
    }
    public function saleproduct(){
    	$spsale=Product::where('product_sale','>','0')->where('product_status','1')->limit(6)->get();
    	return view()->share('spsale',$spsale);
    }
    public function newproduct(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date=date("Y-m-d H:i:s");
        // $date = now();
        $last_month = date("Y-m-d H:i:s",strtotime('-2 month'));
        $spnew = Product::whereBetween('created_at',[$last_month,$date])->limit(6)->where('product_status','1')->get();
    	return view()->share('spnew',$spnew);
    }
	public function index(){
        $this->newproduct();
        $this->saleproduct();
		$sp = Product::where('product_status','1')->where('product_total_pay','>','0')->orderBy('product_total_pay','DESC')->limit(8)->get();
        $banner = Banner::get();
        $bran_array=array();
		foreach($sp as $spbran){
            $bran = Brand::where('brand_id', $spbran->brand_product_id)->first();
            if(!array_key_exists($spbran->brand_product_id, $bran_array)){
                $bran_array[$spbran->brand_product_id]=array('brand_id'=>$bran->brand_id,'brand_logo'=>$bran->brand_logo);
            }
            

		}
		// return view('userpages.home.index')->with(['item'=>$sp]);
        return view('userpages.home.index')->with(['item'=>$sp,'bran_array'=>$bran_array,'banner'=>$banner]);
	}
    public function about(){
        return view('userpages.home.about');
    }
    public function faqs(){
        return view('userpages.home.faqs');
    }
    public function blog(){
        return view('userpages.home.blog');
    }
    public function blog_posts_table_view(){
        return view('userpages.home.blog_posts_table_view');
    }
    public function blog_single_post(){
        return view('userpages.home.blog_single_post');
    }
    public function contact_us(){
        return view('userpages.home.contact_us');
    }
    public function submit_contact_us(StoreContactRequest $request){
        $datas = $request->all();
        $contact = new Contact;
        $contact->contact_name=$datas['contact_name'];
        $contact->contact_title=$datas['contact_title'];
        $contact->contact_content=$datas['contact_content'];
        $contact->contact_email=$datas['contact_name'];
        $contact->contact_company=$datas['contact_company'];
        $contact->contact_phone=$datas['contact_phone'];
        $contact->contact_address=$datas['contact_address'];
        $contact->save();
        Mail::to('nhokanhnhok211998@gmail.com')->send(new ContactMail($datas));
        Session::put('message','Gửi liên hệ thành công thành công! Cảm ơn sự phản hồi của bạn.');
        return redirect()->back();
    }
    public function sitemap(){
        return view('userpages.home.sitemap');
    }
    public function terms(){
        return view('userpages.home.terms');
    }
    public function policies(){
        return view('userpages.home.policies');
    }
    public function name_product(Request $request,$name_search){
        // $name_search=$request->name_search;
        $detail=Product::where('product_name','like','%'.$name_search.'%')->where('product_status','1')->paginate(1);
        return view('userpages.product.product_bycatetory')->with(['lsp'=>$detail]);
    }
    
    public function get_aticale(){
        $this->shareMoredatas();
        $datas = Article::select('article_id','article_name','article_description','article_avatar','article_active','updated_at')->where('article_active','1')->orderBy('updated_at','DESC')->paginate(5);
        return view('userpages.home.articale')->with('datas',$datas);
    }
    public function articale_detail($id){
        $this->shareMoredatas();
        $item = Article::find($id);
        $datas = Article::select('article_id','article_name','article_avatar','article_active','updated_at')->where('article_active','1')->orderBy('updated_at','DESC')->limit(4)->get();
        // dd($datas);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date=date("Y-m-d H:i:s");
        // $date = now();
        $last_month = date("Y-m-d H:i:s",strtotime('-2 month'));
        $spnew = Product::whereBetween('created_at',[$last_month,$date])->limit(4)->where('product_status','1')->get();
        return view('userpages.home.article_detail')->with(['item'=>$item,'datas'=>$datas,'spnew'=>$spnew]);
    }
    
}