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
{!! $datas->links() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>