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
		@if(count($datas)>0)
			@foreach($datas as $item)
			<tr>
				<td>{{$item->product_id}}</td>
				<td>
					{{$item->product_name}}
					<ul style="padding-left: 15px;">
						<li><span style="padding-right: 4px;"><i class="fa fa-dollar"></i></span>{{number_format($item->product_price).' '.'(đ)'}}<span ></span></li>
						<li><span style="padding-right: 4px;"><i class="fa fa-dollar"></i></span>-{{$item->product_sale}} %<span></span></li>
						<li>
							<span style="font-size: 12px;">Số lượng: </span>
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
					<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/product/delete/{{$item->product_id}}" class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text ">Delete</i></a>
				</td>
			</tr>
			@endforeach
		@endif
	</tbody>
</table>
{!! $datas->links() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>