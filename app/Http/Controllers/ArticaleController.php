<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Http\Requests\StoreArticleRequest;
use Carbon\Carbon;
use Session;
session_start();

class ArticaleController extends Controller
{
	//for adimin pages
    public function Load_Data(Request $request){
        $name_search = $request->name_search;
        if($name_search != ""){
            $datas = Article::select('article_id','article_name','article_description','article_avatar','article_active')->where('article_name','like','%'.$name_search.'%')->orderBy('updated_at','DESC')->paginate(5);
        }
        else{
            $datas = Article::select('article_id','article_name','article_description','article_avatar','article_active')->orderBy('updated_at','DESC')->paginate(5);
        } 
        return view('admin.article.load')->with('datas',$datas);
    }
	public function list(Request $request)
    {
        $datas = Article::select('article_id','article_name','article_description','article_avatar','article_active')->orderBy('updated_at','DESC')->paginate(5);
        return view('admin.article.list')->with('datas',$datas);
    }
    public function getCreate(){
        return view('admin.article.create');
    }
    public function store(StoreArticleRequest $request){
        if($this->InsertOrUpdate($request)){
            Session::put('message','Thêm tin tức thành công');
            return Redirect('admin/article/list');
        }
        else{
            return Redirect('admin/article/create');
        }
           
    }
    public function edit($id){
        $data = Article::find($id);
        return view('admin.article.edit')->with('data',$data);

    }
    public function update(StoreArticleRequest $request,$id){
        if($this->InsertOrUpdate($request,$id)){
            Session::put('message','Sửa tin tức thành công');
            return Redirect('admin/article/list');
        }
        else{
            return Redirect('admin/article/edit');
        }
    }
    public function InsertOrUpdate($request,$id = ''){
        $datas = new Article();
        if($id){
            $datas =  Article::find($id);
            $datas->updated_at =  Carbon::now();
        }
        $datas->article_name = $request->article_name;
        $datas->article_slug = Str::slug($request->article_name,'-','vi');
        $datas->article_description = $request->article_description;
        $datas->article_content = $request->article_content;
        $datas->article_active = $request->article_active;
        $datas->article_description_seo = $request->article_description_seo ? $request->article_description_seo : $request->article_description;
        $datas->article_title_seo = $request->article_title_seo ? $request->article_title_seo : $request->article_name;
        $get_image = $request->file('article_avatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('article',$new_image);
            $datas->article_avatar = $new_image;
            
        }     
        $datas->save();
        return true;
        
    }
    
    public function change_status(Request $request,$id){
        $datas = Article::find($id);
        $status=$request->status;
        if($status == 1){
            $datas->article_active = 0;
        }
        else{
            $datas->article_active = 1;
        }
        if($datas->save()){
            Session::put('message','Thay đổi trạng thái thành công');
            return response()->json(['success'=>true,'ms'=>'Thay đổi trạng thái thành công']);
        }
        else{
            return response()->json(['ms'=>'Thay đổi trạng thái không thành công']);
        }
    }
    public function delete_article($id){
        $datas = Article::find($id);
        if($datas->delete()){
            Session::put('message','xóa tin tức thành công');
            return response()->json(['success'=>true,'ms'=>'Xóa tin tức thành công']);
        }
        else{
            return response()->json(['ms'=>'Xóa không thành công']);
        }
    }

    //end admin






    //for userpage
    
}
