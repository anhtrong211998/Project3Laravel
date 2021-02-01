@if(Session::has('message'))
<div class="alert alert-success" id="aler_success">
	{!! Session::get('message') !!}
</div>
<?php session::put('message', null); ?>
@endif
<table class="table table-striped">
	<thead>
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
{!! $datas->links() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>