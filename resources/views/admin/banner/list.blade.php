@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Banner</a></li>
		  	<li class="active">Danh sách</li>
		</ol>
	</div>
	<div class="row">
		<div class="form-group col-sm-3">
			<select name="categoryselect" id="categoryselect" class="custom-select form-control">
				<option value="">--Chọn danh mục--</option>
                @foreach($categories as $key => $category)
                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                @endforeach
			</select>
		</div>
		<div class="form-group col-sm-2"></div>
			
		<div class="col-sm-4" style="float:right;">
			<form class="form-inline" action="" method="GET" style="margin-bottom: 20px;">
				{{csrf_field()}}
				<div class="form-group">
					<input type="text" class="form-control" id="name_search" name="name_search" placeholder="Nhập tên cần tìm...." name="email">
				</div>
				<button type="submit" class="btn btn-default" id="btnSearchSS"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	
	<div class="table-responsive">
		<h2 style="margin-top:5px;margin-bottom:15px;font-size:28px;font-weight:600;">Quản lý banner <a href="#" class="pull-right js_add_item" ><i class="fa fa-plus-circle"></i></a></h2>
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
							<img src="/article/images_default.png" alt="" style="width: 150px;height: 60px;" >
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
							<a style="padding: 3px 10px;border:1px solid #999;font-size: 12px" href="/admin/banner/delete/{{$item->banner_id}}"  class="styling-delete"><i style="font-size: 12px;" class="fa fa-times text-danger text-active">Delete</i></a>
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
		        	<form action="" method="POST"  enctype="multipart/form-data" id="btnSave">
						@csrf
						<div class="row">
							<input type="hidden" class="form-control" name="hiddenid" id="hiddenid" value="0">
							<div class="col-sm-1"></div>
							<div class="col-sm-6" style="padding: 10px; border: 1px solid #dedede;">
								<div class="form-group">
									<label for="banner_desc">Mô tả:</label>
									<textarea name="banner_desc" id="banner_desc" class="form-control" rows="3" placeholder="Mô tả ngắn gọn"></textarea>
								</div>
				                <div class="form-group">
			                        <label for="banner_status">Hiển thị</label>
			                        <select name="banner_status" class="form-control custom-select" id="banner_status">
			                            <option value="0">Ẩn</option>
			                            <option value="1">Hiển thị</option>
			                        </select>
			                    </div>
								<div class="form-group">
									<label for="category_banner_id">Danh mục sản phẩm:</label>
									<select name="category_banner_id" id="category_banner_id" class="custom-select form-control">
										<option value="">--Chọn danh mục--</option>
						                @foreach($categories as $key => $category)
						                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
						                @endforeach
									</select>
								</div>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
							<div class="col-sm-4" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
								<div class="form-group">
									<img src="/article/images_default.png" alt="" style="width: 100%;height: 173px;" id="output_img">
								</div>
								<div class="form-group">
				                    <label for="banner_image">Hình ảnh</label>
				                    <input type="file" name="banner_image" class="form-control" id="banner_image" placeholder="hình ảnh minh họa ....">
				                </div>
				                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				                <input type="hidden" class="form-control" name="hidID" id="hidID" value="0">
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
	function readURL(input) {
		if(input.files && input.files[0]) {
	    	var reader = new FileReader();
	    	reader.onload = function(e) {
			$('#output_img').attr('src', e.target.result);
			}	
	    	reader.readAsDataURL(input.files[0]); // convert to base64 string
	  	}
	}
	$("#banner_image").change(function(){
			readURL(this);
	});
</script>
<script>
        $(document).ready(function(){
            // alert('đã chạy được');
            $("#categoryselect").change(function(){
                var id = $(this).val();
            	var name_search = $('#name_search').val();
                // alert(categoryID);
                $.ajax({
		            url: '/admin/banner/load-data',
		            type: 'GET',
		            dataType: 'html',
		            data: { 
		                id:id,             
		                name_search: name_search  
		            },
		            success: function (data) {
		                // console.log(data);
		                $('#reder_data').html(data);
		                
		            }
		        });
            });

        });
    </script>
<script src="{{asset('adminpages/ajaxController/Quanlybanner_ajax.js')}}"></script>
@endpush
@stop