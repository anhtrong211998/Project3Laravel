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
	</colgroup>
	<thead>
		<tr>
			<th style="text-align: left;">#</th>
			<th style="text-align: left;">Mô tả</th>
			<th style="text-align: left;">Hình ảnh</th>
			<th style="text-align: left;">Trạng thái</th>
			<th style="width: 115px;text-align: left;">Thao tác</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datas as $item)
		<tr>
			<td>{{$item->banner_id}}</td>
			
			<td>
				{!! $item->banner_desc !!}
			</td>
			<td>
				@if($item->banner_image)
				<img src="/banner/{{$item->banner_image}}" alt="" style="width: 150px;height: 60px;">
				@else
				<img src="/article/images_default.png" alt="" style="width: 150px;height: 60px;">
				@endif
			</td>
			<td style="padding-top: 22px;">
				@if($item->banner_status == 1)
				<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/banner/change-status/{{$item->banner_id}}" data-id="{{$item->banner_status}}"><span>Hiển thị</span></a>
				@else
				<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/banner/change-status/{{$item->banner_id}}" data-id="{{$item->banner_status}}"><span>Ẩn</span></a>
				@endif
			</td>
			<td style="padding-top: 22px;">
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/banner/edit/{{$item->banner_id}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="#"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $datas->render() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>