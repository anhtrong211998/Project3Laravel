@extends('admin.layouts.master')
@section('content')
	<div class="page-header">
		<ol class="breadcrumb">
		  	<li><a href="#">Trang chủ</a></li>
		  	<li><a href="#">Sản phẩm</a></li>
		  	<li class="active">Thêm mới</li>
		</ol>
	</div>
	
	<div class="">
		<form action="/admin/product/save" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="hidden" class="form-control" name="product_id" id="product_id" value="">
			<div class="row">	
				<div class="col-sm-7" style="padding: 10px; border: 1px solid #dedede;">
					<div class="form-group">
						<label for="category_id">Danh mục sản phẩm:</label>
						<select name="category_id" id="category_id" class="custom-select form-control">
							<option value="all">--Chọn danh mục---</option>
							@foreach($category as $key=>$value)
							<option value="{{$value->category_id}}">{{$value->category_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="catetory_product_id">Loại sản phẩm:</label>
						<select name="catetory_product_id" id="catetory_product_id" class="custom-select form-control">
							<option value="">--Chọn loại sản phẩm---</option>
							@foreach($catetory as $key=>$value)
							<option value="{{$value->catetory_id}}">{{$value->catetory_name}}</option>
							@endforeach
						</select>
						@if($errors->has('catetory_product_id'))
						<label class="error" for="catetory_product_id">{{$errors->first('catetory_product_id')}}</label>
						@endif
					</div>
					<div class="form-group">
						<label for="product_name">Tên sản phẩm:</label>
						<input type="text" class="form-control" id="product_name" placeholder="Tên sản phẩm" name="product_name">
						@if($errors->has('product_name'))
						<label class="error" for="product_name">{{$errors->first('product_name')}}</label>
						@endif
					</div>
					<div class="form-group">
						<label for="product_price">Giá bán:</label>
						<input type="text" class="form-control" id="product_price" placeholder="Giá bán" name="product_price">
						@if($errors->has('product_price'))
						<label class="error" for="product_price">{{$errors->first('product_price')}}</label>
						@endif
					</div>
					<div class="form-group">
						<label for="product_sale">Giảm giá:</label>
						<input type="text" class="form-control" id="product_sale" placeholder="% Giảm giá(nếu có) ...." name="product_sale">
						@if($errors->has('product_sale'))
						<label class="error" for="product_sale">{{$errors->first('product_sale')}}</label>
						@endif
					</div>
					<div class="form-group">
						<label for="product_quantity">Số lượng:</label>
						<input type="text" class="form-control" id="product_quantity" placeholder="Số lượng sản phẩm" name="product_quantity">
						@if($errors->has('product_quantity'))
						<label class="error" for="product_quantity">{{$errors->first('product_quantity')}}</label>
						@endif
					</div>
					<div class="form-group">
						<label for="product_content">Nội dung:</label>
						<textarea name="product_content" id="product_content" class="form-control" cols="30" rows="3" placeholder="Nội dung về sản phẩm...."></textarea>
						@if($errors->has('product_content'))
						<label class="error" for="product_content">{{$errors->first('product_content')}}</label>
						@endif
					</div>
					<div class="form-group">
                        <label for="product_status">Hiển thị</label>
                        <select name="product_status" class="form-control custom-select" id="product_status">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>
                        </select>

                    </div>
				</div>
				<div class="col-sm-5" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
					<div class="form-group">
						<img src="/article/images_default.png" alt="" style="width: 68%;height: 235px;" id="output_img">
					</div>
					<div class="form-group">
	                    <label for="product_image">Hình ảnh sản phẩm</label>
	                    <input type="file" name="product_image" class="form-control" id="product_image" placeholder="hình ảnh minh họa của sản phẩm....">
	                </div>
					<div class="form-group">
						<label for="product_desc">Mô tả:</label>
						<textarea name="product_desc" id="product_desc" class="form-control" cols="30" rows="3" placeholder="Mô tả ngắn gọn"></textarea>
						@if($errors->has('product_desc'))
						<label class="error" for="product_desc">{{$errors->first('product_desc')}}</label>
						@endif
					</div>
					
	                
					
					<div class="form-group">
						<label for="provider_product_id">Nhà cung cấp:</label>
						<select name="provider_product_id" id="provider_product_id" class="custom-select form-control">
							<option value="">--Chọn nhà cung cấp---</option>
							@foreach($provider as $key=>$value)
							<option value="{{$value->provider_id}}">{{$value->provider_name}}</option>
							@endforeach
						</select>
						@if($errors->has('provider_product_id'))
						<label class="error" for="provider_product_id">{{$errors->first('provider_product_id')}}</label>
						@endif
					</div>
					<div class="form-group">
						<label for="brand_product_id">Nhãn hiệu:</label>
						<select name="brand_product_id" id="brand_product_id" class="custom-select form-control">
							<option value="">--Chọn nhãn hiệu---</option>
							@foreach($brand as $key=>$value)
							<option value="{{$value->brand_id}}">{{$value->brand_name}}</option>
							@endforeach
						</select>
						@if($errors->has('brand_product_id'))
						<label class="error" for="brand_product_id">{{$errors->first('brand_product_id')}}</label>
						@endif
					</div>
					<div class="form-group select-box" id="search-brand-select" style="display: none;">
						<input type="text" id="custom-select-search" class="custom-select form-control" autocomplete="off">
						<div class="options-container" style="display:none;">
							@foreach($brand as $key=>$value)
							<div class="option" data-id={{$value->brand_id}}>
								<input type="radio" class="radio-search" name="brandsearch" id="brandsearch_{{$value->brand_id}}" />
								<label for="brandsearch_{{$value->brand_id}}">{{$value->brand_name}}</label>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-default" style="margin:9px 0;">Lưu thông tin</button>
		</form>
	</div>
@stop
@push('jsmore')
	<script>
         
	       // Replace the <textarea id="editor1"> with a CKEditor
	       // instance, using default configuration.
	        CKEDITOR.replace('product_desc');
	        CKEDITOR.replace('product_content');
	        
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
	$("#product_image").change(function(){
			readURL(this);
	});
</script>
	<script>
		$(document).ready(function(){
			// $('#custom-select').editableSelect();
			$('#brand_product_id').on('click',function() {
				$(this).hide();
				$('#search-brand-select').show();
				
			});
			$('#custom-select-search').on('click',function(){
				$(this).val('');
				$('.options-container').toggleClass('show');
			});
			$('#custom-select-search').on('keyup',function(){
				$('.options-container').toggleClass('show');
				console.log($(this).parent().find('.option').length);
				var optionsList =$('#custom-select-search').parent().find('.option');
				for (i = 0; i < optionsList.length; i++) {
				    var txtValue = optionsList[i].textContent || optionsList[i].innerText;
				    if (txtValue.toUpperCase().indexOf($(this).val().toUpperCase()) > -1){
				      optionsList[i].style.display = "";
				    } else {
				      optionsList[i].style.display = "none";
				    }
				}
				
			});
			$('.option').on('click',function () {
				var id = $(this).data('id');
				$('#brand_product_id').show();
				$('#search-brand-select').hide();
				$('#brand_product_id').val(id);
			});
			$("#category_id").change(function(){
	            var categoryID = $(this).val();
	            $.ajax({
		            url: '/admin/product/getcatetory/'+categoryID,
		            type: 'GET',
		            success: function (data) {
		                $("#catetory_product_id").html(data);		                
		            }
		        });
	        });
			
		});
	</script>

@endpush