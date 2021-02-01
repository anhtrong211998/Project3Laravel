@extends('admin.layouts.master')
@section('content')
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Thành viên</a></li>
		  	<li class="active">Danh sách</li>
		</ol>
	</div>
	<div class="row">
		<div class="form-group col-sm-2"></div>
		<div class="form-group col-sm-3"></div>
			
		<div class="col-sm-4" style="float:right;">
			<form class="form-inline" action="" style="margin-bottom: 20px;">
				{{csrf_field()}}
				<div class="form-group">
					<input type="text" class="form-control" id="name_search" name="name_search" placeholder="Nhập tên cần tìm....">
				</div>
				<button type="submit" class="btn btn-default" id="btnSearchSS"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	
	<div class="table-responsive">
		
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý thành viên <a href="#" class="pull-right js_add_item"><i class="fa fa-plus-circle"></i></a></h2>
		<div id="reder_data">
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
			
		</div>
		
	</div>
	<div class="modal fade" id="CreateAndEdit" role="dialog">
    	<div class="modal-dialog modal-lg">
      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title" style="text-align: center;font-size: 22px;color:#428bca;font-weight: 600;"></h4>
		        </div>
		        <div class="modal-body">
		        	<form action="" method="POST" id="btnSave" enctype="multipart/form-data">
						@csrf
						<input type="hidden" class="form-control" name="hiddenid" id="hiddenid" value="0">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group user_update_insert">
									<label for="name">Họ và tên:</label>
									<input type="text" class="form-control" id="name" placeholder="Họ và tên....." name="name">
									<label class="error errorname" for="name" style="display: none;"></label>
								</div>
								<div class="form-group user_update_insert">
									<label for="phone">Số điện thoại:</label>
									<input type="text" class="form-control" id="phone" placeholder="Số điện thoại...." name="phone">
									<label class="error errorphone" for="phone" style="display: none;"></label>
								</div>
								<div class="form-group user_update_insert">
									<label for="email">Email:</label>
									<input type="text" class="form-control" id="email" placeholder="Email...." name="email">
									<label class="error erroremail" for="email" style="display: none;"></label>
								</div>
								<div class="form-group user_fee">
									<label for="f_u_address">Địa chỉ:</label>
									<textarea name="f_u_address" id="f_u_address" class="form-control f_u_address" rows="3" placeholder="Mô tả ngắn gọn"></textarea>
									<label class="error errorf_u_address" for="f_u_address" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="password user_update_insert">Mật khẩu:</label>
									<input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu của bạn...." name="password">
									<label class="error errorpassword" for="password" style="display: none;"></label>
								</div>
								<div class="form-group user_update_insert">
									<label for="re-password">Nhập lại mật khẩu:</label>
									<input type="password" class="form-control" id="re-password" placeholder="Xác nhận lại mật khẩu..." name="re-password">

								</div>
								<button type="submit" class="btn btn-primary" id="submit-form">Save</button>
								<button type="button" class="btn btn-primary" id="submit-form-unique" style="display:none;">Save</button>	
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group user_update_insert">
									<img src="/article/images_default.png" alt="" style="width: 100%;height: 200px;" id="output_img">
								</div>
								<div class="form-group user_update_insert">
				                    <label for="avatar">Avatar</label>
				                    <input type="file" name="avatar" class="form-control" id="avatar" placeholder="Chọn avatar nếu bạn muốn....">
				                </div>
				                <div class="form-group user_update_insert" id="update_status">
									<label for="active">Trạng thái:</label>
			                        <select id="active" name="active" class="custom-select form-control">
			                            <option value="1">Hiện</option>
			                            <option value="0">Ẩn</option>
			                        </select>
								</div>
								
				                <div class="form-group user_fee">
				                	<label for="fee_matp">Tỉnh/thành phố:</label>
				                	<select id="fee_matp" name="fee_matp" class="custom-select form-control">
				                		<option value="">--Chọn tỉnh/thành phố</option>
				                		@foreach($cities as $key => $city)
				                		<option value="{{$city->matp}}">{{$city->name}}</option>
				                		@endforeach
				                	</select>
				                	<label class="error errorfee_matp" for="fee_matp" style="display: none;"></label>
			                    </div>
								<div class="form-group user_fee">
									<label for="fee_maquanhuyen">Quận/Huyện:</label>
			                        <select id="fee_maquanhuyen" name="fee_maquanhuyen" class="custom-select form-control">
			                            <option value="">--Chọn quận/huyện</option>
			                            @foreach($provinces as $key => $province)
			                            <option value="{{$province->maqh}}">{{$province->name}}</option>
			                            @endforeach
			                        </select>
			                        <label class="error errorfee_maquanhuyen" for="fee_maquanhuyen" style="display: none;"></label>
								</div>
								<div class="form-group user_fee">
									<label for="fee_maxaphuong">Xã/Phường/Thị trấn:</label>
			                        <select id="fee_maxaphuong" name="fee_maxaphuong" class="custom-select form-control">
			                            <option value="">--Chọn xã/phường</option>
			                            @foreach($wards as $key => $ward)
			                            <option value="{{$ward->xaid}}">{{$ward->name}}</option>
			                            @endforeach
			                        </select>
			                        <label class="error errorfee_maxaphuong" for="fee_maxaphuong" style="display: none;"></label>
								</div>
							</div>
							
							<div class="col-sm-1"></div>
						</div>
					</form>
		        </div>
		        <div class="modal-footer">
		          	
        			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    {{-- <input type="hidden" class="form-control" name="hidID" id="hidID" value="0"> --}}
		        </div>
	      	</div>
    	</div>
  	</div>
  	<div class="modal fade" id="CreateAndEditFee" role="dialog">
    	<div class="modal-dialog modal-lg">
      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title" style="text-align: center;font-size: 22px;color:#428bca;font-weight: 600;"></h4>
		        </div>
		        <div class="modal-body">
		        	<form action="" method="POST" id="btnSaveFee" enctype="multipart/form-data">
						@csrf
						<input type="hidden" class="form-control" name="hiddenidfee" id="hiddenidfee" value="0">
						{{-- <input type="hidden" class="form-control" name="user_id" id="user_id" value="0"> --}}
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
				                	<label for="id">Khách hàng:</label>
				                	<select id="id" name="id" class="custom-select form-control">
				                		<option value="">--Chọn khách hàng--</option>
				                		@foreach($datas as $key => $data)
				                		<option value="{{$data->id}}">{{$data->name}}</option>
				                		@endforeach
				                	</select>
				                	<label class="error errorid" for="id" style="display: none;"></label>
			                    </div>
								<div class="form-group">
									<label for="f_u_address_user">Địa chỉ:</label>
									<textarea name="f_u_address_user" id="f_u_address_user" class="form-control f_u_address" rows="3" placeholder="Mô tả ngắn gọn"></textarea>
									<label class="error errorf_u_address" for="f_u_address_user" style="display: none;"></label>
								</div>
								<div class="form-group">
				                	<label for="f_u_status">Status:</label>
				                	<select id="f_u_status" name="f_u_status" class="custom-select form-control">
				                		<option value="1">Hiện</option>
				                		<option value="0">Ẩn</option>
				                	</select>
				                	<label class="error errorf_u_status" for="f_u_status" style="display: none;"></label>
			                    </div>
			                    <button type="submit" class="btn btn-primary" style="">Lưu địa chỉ</button>
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
				                <div class="form-group">
				                	<label for="fee_matp_user">Tỉnh/thành phố:</label>
				                	<select id="fee_matp_user" name="fee_matp_user" class="custom-select form-control">
				                		<option value="">--Chọn tỉnh/thành phố</option>
				                		@foreach($cities as $key => $city)
				                		<option value="{{$city->matp}}">{{$city->name}}</option>
				                		@endforeach
				                	</select>
				                	<label class="error errorfee_matp" for="fee_matp_user" style="display: none;"></label>
			                    </div>
								<div class="form-group">
									<label for="fee_maquanhuyen_user">Quận/Huyện:</label>
			                        <select id="fee_maquanhuyen_user" name="fee_maquanhuyen_user" class="custom-select form-control">
			                            <option value="">--Chọn quận/huyện</option>
			                            @foreach($provinces as $key => $province)
			                            <option value="{{$province->maqh}}">{{$province->name}}</option>
			                            @endforeach
			                        </select>
			                        <label class="error errorfee_maquanhuyen" for="fee_maquanhuyen_user" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="fee_maxaphuong_user">Xã/Phường/Thị trấn:</label>
			                        <select id="fee_maxaphuong_user" name="fee_maxaphuong_user" class="custom-select form-control">
			                            <option value="">--Chọn xã/phường</option>
			                            @foreach($wards as $key => $ward)
			                            <option value="{{$ward->xaid}}">{{$ward->name}}</option>
			                            @endforeach
			                        </select>
			                        <label class="error errorfee_maxaphuong" for="fee_maxaphuong_user" style="display: none;"></label>
								</div>
							</div>
							
							<div class="col-sm-1"></div>
						</div>
					</form>
		        </div>
		        <div class="modal-footer">
		          	
        			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    
		        </div>
	      	</div>
    	</div>
  	</div>
  	<div class="modal fade" id="show_user_fee" role="dialog">
    	<div class="modal-dialog modal-lg">
      	<!-- Modal content-->
	      	<div class="modal-content" id="render_feeship_user">
		        
	      	</div>
    	</div>
  	</div>
