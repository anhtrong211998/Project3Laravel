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
{!! $datas->links() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>