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
	</colgroup>
	<thead>
		<tr>
			<th>#</th>
			<th>Tên tin tức</th>
			<th>Mô tả</th>
			<th>Hình ảnh</th>
			<th>Trạng thái</th>
			<th style="width: 115px;">Thao tác</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datas as $item)
		<tr>
			<td>{{$item->article_id}}</td>
			<td>
				{{$item->article_name}}
			</td>
			
			<td>
				{!! $item->article_description !!}
			</td>
			<td>
				@if($item->article_avatar)
				<img src="/article/{{$item->article_avatar}}" alt="" style="width: 70px;height: 60px;">
				@else
				<img src="/article/images_default.png" alt="" style="width: 70px;height: 60px;">
				@endif
			</td>
			<td style="padding-top: 22px;">
				@if($item->article_active == 1)
				<a class="label label-info change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/article/change-status/{{$item->article_id}}" data-id="{{$item->article_active}}"><span>Hiển thị</span></a>
				@else
				<a class="label label-default change_status" style="padding: 4px 10px;border:1px solid #999" href="/admin/article/change-status/{{$item->article_id}}" data-id="{{$item->article_active}}"><span>Ẩn</span></a>
				@endif
			</td>
			<td style="padding-top: 22px;">
				<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="{{route('admin.article.get.edit',$item->article_id)}}"  class="styling-edit"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
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