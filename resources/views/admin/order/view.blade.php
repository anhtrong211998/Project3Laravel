<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Chi tiết đơn hàng <b style="font-size: 13px;">##</b><b class="show_order_id" style="font-size: 13px;">{{$order->order_id}}</b></h4>
</div>
<div class="modal-body">
	<table class="table table-striped">
		<colgroup>
			<col width="1">
			<col>
			<col width="1">
			<col width="1">
			<col width="1">
			<col width="1">
			<col>
		</colgroup>
		<thead>
			<tr>
				<td colspan="3"></td>
				
				<td colspan="3">
					<div class="form-inline">
					<label for="order_status">Status:</label>
					<select name="" id="order_status" class="custom-select form-control col-md-pull-6" style="padding:0 12px;height: 28px;width: 180px;" >
						<option @if($order->order_status == 1) selected @endif value="1">Chưa xác nhận</option>
						<option @if($order->order_status == 2) selected @endif value="2">Đã xác nhận</option>
						<option @if($order->order_status == 3) selected @endif value="3">Đang giao hàng</option>
						<option @if($order->order_status == 4) selected @endif value="4">Đã giao hàng</option>
						@if($order->order_status != 4)
						<option @if($order->order_status == 5) selected @endif value="5">Đã hủy</option>
						@endif
					</select></div>
				</td>
				
					<td>
						<a href="#" style="font-size:21px;font-weight:600;margin-right: 18px;"><i class="fa fa-edit"></i></a>
						<a href="#" class="" style="font-size:21px;font-weight:600;margin-right: 10%;"><i class="fa fa-plus-circle"></i></a>

					</td>
				</tr>
				<tr>
					<th>#</th>
					<th style="text-align: left;">Tên sản phẩm</th>
					<th>Hình ảnh</th>
					<th style="text-align: left;width: 120px;">Giá</th>
					<th style="width: 80px;">Số lượng</th>
					<th style="width: 115px;">Thành tiền</th>
					<th style="width: 140px;">Thao tác</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orderdetail as $orderdetails)
				<tr>
					<td>{{$orderdetails->order_detail_id}}</td>
					<td>
						{{$orderdetails->order_detail_product_name}}
					</td>
					<td><img src="/adminpages/images/{{$orderdetails->order_detail_image}}" alt="" style="width: 70px;height: 60px;"></td>
					<td style="padding-top: 22px;text-align: right;">
						{{number_format($orderdetails->order_detail_product_price).' '.'(đ)'}}
					</td>
					<td style="padding-top: 22px;"><input maxlength="12" class="input-text edit-qty form-control" title="Qty" size="4" value="{{$orderdetails->order_detail_product_quanty}}" data-id="4" type="number" id="change-qty_4" style="height: 28px;padding: 0 12px;margin-top: -6px;" disabled="disabled" ></td>
					<td style="padding-top: 22px;text-align: right;">{{number_format($orderdetails->order_detail_total_price).' '.'(đ)'}}</td>
					<td style="padding-top: 22px;text-align: center;">
						<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="#" ><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		@if($order->order_status == 2)
		<a href="#" class="btn btn-success" style="float: left;">print</a>
		@endif
	</div>