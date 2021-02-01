@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Tin tức</a></li>
		  	<li class="active">Thêm mới</li>
		</ol>
	</div>	
	<div class="">
		<form action="{{route('admin.article.post.save')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row">	
				<div class="col-sm-7" style="padding: 10px; border: 1px solid #dedede;">
					<div class="form-group">
						<label for="article_name">Tên tin tức:</label>
						<input type="text" class="form-control" id="article_name" placeholder="Tên tin tức" name="article_name">
						@if($errors->has('article_name'))
						<label class="error" for="article_name">{{$errors->first('article_name')}}</label>
						@endif 
					</div>
					
					<div class="form-group">
						<label for="article_content">Nội dung:</label>
						<textarea name="article_content" id="article_content" class="form-control" cols="30" rows="3" placeholder="Nội dung về tin tức...."></textarea>
						@if($errors->has('article_content'))
						<label class="error" for="article_content">{{$errors->first('article_content')}}</label>
						@endif
					</div>					
				</div>
				<div class="col-sm-5" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
					<div class="form-group">
						<label for="article_description">Mô tả:</label>
						<textarea name="article_description" id="article_description" class="form-control" cols="30" rows="3" placeholder="Mô tả ngắn gọn"></textarea>
						@if($errors->has('article_description'))
						<label class="error" for="article_description">{{$errors->first('article_description')}}</label>
						@endif
					</div>
					<div class="form-group">
						<label for="article_title_seo">Meta title:</label>
						<input type="text" class="form-control" id="article_title_seo" placeholder="meta title" name="article_title_seo">
					</div>
					<div class="form-group">
						<label for="article_description_seo">Meta description:</label>
						<input type="text" class="form-control" id="article_description_seo" placeholder="meta description" name="article_description_seo">
					</div>
					<div class="form-group">
	                    <label for="article_avatar">Ảnh minh họa</label>
	                    <input type="file" name="article_avatar" class="form-control" id="article_avatar" placeholder="hình ảnh minh họa của tin tức....">
	                </div>
	                <div class="form-group">
                        <label for="article_active">Hiển thị</label>
                        <select name="article_active" class="form-control custom-select" id="article_active">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-default" style="margin:9px 0;">Refresh</button>
                    <button type="submit" class="btn btn-danger" style="margin:9px 0;">Lưu thông tin</button>
				</div>
			</div>
		</form>
	</div>
@stop
@push('jsmore')
	<script>
	    CKEDITOR.replace('article_content');	        
	</script>
@endpush