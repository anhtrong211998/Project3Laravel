@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Phiếu giảm giá</a></li>
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
						<th style="text-align: left;">Tên sự kiện</th>
						<th>Mã giảm giá</th>
						<th>Số lượng phiếu</th>
						<th style="text-align: left;">Điều kiện giảm</th>
						<th style="text-align: left;">Giảm giá</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $key=>$item)
					<tr>
						<td>{{$item->coupon_id}}</td>
						<td>
							{{$item->coupon_name}}
						</td>
						<td style="text-align: center;">{{$item->coupon_code}}</td>
						<td style="text-align: center;">{{$item->coupon_time}}</td>
						<td>
							@if($item->coupon_condition==1)
                                giảm theo phần trăm
                            @elseif($item->coupon_condition==2)
                                giảm theo tiền                                      
                            @endif
						</td>
						<td>
							@if($item->coupon_condition==1)
                                giảm {{$item->coupon_number}} %
                            @elseif($item->coupon_condition==2)
                                giảm {{number_format($item->fee_ship).' '.'(đ)'}}
                            @endif
						</td>	
						<td style="text-align: center;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/coupon/edit/{{$item->coupon_id}}" class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/coupon/delete/{{$item->coupon_id}}" class="styling-delete" ><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
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
						<input type="hidden" class="form-control" name="coupon_id" id="coupon_id" value="">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
									<label for="coupon_name">Tên sự kiện:</label>
									<input type="text" class="form-control" id="coupon_name" placeholder="Nhập tên sự kiện....." name="coupon_name">
									<label class="error errorcoupon_name" for="coupon_name" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="coupon_code">Mã giảm giá:</label>
									<input type="text" class="form-control" id="coupon_code" placeholder="Nhập mã sử dụng....." name="coupon_code">
									<label class="error errorcoupon_code" for="coupon_code" style="display: none;"></label>
								</div>

								<button type="submit" class="btn btn-primary" id="submit-form">Save</button>	
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group">
									<label for="coupon_time">Số lượng phiếu:</label>
									<input type="text" class="form-control" id="coupon_time" placeholder="Nhập số lượng phiếu....." name="coupon_time">
									<label class="error errorcoupon_time" for="coupon_time" style="display: none;"></label>
								</div>
								<div class="form-group">
			                        <label for="coupon_condition">Tính năng mã</label>
			                        <select name="coupon_condition" class="form-control custom-select" id="coupon_condition">
			                        	<option value="">--chọn tính năng--</option>
			                            <option value="1">Giảm theo phần trăm</option>
			                            <option value="2">Giảm theo tiền</option>
			                        </select>
			                        <label class="error errorcoupon_condition" for="coupon_condition" style="display: none;"></label>
			                    </div>
								<div class="form-group">
									<label for="coupon_number">Giá trị phiếu:</label>
									<input type="text" class="form-control" id="coupon_number" placeholder="Nhập % giảm hoặc tiền giảm....." name="coupon_number">
									<label class="error errorcoupon_number" for="coupon_number" style="display: none;"></label>
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
<script src="{{asset('adminpages/ajaxController/Quanlycoupon_ajax.js')}}"></script>
@endpush
@stop