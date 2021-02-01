@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Đơn đặt hàng</a></li>
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
					<input type="text" class="form-control" id="name_search" name="name_search" placeholder="Nhập địa chỉ cần tìm...." name="email">
				</div>
				<button type="submit" class="btn btn-default" id="btnSearchSS"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý đơn đặt hàng <a href="#" class="pull-right"><i class="fa fa-plus-circle"></i></a></h2>
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
						<th style="text-align: left;width: 210px;">Khách hàng</th>
						<th style="width: 184px;">Phương thức thanh toán</th>
						<th>Địa chỉ</th>
						<th>Trạng thái</th>
						<th>View</th>
						<th style="width: 140px;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $key=>$item)
					<tr>
						<td>{{$item->order_id}}</td>
						<td>
							@if(is_numeric($item->order_customer_id))
							{{$item->User->name}}
							@else
							{{$item->Customer->customer_name}}
							@endif
							<ul style="padding-left: 15px;">
								<li><span style="padding-right: 4px;"><i class="fa fa-dollar"></i></span>-{{number_format($item->order_coupon_sale).' '.'(đ)'}}<span ></span></li>
								<li><span style="padding-right: 4px;"><i class="fa fa-dollar"></i></span>+{{number_format($item->order_fee_ship).' '.'(đ)'}}<span></span></li>
								<li>
									<span style="font-size: 12px;">Thanh toán: </span>
									{{-- <span class="ratings" style="font-size: 12px;">
									</span> --}}
									<span>{{number_format($item->order_total_price).' '.'(đ)'}}</span>
								</li>
							</ul>
						</td>
						<td style="padding-top: 22px;text-align: center;">{{$item->order_payment_method}}</td>
						<td style="padding-top: 22px;text-align: center;">{{$item->order_address}}</td>
						<td style="padding-top: 22px;text-align: center;">
							@if($item->order_status==1)
							<span class="label label-default order_status" data-id="{{$item->order_status}}" style="padding: 4px 10px;border:1px solid #999">Chưa xác nhận</span>
							@elseif($item->order_status==2)
							<span class="label label-info order_status" data-id="{{$item->order_status}}" style="padding: 4px 10px;border:1px solid #999">Đã xác nhận</span>
							@elseif($item->order_status==3)
							<span class="label label-warning order_status" data-id="{{$item->order_status}}" style="padding: 4px 10px;border:1px solid #999">Đang giao kiện</span>
							@elseif($item->order_status==4)
							<span class="label label-success order_status" data-id="{{$item->order_status}}" style="padding: 4px 10px;border:1px solid #999">Đã giao kiện</span>
							@elseif($item->order_status==5)
							<span class="label label-danger order_status" data-id="{{$item->order_status}}" style="padding: 4px 10px;border:1px solid #999">Đã hủy kiện</span>
							@endif
						</td>	
						<td style="padding-top: 22px;text-align: center;">
							<a href="#" class="view_order" data-id="{{$item->order_id}}"><i class="fa fa-eye" style="font-size: 22px;" aria-hidden="true"></i></a>
						</td>
						<td style="padding-top: 22px;text-align: center;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/order/edit/{{$item->order_id}}"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/order/delete/{{$item->order_id}}" class="styling-delete" ><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! $datas->render() !!}
		</div>
		
	</div>
	<div class="modal fade" id="show_order_detail" role="dialog">
    	<div class="modal-dialog modal-lg">
      	<!-- Modal content-->
	      	<div class="modal-content" id="render_order_detail">
		        
	      	</div>
    	</div>
  	</div>
@push('jsmore')

<script src="{{asset('adminpages/ajaxController/Quanlyorder_ajax.js')}}"></script>
@endpush
@stop