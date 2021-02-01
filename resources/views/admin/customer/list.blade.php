@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Khách hàng</a></li>
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
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý phiếu giảm giá <a href="/admin/product/create" class="pull-right js_add_item"><i class="fa fa-plus-circle"></i></a></h2>
		<div id="reder_data">
			@if(Session::has('message'))
		        <div class="alert alert-success" id="aler_success">
		            {!! Session::get('message') !!}
		        </div>
		        <?php session::put('message', null); ?>
		    @endif
		    <table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên khách hàng</th>
						<th>Địa chỉ</th>
						<th>Email</th>
						<th>Số điện thoại</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $key=>$item)
					<tr>
						<td>{{$item->customer_id}}</td>
						<td>
							{{$item->customer_name}}
						</td>
						<td style="text-align: center;">{{$item->customer_address}}</td>
						<td style="text-align: center;">{{$item->customer_email}}</td>
						<td>
							{{$item->customer_phone}}
						</td>	
						<td style="text-align: center;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/customer/edit/{{$item->customer_id}}" class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/customer/delete/{{$item->customer_id}}" class="styling-delete" ><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
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
						<input type="hidden" class="form-control" name="customer_id" id="customer_id" value="">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-5" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
									<label for="customer_name">Họ và tên:</label>
									<input type="text" class="form-control" id="customer_name" placeholder="Nhập họ và tên....." name="customer_name">
									<label class="error errorcustomer_name" for="customer_name" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="customer_email">Email:</label>
									<input type="text" class="form-control" id="customer_email" placeholder="Nhập email của bạn....." name="customer_email">
									<label class="error errorcustomer_email" for="customer_email" style="display: none;"></label>
								</div>

								<button type="submit" class="btn btn-primary" id="submit-form">Save</button>	
							</div>
							<div class="col-sm-5" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group">
									<label for="customer_phone">Số điện thoại:</label>
									<input type="text" class="form-control" id="customer_phone" placeholder="Nhập số điện thoại....." name="customer_phone">
									<label class="error errorcustomer_phone" for="customer_phone" style="display: none;"></label>
								</div>
								<div class="form-group">
			                        <label for="customer_address">Địa chỉ:</label>
									<textarea name="customer_address" id="customer_address" class="form-control" cols="30" rows="3" placeholder="Nội dung về sản phẩm...."></textarea>
			                        <label class="error errorcustomer_address" for="customer_address" style="display: none;"></label>
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
<script src="{{asset('adminpages/ajaxController/Quanlycustomer_ajax.js')}}"></script>
@endpush
@stop