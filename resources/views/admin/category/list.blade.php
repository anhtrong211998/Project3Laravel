@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Danh mục sản phẩm</a></li>
		  	<li class="active">Danh sách</li>
		</ol>
	</div>
	<div class="row">
		<div class="form-group col-sm-3"></div>
		<div class="form-group col-sm-2"></div>
			
		<div class="col-sm-4" style="float:right;">
			<form class="form-inline" action="" method="GET" style="margin-bottom: 20px;">
				{{csrf_field()}}
				<div class="form-group">
					<input type="text" class="form-control" id="name_search" name="name_search" placeholder="Nhập tên cần tìm...." name="email">
				</div>
				<button type="submit" class="btn btn-default" id="btnSearchSS"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	
	<div class="table-responsive">
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý danh mục sản phẩm <a href="#" class="pull-right js_add_item" ><i class="fa fa-plus-circle"></i></a></h2>
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
				</colgroup>
				<thead>
					<tr>
						<th style="text-align: left;">#</th>
						<td style="text-align: left;">Tên danh mục</td>
						<th style="text-align: left;">Mô tả</th>
						<th style="text-align: left;">Trạng thái</th>
						<th style="width: 115px;text-align: left;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $item)
					<tr>
						<td>{{$item->category_id}}</td>
						
						<td>
							{!! $item->category_name !!}
						</td>
						<td>
							{!! $item->category_desc !!}
						</td>
						<td style="padding-top: 22px;">
							@if($item->category_status == 1)
							<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/category/change-status/{{$item->category_id}}" data-id="{{$item->category_status}}"><span>Hiển thị</span></a>
							@else
							<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/category/change-status/{{$item->category_id}}" data-id="{{$item->category_status}}"><span>Ẩn</span></a>
							@endif
						</td>
						<td style="padding-top: 22px;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/category/edit/{{$item->category_id}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/category/delete/{{$item->category_id}}"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! $datas->render() !!}
		</div>		
	</div>
	<div class="modal fade" id="CreateAndEdit" role="dialog">
    	<div class="modal-dialog">
      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title" style="text-align: center;font-size: 22px;color:#428bca;font-weight: 600;"></h4>
		        </div>
		        <div class="modal-body">
		        	<form action="" method="POST"  enctype="multipart/form-data" id="btnSave">
						@csrf
						<input type="hidden" class="form-control" name="category_id" id="category_id" value="">
						<div class="form-group">
							<label for="category_name">Tên danh mục:</label>
							<input type="text" class="form-control" id="category_name" placeholder="Tên danh mục" name="category_name" value="">
							<label class="error errorname" for="category_name" style="display: none;"></label>
						</div>
						<div class="form-group">
							<label for="category_desc">Mô tả:</label>
							<textarea name="category_desc" id="category_desc" class="form-control" rows="3" placeholder="Mô tả ngắn gọn"></textarea>
							<label class="error errordesc" for="category_desc" style="display: none;"></label>
						</div>
						<div class="form-group">
							<label for="category_status">Hiển thị</label>
							<select name="category_status" class="form-control custom-select" id="category_status">
								<option value="0">Ẩn</option>
								<option value="1">Hiển thị</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Save</button>
					</form>	
		        </div>
		        <div class="modal-footer">
	    			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        </div>
	      	</div>
    	</div>
  	</div>
	
@push('jsmore')
<script src="{{asset('adminpages/ajaxController/Quanlycategory_ajax.js')}}"></script>
@endpush
@stop