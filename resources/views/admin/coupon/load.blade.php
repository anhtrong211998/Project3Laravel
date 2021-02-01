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
{!! $datas->links() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>