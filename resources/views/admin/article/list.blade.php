@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Tin tức</a></li>
		  	<li class="active">Danh sách</li>
		</ol>
	</div>
	<div class="row">
		<div class="form-group col-sm-2"></div>
		<div class="form-group col-sm-3"></div>
			
		<div class="col-sm-4" style="float:right;">
			<form class="form-inline" action="" style="margin-bottom: 20px;">
				{{csrf_field()}}
				<div class="form-group">
					<input type="text" class="form-control" id="name_search" name="name_search" placeholder="Nhập tên cần tìm...." name="email">
				</div>
				<button type="submit" class="btn btn-default" id="btnSearchSS"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	
	<div class="table-responsive">
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý tin tức <a href="{{route('admin.article.get.create')}}" class="pull-right"><i class="fa fa-plus-circle"></i></a></h2>
		<div id="reder_data">
			@if(Session::has('message'))
		        <div class="alert alert-success" id="aler_success">
		            {!! Session::get('message') !!}
		        </div>
		        <?php session::put('message', null); ?>
		    @endif
			<table class="table table-striped">
				<colgroup>
					<col width="1">
					<col width="1">
					<col width="1">
					<col width="1">
					<col width="1">
					<col width="1">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Tên tin tức</th>
						<th>Mô tả</th>
						<th>Hình ảnh</th>
						<th>Trạng thái</th>
						<th style="width: 115px;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $item)
					<tr>
						<td>{{$item->article_id}}</td>
						<td>
							{{$item->article_name}}
						</td>
						
						<td>
							{!! $item->article_description !!}
						</td>
						<td>
							@if($item->article_avatar)
							<img src="/article/{{$item->article_avatar}}" alt="" style="width: 70px;height: 60px;">
							@else
							<img src="/article/images_default.png" alt="" style="width: 70px;height: 60px;">
							@endif
						</td>
						<td style="padding-top: 22px;">
							@if($item->article_active == 1)
							<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/article/change-status/{{$item->article_id}}" data-id="{{$item->article_active}}"><span>Hiển thị</span></a>
							@else
							<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/article/change-status/{{$item->article_id}}" data-id="{{$item->article_active}}"><span>Ẩn</span></a>
							@endif
						</td>
						<td style="padding-top: 22px;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="{{route('admin.article.get.edit',$item->article_id)}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/article/delete/{{$item->article_id}}"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! $datas->render() !!}
		</div>
		
	</div>
	
	
@push('jsmore')
	<script src="{{asset('adminpages/ajaxController/Quanlyarticle_ajax.js')}}"></script>
@endpush
@stop