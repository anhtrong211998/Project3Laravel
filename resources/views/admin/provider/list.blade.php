@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Nhà cung cấp</a></li>
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
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý nhà cung cấp <a href="#" class="pull-right js_add_item" ><i class="fa fa-plus-circle"></i></a></h2>
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
					<col width="1">
				</colgroup>
				<thead>
					<tr>
						<th style="text-align: left;">#</th>
						<th style="text-align: left;">Tên nhà cung cấp</th>
						<th style="text-align: left;">Địa chỉ</th>
						<th style="text-align: left;">Số điện thoại</th>
						<th style="text-align: left;">Email</th>
						<th style="text-align: left;">Trạng thái</th>
						<th style="width: 115px;text-align: left;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $item)
					<tr>
						<td>{{$item->provider_id}}</td>
						
						<td>
							{!! $item->provider_name !!}
						</td>
						<td>
							{!! $item->provider_address !!}
						</td>
						<td>
							{{$item->provider_email}}
						</td>
						<td>
							{{$item->provider_phone}}
						</td>
						<td style="padding-top: 22px;">
							@if($item->provider_status == 1)
							<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/provider/change-status/{{$item->provider_id}}" data-id="{{$item->provider_status}}"><span>Hiển thị</span></a>
							@else
							<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/provider/change-status/{{$item->provider_id}}" data-id="{{$item->provider_status}}"><span>Ẩn</span></a>
							@endif
						</td>
						<td style="padding-top: 22px;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/provider/edit/{{$item->provider_id}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/provider/delete/{{$item->provider_id}}"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
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
		        	<form action="" method="POST" id="btnSave" enctype="multipart/form-data">
						@csrf
						<input type="hidden" class="form-control" name="provider_id" id="provider_id" value="">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
									<label for="provider_name">Tên nhà cung cấp:</label>
									<input type="text" class="form-control" id="provider_name" placeholder="Tên nhà cung cấp....." name="provider_name">
									<label class="error errorprovider_name" for="provider_name" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="provider_address">Địa chỉ:</label>
									<textarea name="provider_address" id="provider_address" class="form-control provider_address" rows="3" placeholder="Địa chỉ nhà cung cấp...."></textarea>
									<label class="error errorprovider_address" for="provider_address" style="display: none;"></label>
								</div>
								<button type="submit" class="btn btn-primary" id="submit-form">Save</button>
								<button type="button" class="btn btn-primary" id="submit-form-unique" style="display:none;">Save</button>	
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group">
									<label for="provider_email">Email:</label>
									<input type="text" class="form-control" id="provider_email" placeholder="Email....." name="provider_email">
									<label class="error errorprovider_email" for="provider_email" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="provider_phone">Số điện thoại:</label>
									<input type="text" class="form-control" id="provider_phone" placeholder="Nhập số điện thoại....." name="provider_phone">
									<label class="error errorprovider_phone" for="provider_phone" style="display: none;"></label>
								</div>
				                <div class="form-group" id="update_status">
									<label for="provider_status">Trạng thái:</label>
			                        <select id="provider_status" name="provider_status" class="custom-select form-control">
			                            <option value="1">Hiện</option>
			                            <option value="0">Ẩn</option>
			                        </select>
								</div>
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
<script src="{{asset('adminpages/ajaxController/Quanlyprovider_ajax.js')}}"></script>
@endpush
@stop