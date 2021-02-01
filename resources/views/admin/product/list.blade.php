@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Sản phẩm</a></li>
		  	<li class="active">Danh sách</li>
		</ol>
	</div>
	<div class="row">
		<div class="form-group col-sm-2" style="margin-left: 28px;width: 210px;">
			<select name="category_id" id="category_id" class="custom-select form-control">
				<option value="all">--Chọn danh mục---</option>
				@foreach($category as $key=>$value)
				<option value="{{$value->category_id}}">{{$value->category_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-sm-3" style="padding-left:0;">
			<select name="catetory_id" id="catetory_id" class="custom-select form-control">
				<option value="">--Chọn loại sản phẩm---</option>
				@foreach($catetory as $key=>$value)
				<option value="{{$value->catetory_id}}">{{$value->catetory_name}}</option>
				@endforeach
			</select>
		</div>
			
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
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý sản phẩm <a href="/admin/product/create" class="pull-right"><i class="fa fa-plus-circle"></i></a></h2>
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
						<th>Tên sản phẩm</th>
						<th>Hình ảnh</th>
						<th>Nhà cung cấp</th>
						<th>Nhãn hiệu</th>
						<th>Trạng thái</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $key=>$item)
					<tr>
						<td>{{$item->product_id}}</td>
						<td>
							{{$item->product_name}}
							<ul style="padding-left: 15px;">
								<li><span style="padding-right: 4px;"><i class="fa fa-dollar"></i></span>{{number_format($item->product_price).' '.'(đ)'}}<span ></span></li>
								<li><span style="padding-right: 4px;"><i class="fa fa-dollar"></i></span>-{{$item->product_sale}} %<span></span></li>
								<li>
									<span style="font-size: 12px;">Số lượng: </span>
									{{-- <span class="ratings" style="font-size: 12px;">
									</span> --}}
									<span>{{$item->product_quantity}}</span>
								</li>
								<li>
									<?php 
										if($item->rating_product_total > 0){
											$total = round($item->product_total_rating/$item->rating_product_total,2); 
										}
										else{
											$total = 0;
										}
									?>
									<span style="font-size: 12px;">Đánh giá: </span>
									<span class="ratings" style="font-size: 12px;">
										@for($i=1; $i<=5;$i++)
										<i class="fa fa-star " style="color:{{$i <= $total ? '#ffc60a':'#999'}} ;"></i>
										@endfor
									</span>
									<span>({{$total}})</span>
								</li>
							</ul>
						</td>
						<td><img src="/adminpages/images/{{$item->product_image}}" alt="" style="width: 88px;height: 95px;"></td>
						<td style="padding-top: 22px;text-align: center;">{{$item->Provider->provider_name}}</td>
						<td style="padding-top: 22px;text-align: center;">{{$item->Brand->brand_name}}</td>
						<td style="padding-top: 22px;text-align: center;">
							@if($item->product_status==0)
							<a href="/admin/product/change-status/{{$item->product_id}}" class="label label-default change_status" data-id="{{$item->product_status}}" style="padding: 4px 10px;border:1px solid #999">Ẩn</a>
							@else
							<a href="/admin/product/change-status/{{$item->product_id}}" class="label label-info change_status" data-id="{{$item->product_status}}" style="padding: 4px 10px;border:1px solid #999">Hiển thị</a>
							@endif
						</td>	
						<td style="padding-top: 22px;text-align: center;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/product/edit/{{$item->product_id}}"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/product/delete/{{$item->product_id}}" class="styling-delete" ><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! $datas->render() !!}
		</div>
		
	</div>
@push('jsmore')
<script>
        $(document).ready(function(){
            // alert('đã chạy được');
            $("#category_id").change(function(){
	            var categoryID = $(this).val();
	            $.ajax({
		            url: '/admin/product/getcatetory/'+categoryID,
		            type: 'GET',
		            success: function (data) {
		                $("#catetory_id").html(data);		                
		            }
		        });
	        });
            $("#catetory_id").change(function(event){
            	event.preventDefault();
	            var id = $(this).val();
	            console.log(id);
	            var name_search = $('#name_search').val();
	            console.log(name_search);
	           	$.ajax({
		            url: '/admin/product/load-data',
		            type: 'GET',
		            dataType: 'html',
		            data: { 
		            	id:id,           
		                name_search: name_search  
		            },
		            success: function (data) {
		                // console.log(data);
		                $('#reder_data').empty();
		                $('#reder_data').html(data);		                
		            }
		        });
	        });

        });
</script>
<script src="{{asset('adminpages/ajaxController/Quanlyproduct_ajax.js')}}"></script>
@endpush
@stop