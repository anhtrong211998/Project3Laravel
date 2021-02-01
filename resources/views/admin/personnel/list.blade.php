@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Nhân viên</a></li>
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
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý nhân viên <a href="/admin/product/create" class="pull-right js_add_item"><i class="fa fa-plus-circle"></i></a></h2>
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
					<col width="1">
					<col width="1">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th style="">Tên nhân viên</th>
						<th style="width: 58px;">Giới tính</th>
						<th>Ngày sinh</th>
						<th style="text-align: left;">Email</th>
						<th style="">Số điện thoại</th>
						<th>Chức vụ</th>
						<th>Địa chỉ</th>
						<th style="width: 100px;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $key=>$item)
					<tr>
						<td>{{$item->personnel_id}}</td>
						<td>
							{{$item->personnel_name}}
						</td>
						<td style="text-align: center;">{{$item->personnel_sex}}</td>
						<td style="text-align: center;">{{$item->personnel_birth}}</td>
						<td>
							{{$item->personnel_email}}
						</td>
						<td>
							{{$item->personnel_phone}}
						</td>	
						<td>{{$item->personnel_position}}</td>
						<td>{{$item->personnel_address}}</td>
						<td style="text-align: center;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/personnel/edit/{{$item->personnel_id}}" class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/personnel/delete/{{$item->personnel_id}}" class="styling-delete" ><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
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
						<input type="hidden" class="form-control" name="personnel_id" id="personnel_id" value="">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
									<label for="personnel_name">Họ và tên:</label>
									<input type="text" class="form-control" id="personnel_name" placeholder="Nhập họ và tên....." name="personnel_name">
									<label class="error errorpersonnel_name" for="personnel_name" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="personnel_email">Email:</label>
									<input type="text" class="form-control" id="personnel_email" placeholder="Nhập email....." name="personnel_email">
									<label class="error errorpersonnel_email" for="personnel_email" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="personnel_phone">Số điện thoại:</label>
									<input type="text" class="form-control" id="personnel_phone" placeholder="Nhập số điện thoại....." name="personnel_phone">
									<label class="error errorpersonnel_phone" for="personnel_phone" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="personnel_position">Chức vụ:</label>
									<select name="personnel_position" class="form-control custom-select" id="personnel_position">
			                            <option value="1">Nhân viên kho</option>
			                            <option value="2">Nhân viên bán hàng</option>
			                        </select>
									<label class="error errorpersonnel_position" for="personnel_position" style="display: none;"></label>
								</div>
								<button type="submit" class="btn btn-primary" id="submit-form">Save</button>	
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group">
									<label for="personnel_birth">Ngày sinh:</label>
									<input type="text" class="form-control" id="personnel_birth" placeholder="Nhập ngày sinh....." name="personnel_birth">
									<label class="error errorpersonnel_birth" for="personnel_birth" style="display: none;"></label>
								</div>
								<div class="form-group">
			                        <label for="personnel_sex">Giới tính</label>
			                        <select name="personnel_sex" class="form-control custom-select" id="personnel_sex">
			                            <option value="Nam">Nam</option>
			                            <option value="Nữ">Nữ</option>
			                        </select>
			                    </div>
								<div class="form-group">
			                        <label for="personnel_address">Địa chỉ:</label>
									<textarea name="personnel_address" id="personnel_address" class="form-control" cols="30" rows="3" placeholder="Quê quán...."></textarea>
			                        <label class="error errorpersonnel_address" for="personnel_address" style="display: none;"></label>
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
<script src="{{asset('adminpages/ajaxController/Quanlypersonnel_ajax.js')}}"></script>
@endpush
@stop