<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-titles" style="margin:0;line-height:1.42857143;font-size: 22px;color:#d9534f;font-weight: 600;">Địa chỉ giao hàng<b style="font-size: 13px;color: skyblue;margin: 0 5px;" class="id_user">#Mã khách hàng {{$user->id}}</b><b class="name_user" style="font-size: 13px;color: #428bca;">#{{$user->name}}</b></h4>
</div>
<div class="modal-body">
	{{-- <form action="" method="" id="save_form" enctype="multipart/form-data">
		@csrf --}}
		{{-- <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{$user->id}}"> --}}	
		                    
		<div class="row">
			<table class="table table-striped" id="modal-table-search">
				<colgroup>
					<col width="1">
					<col width="1">
					<col width="1">
					<col width="1">
					<col width="1">
				</colgroup>
				<thead>
					<tr>
						<td colspan="3"></td>
						<td style="width: 196px;">
							<form class="form-inline" id="submit-search" action="" method="POST" style="margin-bottom: 20px;">
								<input type="hidden" class="form-control" name="user_id" id="user_id" value="{{$user->id}}">
								{{csrf_field()}}
								<div class="form-group">
									<input type="text" class="form-control" id="search_name" name="search_name" placeholder="Nhập địa chỉ cần tìm....">
								</div>
							</form>
						</td>
						<td>
							<a href="#" id="insert_user_fee" style="font-size:21px;font-weight:600;">
								<i class="fa fa-plus-circle"></i>
							</a>
						</td>
					</tr>
					<tr>
						<th>#</th>
						<th>Phí vận chuyển</th>
						<th>Địa chỉ</th>
						<th>Trạng thái</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($userfee as $value)
					<tr>
						<td>{{$value->f_u_id}}</td>
						@if($value->f_u_fee_id == 0)
						<td style="text-align:center;">
							{{number_format(50000).' '.'đ'}}
						</td>
						@else
						<td style="text-align:center;">

							{{number_format($value->Feeship->fee_ship).' '.'đ'}}
						</td>
						@endif
						<td>
							{{$value->f_u_address}}
						</td>
						@if($value->f_u_status == 1)
						<td style="text-align:center;">
							<a class="label label-info change_status_fee" style="padding: 4px 10px;border:1px solid #999" href="/admin/user_fee/change-status/{{$value->f_u_id}}" data-id="{{$value->f_u_status}}">Hiển thị</a>
						</td>
						@else
						<td style="text-align:center;">
							<a class="label label-default change_status_fee" style="padding: 4px 10px;border:1px solid #999" href="/admin/user_fee/change-status/{{$value->f_u_id}}" data-id="{{$value->f_u_status}}">Ẩn</a>
						</td>
						@endif
						<td style="text-align:center;">
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/user_fee/edit/{{$value->f_u_id}}" class="edit_feeship_user" data-id="{{$value->f_u_id}}"><i style="font-size: 12px;" class="fa fa-pencil-square-o text-success text-active">Edit</i></a>
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/user_fee/delete/{{$value->f_u_id}}" class="delete_feeship_user"><i style="font-size: 12px;" class="fa fa-times text-danger text">Delete</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! $userfee->render() !!}
		</div>
	{{-- </form> --}}
</div>
<div class="modal-footer">		          	
	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>