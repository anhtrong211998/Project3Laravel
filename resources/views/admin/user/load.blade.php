@if(Session::has('message'))
    <div class="alert alert-success" id="aler_success">
        {!! Session::get('message') !!}
    </div>
    <?php session::put('message', null); ?>
@endif
<table class="table table-striped">
	<colgroup>
		<col width="1">
		<col width="1">
		<col width="1">
		<col width="1">
		<col width="1">
		<col width="1">
		<col width="1">
		<col width="1">
	</colgroup>
	<thead>
		<tr>
			<th>#</th>
			<th style="text-align: left;width: 73px;">Tên thành viên</th>
			<th style="text-align: left;">Số điện thoại</th>
			<th style="text-align: left;">Email</th>
			<th style="text-align: left;width: 70px;">Tổng mua</th>
			<th style="text-align: left;width:58px;">Social</th>
			<th style="text-align: left;">Trạng thái</th>
			<th style="text-align: left;width: 48px;">Địa chỉ</th>
			<th style="width: 115px;">Thao tác</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datas as $item)
		<tr>
			<td>{{$item->id}}</td>
			<td>
				{{$item->name}}
			</td>

			<td>
				{!! $item->phone !!}
			</td>
			<td>
				{!! $item->email !!}
			</td>
			<td style="text-align: center;">
				{!! $item->total_pay !!}
			</td>
			<td style="text-align: center;">
				@if($item->social_id == 1)
				<i class="fa fa-user" style="font-size: 25px;"></i>
				@elseif($item->social_id == 2)
				<i class="fa fa-facebook" style="font-size: 25px;"></i>
				@else
				<i class="fa fa-google" style="font-size: 25px;"></i>
				@endif
			</td>
			<td>
				@if($item->active == 1)
				<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/user/change-status/{{$item->id}}" data-id="{{$item->active}}"><span>Hiển thị</span></a>
				@else
				<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/user/change-status/{{$item->id}}" data-id="{{$item->active}}"><span>Ẩn</span></a>
				@endif
			</td>
			<td style="text-align: center;">
				<a href="#" class="view_feeship" data-id="{{$item->id}}"><i class="fa fa-eye" style="font-size: 22px;" aria-hidden="true"></i></a>
			</td>
			<td style="text-align: center;"> 
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="{{route('admin.user.get.edit',$item->id)}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/user/delete/{{$item->id}}"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $datas->render() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>