@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Loại sản phẩm</a></li>
		  	<li class="active">Danh sách</li>
		</ol>
	</div>
	<div class="row">
		<div class="form-group col-sm-3">
			<select name="categoryselect" id="categoryselect" class="custom-select form-control">
				<option value="">--Chọn danh mục--</option>
                @foreach($categories as $key => $category)
                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                @endforeach
			</select>
		</div>
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
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý loại sản phẩm <a href="#" class="pull-right js_add_item" ><i class="fa fa-plus-circle"></i></a></h2>
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
						<th style="text-align: left;">Tên loại sản phẩm</th>
						<th style="text-align: left;">Mô tả</th>
						<th style="text-align: left;">Trạng thái</th>
						<th style="width: 115px;text-align: left;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $item)
					<tr>
						<td>{{$item->catetory_id}}</td>
						
						<td>
							{{ $item->catetory_name }}
						</td>
						<td>
							{{$item->catetory_desc}}
						</td>
						<td style="padding-top: 22px;">
							@if($item->catetory_status == 1)
							<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/catetory/change-status/{{$item->catetory_id}}" data-id="{{$item->catetory_status}}"><span>Hiển thị</span></a>
							@else
							<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/catetory/change-status/{{$item->catetory_id}}" data-id="{{$item->catetory_status}}"><span>Ẩn</span></a>
							@endif
						</td>
						<td style="padding-top: 22px;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/catetory/edit/{{$item->catetory_id}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/catetory/delete/{{$item->catetory_id}}"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
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
						<input type="hidden" class="form-control" name="catetory_id" id="catetory_id" value="">
						<div class="form-group">
							<label for="category_catetory_id">Danh mục sản phẩm:</label>
							<select name="category_catetory_id" id="category_catetory_id" class="custom-select form-control">
								<option value="">--Chọn danh mục--</option>
								@foreach($categories as $key => $category)
								<option value="{{$category->category_id}}">{{$category->category_name}}</option>
								@endforeach
							</select>
							<label class="error errorcate" for="category_catetory_id" style="display: none;"></label>
						</div>
						<div class="form-group">
							<label for="catetory_name">Tên loại:</label>
							<input type="text" class="form-control" id="catetory_name" placeholder="Tên loại sản phẩm" name="catetory_name" value="">
							<label class="error errorname" for="catetory_name" style="display: none;"></label>
						</div>
						<div class="form-group">
							<label for="catetory_desc">Mô tả:</label>
							<textarea name="catetory_desc" id="catetory_desc" class="form-control" rows="3" placeholder="Mô tả ngắn gọn"></textarea>
							<label class="error errordesc" for="catetory_desc" style="display: none;"></label>
						</div>
						<div class="form-group">
							<label for="catetory_status">Hiển thị</label>
							<select name="catetory_status" class="form-control custom-select" id="catetory_status">
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
<script src="{{asset('adminpages/ajaxController/Quanlycatetory_ajax.js')}}"></script>
@endpush
@stop