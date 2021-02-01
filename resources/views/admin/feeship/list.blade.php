@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Vận chuyển</a></li>
		  	<li class="active">Danh sách</li>
		</ol>
	</div>
	<div class="row">
		<div class="form-group col-sm-3" style="margin-left: 28px;width: 210px;">
			<select class="custom-select form-control" name="fee_matp_select" id="fee_matp_select" style="width:100%">
            	<option value="">--Chọn tỉnh/thành phố</option>
            	@foreach($cities as $key => $city)
            	<option value="{{$city->matp}}">{{$city->name}}</option>
            	@endforeach
            </select>
		</div>
		<div class="form-group col-sm-3" style="padding-left:0;">
			<select class="custom-select form-control" name="fee_maquanhuyen_select" id="fee_maquanhuyen_select" style="width:100%">
            	<option value="">--Chọn quận/huyện</option>
            	@foreach($provinces as $key => $province)
            	<option value="{{$province->maqh}}">{{$province->name}}</option>
            	@endforeach
            </select>
		</div>	
		<div class="col-sm-3" style="padding-left:0;">
			<select class="custom-select form-control" name="fee_maxaphuong_select" id="fee_maxaphuong_select"  style="width:100%">
            	<option value="all">--Chọn xã/phường</option>
                @foreach($wards as $key => $ward)
                <option value="{{$ward->xaid}}">{{$ward->name}}</option>
                @endforeach
            </select>
		</div>
	</div>
	<div class="table-responsive">
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý sản phẩm <a href="/admin/product/create" class="pull-right js_add_item"><i class="fa fa-plus-circle"></i></a></h2>
		<div id="reder_data">
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
						<input type="hidden" class="form-control" name="fee_id" id="fee_id" value="">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
									<label for="fee_matp">Tỉnh/Thành phố:</label>
									<select name="fee_matp" id="fee_matp" class="custom-select form-control">
										<option value="">--Chọn tỉnh/thành phố</option>
	                        			@foreach($cities as $key => $city)
	                        			<option value="{{$city->matp}}">{{$city->name}}</option>
	                        			@endforeach 
									</select>
									<label class="error errorfee_matp" for="fee_matp" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="fee_maquanhuyen">Quận/Huyện:</label>
									<select name="fee_maquanhuyen" id="fee_maquanhuyen" class="custom-select form-control">
										<option value="">--Chọn quận/huyện</option>
	                        			@foreach($provinces as $key => $province)
	                        			<option value="{{$province->maqh}}">{{$province->name}}</option>
	                        			@endforeach 
									</select>
									<label class="error errorfee_maquanhuyen" for="fee_maquanhuyen" style="display: none;"></label>
								</div>
								<button type="submit" class="btn btn-primary" id="submit-form">Save</button>
								<button type="button" class="btn btn-primary" id="submit-form-unique" style="display:none;">Save</button>	
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group">
									<label for="fee_maxaphuong">Xã/Phường/Thị trấn:</label>
									<select name="fee_maxaphuong" id="fee_maxaphuong" class="custom-select form-control">
										<option value="">--Chọn xã/phường</option>
	                        			@foreach($wards as $key => $ward)
	                        			<option value="{{$ward->xaid}}">{{$ward->name}}</option>
	                        			@endforeach
									</select>
									<label class="error errorfee_maxaphuong" for="fee_maxaphuong" style="display: none;"></label>
								</div>
								<div class="form-group">
									<label for="fee_ship">Phí vận chuyển:</label>
									<input type="text" class="form-control" id="fee_ship" placeholder="Nhập phí vận chuyển....." name="fee_ship">
									<label class="error errorfee_ship" for="fee_ship" style="display: none;"></label>
								</div>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
							
							<div class="col-sm-1"></div>
						</div>
					</form>
		        </div>
		        <div class="modal-footer">
		          	
        			
		        </div>
	      	</div>
    	</div>
  	</div>
@push('jsmore')
<script>
	$(document).ready(function(){
		$("#fee_matp_select").change(function(){
			event.preventDefault();
            var matp = $(this).val();
           	$.ajax({
	            url: '/admin/feeship/getprovince',
	            type: 'GET',
	            dataType: 'html',
	            data: { 
	            	matp:matp,           
	            },
	            success: function (data) {
	                // console.log(data);
	                $('#fee_maquanhuyen_select').empty();
	                $("#fee_maquanhuyen_select").html(data);		                
	            }
	        });
		});
		$("#fee_maquanhuyen_select").change(function(event){
			event.preventDefault();
            var maqh = $(this).val();
            console.log(maqh);
           	$.ajax({
	            url: '/admin/feeship/getwards',
	            type: 'GET',
	            // dataType: 'html',
	            data: { 
	            	maqh:maqh,           
	            },
	            success: function (data) {
	                // console.log(data);
	                $('#fee_maxaphuong_select').empty();
	                $("#fee_maxaphuong_select").html(data);		                
	            }
	        });
		});
		$("#fee_matp").change(function(event){
			event.preventDefault();
            var matp = $(this).val();
           	$.ajax({
	            url: '/admin/feeship/getprovince',
	            type: 'GET',
	            dataType: 'html',
	            data: { 
	            	matp:matp,           
	            },
	            success: function (data) {
	                // console.log(data);
	                $('#fee_maquanhuyen').empty();
	                $("#fee_maquanhuyen").html(data);		                
	            }
	        });
		});
		$("#fee_maquanhuyen").change(function(event){
			event.preventDefault();
            var maqh = $(this).val();
            console.log(maqh);
           	$.ajax({
	            url: '/admin/feeship/getwards',
	            type: 'GET',
	            // dataType: 'html',
	            data: { 
	            	maqh:maqh,           
	            },
	            success: function (data) {
	                // console.log(data);
	                $('#fee_maxaphuong').empty();
	                $("#fee_maxaphuong").html(data);		                
	            }
	        });
		});
		$("#fee_maxaphuong_select").change(function(event){
            	event.preventDefault();
	            var id = $(this).val();
	            console.log(id);
	           	$.ajax({
		            url: '/admin/feeship/load-data',
		            type: 'GET',
		            dataType: 'html',
		            data: { 
		            	id:id, 
		            },
		            success: function (data) {
		                // console.log(data);
		                $('#reder_data').empty();
		                $('#reder_data').html(data);		                
		            }
		        });
	        });
	});
</script>
<script src="{{asset('adminpages/ajaxController/Quanlyfeeship_ajax.js')}}"></script>
@endpush
@stop