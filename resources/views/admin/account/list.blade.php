@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Tài khoản</a></li>
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
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý tài khoản <a href="/admin/product/create" class="pull-right js_add_item"><i class="fa fa-plus-circle"></i></a></h2>
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
						<th style="text-align: left;">Email</th>
						<th>Trạng thái</th>
						<th>Quyền</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $key=>$item)
					<tr>
						<td>{{$item->id}}</td>
						<td>
							{{$item->email}}
						</td>
						<td style="text-align: center;">
							@if($item->active == 0)
							<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/account/change-status/{{$item->id}}" data-id="{{$item->active}}"><span>Ẩn</span></a>
							@else
							<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/account/change-status/{{$item->id}}" data-id="{{$item->active}}"><span>Hiển thị</span></a>
							@endif
						</td>
						<td style="text-align: center;">{{$item->role}}</td>	
						<td style="text-align: center;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/account/edit/{{$item->id}}" class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/account/delete/{{$item->id}}" class="styling-delete" ><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
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
						<input type="hidden" class="form-control" name="id" id="id" value="">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
									<label for="email">Email:</label>
									<input type="text" class="form-control" id="email" placeholder="Email...." name="email">
									<!-- <label class="error erroremail" for="email" style="display: none;"></label> -->
								</div>
								<div class="form-group">
									<label for="role">Quyền:</label>
			                        <select id="role" name="role" class="custom-select form-control">
			                            <option value="0">Admin</option>
			                            <option value="1">Nhân viên kho</option>
			                            <option value="2">Nhân viên bán hàng</option>
			                        </select>
								</div>
								<button type="submit" class="btn btn-primary" id="submit-form">Save</button>	
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group">
									<label for="password">Mật khẩu:</label>
									<input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu của bạn...." name="password">
									<!-- <label class="error errorpassword" for="password" style="display: none;"></label> -->
								</div>
								<div class="form-group">
									<label for="re-password">Nhập lại mật khẩu:</label>
									<input type="password" class="form-control" id="re-password" placeholder="Xác nhận lại mật khẩu..." name="re-password">

								</div>
				                <div class="form-group">
									<label for="active">Trạng thái:</label>
			                        <select id="active" name="active" class="custom-select form-control">
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
<script>
	$(document).ready(function(){
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $('#password,#re-password').on('keyup', function (){
	        if ($('#password').val() == $('#re-password').val()) {
	            $('#message').html('Chính xác').css('color', 'green');
	            $('.btn-primary').removeAttr("disabled");
	        } 
	        else{
	            $('#message').html('Không giống').css('color', 'red');
	            $('.btn-primary').attr("disabled", "disabled");
	        }
	    });
	}); 
</script>
<script src="{{asset('adminpages/ajaxController/Quanlyaccount_ajax.js')}}"></script>
@endpush
@stop