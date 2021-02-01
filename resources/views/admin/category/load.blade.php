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
			<td style="text-align: left;">Tên danh mục</td>
			<th style="text-align: left;">Mô tả</th>
			<th style="text-align: left;">Trạng thái</th>
			<th style="width: 115px;text-align: left;">Thao tác</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datas as $item)
		<tr>
			<td>{{$item->category_id}}</td>
			
			<td>
				{!! $item->category_name !!}
			</td>
			<td>
				{!! $item->category_desc !!}
			</td>
			<td style="padding-top: 22px;">
				@if($item->category_status == 1)
				<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/category/change-status/{{$item->category_id}}" data-id="{{$item->category_status}}"><span>Hiển thị</span></a>
				@else
				<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/category/change-status/{{$item->category_id}}" data-id="{{$item->category_status}}"><span>Ẩn</span></a>
				@endif
			</td>
			<td style="padding-top: 22px;">
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/category/edit/{{$item->category_id}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/category/delete/{{$item->category_id}}"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $datas->render() !!}
<script>
	$("#aler_success").delay(1000).slideUp();
</script>