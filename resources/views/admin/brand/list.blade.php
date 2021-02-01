@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Nhãn hiệu</a></li>
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
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý nhãn hiệu<a href="#" class="pull-right js_add_item" ><i class="fa fa-plus-circle"></i></a></h2>
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
						<th style="text-align: left;">Tên nhãn hiệu</th>
						<th style="text-align: left;">Logo</th>
						<th style="text-align: left;">Trạng thái</th>
						<th style="width: 115px;text-align: left;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $item)
					<tr>
						<td>{{$item->brand_id}}</td>
						
						<td>
							{!! $item->brand_name !!}
						</td>
						<td>
							@if($item->brand_logo)
							<img src="/brand/{{$item->brand_logo}}" alt="" style="width: 150px;height: 60px;">
							@else
							<img src="/article/images_default.png" alt="" style="width: 150px;height: 60px;" >
							@endif
						</td>
						<td style="padding-top: 22px;">
							@if($item->brand_status == 1)
							<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/brand/change-status/{{$item->brand_id}}" data-id="{{$item->brand_status}}"><span>Hiển thị</span></a>
							@else
							<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/brand/change-status/{{$item->brand_id}}" data-id="{{$item->brand_status}}"><span>Ẩn</span></a>
							@endif
						</td>
						<td style="padding-top: 22px;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/brand/edit/{{$item->brand_id}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/brand/delete/{{$item->brand_id}}"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! $datas->render() !!}
		</div>		
	</div>
	<div class="modal fade" id="CreateAndEdit" role="dialog">
    	<div class="modal-dialog modal-lg">
      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title" style="text-align: center;font-size: 22px;color:#428bca;font-weight: 600;"></h4>
		        </div>
		        <div class="modal-body">
		        	<form action="" method="POST"  enctype="multipart/form-data" id="btnSave">
						@csrf
						<div class="row">
							<input type="hidden" class="form-control" name="brand_id" id="brand_id" value="">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
									<label for="brand_name">Tên nhãn hiệu:</label>
									<input type="text" class="form-control" id="brand_name" placeholder="Tên nhãn hiệu...." name="brand_name" value="">
									<label class="error errorbrand_name" for="brand_name" style="display: none;"></label>
								</div>
				                <div class="form-group">
			                        <label for="brand_status">Hiển thị</label>
			                        <select name="brand_status" class="form-control custom-select" id="brand_status">
			                            <option value="0">Ẩn</option>
			                            <option value="1">Hiển thị</option>
			                        </select>
			                    </div>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group">
									<img src="/article/images_default.png" alt="" style="width: 100%;height: 117px;" id="output_img">
								</div>
								<div class="form-group">
				                    <label for="brand_logo">Hình ảnh</label>
				                    <input type="file" name="brand_logo" class="form-control" id="brand_logo" placeholder="Logo ....">
				                </div>
				                
				                <input type="hidden" class="form-control" name="hidID" id="hidID" value="0">
							</div>
							<div class="col-sm-1"></div>
						</div>
					</form>	
		        </div>
		        <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        </div>
	      	</div>
    	</div>
  	</div>
	
@push('jsmore')
<script>
	function readURL(input) {
		if(input.files && input.files[0]) {
	    	var reader = new FileReader();
	    	reader.onload = function(e) {
			$('#output_img').attr('src', e.target.result);
			}	
	    	reader.readAsDataURL(input.files[0]); // convert to base64 string
	  	}
	}
	$("#brand_logo").change(function(){
			readURL(this);
	});
</script>
<script src="{{asset('adminpages/ajaxController/Quanlybrand_ajax.js')}}"></script>
@endpush
@stop