@push('jsmore')
	
	{{-- <script>
	    CKEDITOR.replace('f_u_address');        
	</script>
 --}}	
 <script>
	$(document).ready(function(){
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $("#fee_matp").change(function(){
	        var matp = $(this).val();
	        $.get("/admin/feeship/getprovince/"+matp,function(data){
	            $("#fee_maquanhuyen").html(data);
	        });
	    });
	    $("#fee_maquanhuyen").change(function(){
	        var maqh = $(this).val();
	        $.get("/admin/feeship/getwards/"+maqh,function(data){
	            $("#fee_maxaphuong").html(data);
	        });
	    });
	    $("#fee_matp_user").change(function(){
	        var matp = $(this).val();
	        $.get("/admin/feeship/getprovince/"+matp,function(data){
	            $("#fee_maquanhuyen_user").html(data);
	        });
	    });
	    $("#fee_maquanhuyen_user").change(function(){
	        var maqh = $(this).val();
	        $.get("/admin/feeship/getwards/"+maqh,function(data){
	            $("#fee_maxaphuong_user").html(data);
	        });
	    });

	    $('#password,#re-password').on('keyup', function (){
	        if ($('#password').val() == $('#re-password').val()) {
	            $('#message').html('Chính xác').css('color', 'green');
	            $('.btn-primary').removeAttr("disabled");
	        } 
	        else{
	            $('#message').html('Không giống').css('color', 'red');
	            $('.btn-primary').attr("disabled", "disabled");
	        }
	    });
	}); 
</script>
<script>
	function readURL(input) {
		if(input.files && input.files[0]) {
	    	var reader = new FileReader();
	    	reader.onload = function(e) {
			$('#output_img').attr('src', e.target.result);
			}	
	    	reader.readAsDataURL(input.files[0]); // convert to base64 string
	  	}
	}
	$("#avatar").change(function(){
			readURL(this);
	});
</script>
<script src="{{asset('adminpages/ajaxController/Quanlyuser_ajax.js')}}"></script>
@endpush
@stop