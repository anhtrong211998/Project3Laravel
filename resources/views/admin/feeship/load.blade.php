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
			<th>Tỉnh/Thành phố</th>
			<th>Quận/Huyện</th>
			<th>Xã/Phường/Thị trấn</th>
			<th>Phí ship</th>
			<th>Thao tác</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datas as $key=>$item)
		<tr>
			<td>{{$item->fee_id}}</td>
			<td>
				{{$item->city->name}}
			</td>
			<td style="text-align: center;">{{$item->province->name}}</td>
			<td style="text-align: center;">{{$item->ward->name}}</td>
			<td>{{number_format($item->fee_ship).' '.'(đ)'}}</td>	
			<td style="text-align: center;">
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/feeship/edit/{{$item->fee_id}}" class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/feeship/delete/{{$item->fee_id}}" class="styling-delete" ><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $datas->links() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>