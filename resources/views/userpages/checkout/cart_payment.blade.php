@extends('userpages.layout.app')
@section('body')
<div class="main-container col2-right-layout">
	<div class="main container">
		<div class="row">
			<section class="col-main col-sm-9 wow" style="width: 100%;">
				<div class="page-title">
					<h1>Thông tin đặt hàng</h1>
				</div>
				<ol class="one-page-checkout" id="checkoutSteps">
					<li id="opc-billing" class="section allow active" >
						<div class="step-title" data-toggle="collapse" data-parent="#checkoutSteps"  href="#checkout-step-payment"> <span class="number">1</span>
							<h3>Thông tin giỏ hàng và vận chuyển</h3>
							<!--<a href="#">Edit</a> --> 
						</div>
						<div id="checkout-step-payment" class="cart panel-collapse collapse in">
							@if(Session::has('Cart'))
							<form method="post" action="" id="delete_item_in_payment">
								{{csrf_field()}}
								<input type="hidden" value="" name="form_key">
								<fieldset>
									<table class="data-table cart-table" id="shopping-cart-table">
										<colgroup>
											<col width="1">
											<col width="1">
											<col width="1">
											<col width="1">
											<col width="1">
											<col width="1">
											<col width="1">
										</colgroup>
										<thead>
											<tr class="first last">
												<th rowspan="1">&nbsp;</th>
												<th rowspan="1"><span class="nobr">Tên sản phẩm</span></th>
												<th rowspan="1"></th>
												<th rowspan="1" class="a-center" style="text-align: right; padding: 6px 30px;">Giá</th>
												<th class="a-center" rowspan="1" style="text-align: right; padding: 6px 30px;">Số lượng</th>
												<th rowspan="1" class="a-center" style="text-align: right; padding: 6px 30px;">Tổng giá</th>
												<th class="a-center" rowspan="1">&nbsp;</th>
											</tr>
										</thead>
										<tbody>
											@foreach (Session::get('Cart')->items as $item)
											<?php $price = $item['item']['product_price'] - ($item['item']['product_price'] * $item['item']['product_sale'])*0.01;  ?>
											<tr class="first odd" id="xoa_{{$item['item']['product_id']}}">
												<td class="image">
													<a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$item['item']['product_id'])}}">
														<img width="75" height="75" alt="Sample Product" src="/adminpages/images/{{$item['item']['product_image']}}">
													</a>
												</td>
												<td colspan="2">
													<h2 class="product-name"> 
														<a href="{{url('home/product_detail/'.$item['item']['product_id'])}}">{{$item['item']['product_name']}}</a> 
													</h2>
												</td>
												{{-- <td class="a-center">&nbsp;</td> --}}
												<td class="a-right" style="text-align: right;">
													<span class="cart-price"> 
														<span class="price">{{number_format($price).' '.'VNĐ'}}</span>
													</span>
												</td>
												<td class="a-center movewishlist" style="text-align: right;">
													<input disabled maxlength="12" class="input-text qty" title="Qty" size="4" value="{{$item['qty']}}" data-id="{{$item['item']['product_id']}}" type="text" style="text-align: center;" />
												</td>
												<td class="a-right movewishlist" colspan="1" style="text-align: right;">
													<span class="cart-price"> 
														<span class="price">{{number_format($item['price']).' '.'VNĐ'}}</span>
													</span>
												</td>
												<td>&nbsp;</td>
												{{-- <td class="a-center last">
													<a class="button remove-item" title="Remove item" href="#">
														<span>
															<span>Remove item</span>
														</span>
													</a>
												</td> --}}
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="cart-collaterals row">
										<div class="col-sm-4">
											<div class="discount">
												<h3>Mã giảm giá</h3>
												<form method="post" action="" id="discount-coupon-form">
													{{csrf_field()}}
													<input type="hidden" value="0" id="remove-coupone" name="remove">
													<input type="text" @if(Session::has('session_coupon')) value="{{Session::get('session_coupon')['coupon']->coupon_code}}" @else value="" @endif name="coupon_code_payment" id="coupon_code_payment" class="input-text fullwidth" placeholder="Mã giảm giá(nếu có)" style="width: 80%;">

													<button class="button repeat-coupon-payment icon-repeat" type="button" style="width:37px;height:35px;padding:3px 12px;vertical-align:unset;"></button>
													<button class="button submit-coupon-payment" type="submit"><span>Mã giảm giá</span></button>
												</form>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="shipping">
												<h3>Phí vận chuyển</h3>
												<div class="shipping-form">
													@if(Session::has('delivery'))
													<form id="shipping-zip-form-delevery" method="post" action="">
														{{csrf_field()}}
														<ul class="form-list">
															<li>
																<label class="required" for="fee_matp"><em>*</em>Tỉnh/thành phố</label>
																<div class="input-box">
																	<select title="Country" class="validate-select" id="fee_matp" name="fee_matp">
																		<option value="all">--Chọn tỉnh/thành phố</option>
																		@foreach($cities as $key => $city)
																		<option @if(Session::get('delivery')['feeship']->fee_matp==$city->matp) selected @endif value="{{$city->matp}}">{{$city->name}}</option>
																		@endforeach
																	</select>
																</div>
															</li>
															<li>
																<label class="required" for="fee_maquanhuyen"><em>*</em>Quận/Huyện</label>
																<div class="input-box">
																	<select style="" title="State/Province" name="fee_maquanhuyen" id="fee_maquanhuyen" defaultvalue="" class="required-entry validate-select">
																		<option value="all">--Chọn quận/huyện</option>
																		@foreach($provinces as $key => $province)
																		<option @if(Session::get('delivery')['feeship']->fee_maquanhuyen==$province->maqh) selected @endif value="{{$province->maqh}}">{{$province->name}}</option>
																		@endforeach
																	</select>
																	<input type="text" style="display:none;" class="input-text required-entry" title="State/Province" value="" name="region" id="region">
																</div>
															</li>
															<li>
																<label class="required" for="fee_maxaphuong"><em>*</em>Xã/Phường/Thị trấn</label>
																<div class="input-box">
																	<select style="" title="State/Province" name="fee_maxaphuong" id="fee_maxaphuong" defaultvalue="" class="required-entry validate-select">
																		<option value="all">--Chọn xã/phường</option>
																		@foreach($wards as $key => $ward)
																		<option @if(Session::get('delivery')['feeship']->fee_maxaphuong==$ward->xaid) selected @endif value="{{$ward->xaid}}">{{$ward->name}}</option>
																		@endforeach
																	</select>
																</div>
															</li>
														</ul>
														<div class="buttons-set11">
															<button class="button get-quote" id="submit-apply-delevery" title="Get a Quote" type="submit"><span>Tính phí vận chuyển</span></button>
														</div>
														<!--buttons-set11-->
													</form>
													@else
													<form id="shipping-zip-form-delevery" method="get" action="">
														{{csrf_field()}}
														<ul class="form-list">
															<li>
																<label class="required" for="fee_matp"><em>*</em>Tỉnh/thành phố</label>
																<div class="input-box">
																	<select title="Country" class="validate-select" id="fee_matp" name="fee_matp">
																		<option value="all">--Chọn tỉnh/thành phố</option>
																		@foreach($cities as $key => $city)
																		<option value="{{$city->matp}}">{{$city->name}}</option>
																		@endforeach
																	</select>
																</div>
															</li>
															<li>
																<label class="required" for="fee_maquanhuyen"><em>*</em>Quận/Huyện</label>
																<div class="input-box">
																	<select style="" title="State/Province" name="fee_maquanhuyen" id="fee_maquanhuyen" defaultvalue="" class="required-entry validate-select">
																		<option value="all">--Chọn quận/huyện</option>
																		@foreach($provinces as $key => $province)
																		<option value="{{$province->maqh}}">{{$province->name}}</option>
																		@endforeach
																	</select>
																	<input type="text" style="display:none;" class="input-text required-entry" title="State/Province" value="" name="region" id="region">
																</div>
															</li>
															<li>
																<label class="required" for="fee_maxaphuong"><em>*</em>Xã/Phường/Thị trấn</label>
																<div class="input-box">
																	<select style="" title="State/Province" name="fee_maxaphuong" id="fee_maxaphuong" defaultvalue="" class="required-entry validate-select">
																		<option value="all">--Chọn xã/phường</option>
																		@foreach($wards as $key => $ward)
																		<option value="{{$ward->xaid}}">{{$ward->name}}</option>
																		@endforeach
																	</select>
																</div>
															</li>
														</ul>
														<div class="buttons-set11">
															<button class="button get-quote" title="Get a Quote" id="submit-apply-delevery" type="submit"><span>Tính phí vận chuyển</span></button>
														</div>
														<!--buttons-set11-->
													</form>
													@endif
												</div>
											</div>
										</div>            
										<div class="totals col-sm-4">
											<h3>Tổng tiền phải thanh toán</h3>
											<table class="table shopping-cart-table-total load_in_payment" id="shopping-cart-totals-table">
												<colgroup>
													<col>
													<col width="1">
												</colgroup>
												<tfoot id="load_coupon_delivery">
													@if(Session::has('session_coupon'))
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Thành tiền</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('session_coupon')['totalprice']).' '.'VNĐ'}}</span></strong></td>
													</tr>
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Giảm giá</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">-{{number_format(Session::get('session_coupon')['total_amout']).' '.'VNĐ'}}</span></strong></td>
													</tr>
													@if(Session::has('delivery'))
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Phí vận chuyển</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('delivery')['feeship']->fee_ship).' '.'VNĐ'}}</span></strong></td>
													</tr>
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Tổng thanh toán</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('delivery')['price_amout']-Session::get('session_coupon')['total_amout']).' '.'VNĐ'}}</span></strong></td>
													</tr>
													@else
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Tổng thanh toán</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('session_coupon')['price_amout']).' '.'VNĐ'}}</span></strong></td>
													</tr>
													@endif
													@elseif(Session::has('delivery'))
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Thành tiền</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('delivery')['totalprice']).' '.'VNĐ'}}</span></strong></td>
													</tr>
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Phí vận chuyển</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('delivery')['feeship']->fee_ship).' '.'VNĐ'}}</span></strong></td>
													</tr>
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Tổng thanh toán</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('delivery')['price_amout']).' '.'VNĐ'}}</span></strong></td>
													</tr>
													@else
													<tr>
														<td colspan="1" class="a-left" style=""><strong>Thành tiền</strong></td>
														<td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('Cart')->totalPrice).' '.'VNĐ'}}</span></strong></td>
													</tr>
													@endif
												</tfoot>
											</table>
											<!--inner-->               
										</div>
									</div>
								</fieldset>
							</form>
							@else
							<div class="page-title" style="padding: 10px 60px;margin: 10px 10px;text-align: center;">
								<h2>Giỏ hàng của bạn trống</h2>
							</div>
							@endif
							<div style="clear: both;"></div>
						</div> 
					</li>
					<li id="opc-shipping_method" class="section ">
						<div class="step-title collapsed" data-toggle="collapse" data-parent="#checkoutSteps" href="#checkout-step-shipping_method"> 
							<span class="number">2</span>
							<h3 class="one_page_heading">Phương thức thanh toán</h3>
							<!--<a href="#">Edit</a>--> 
						</div>
						<div id="checkout-step-shipping_method" class="step a-item panel-collapse collapse">
							<form id="co-shipping-method-form" action="">
								{{csrf_field()}}
								<fieldset>
									<div id="checkout-shipping-method-load">
										<dl class="shipping-methods">
											<dd>
												<ul>
													<li>
														<input type="checkbox" name="shipping_method" value="COD(Thanh toán tại nhà)" id="cod"  class="radio">
														<label for="s_method_flatrate_flatrate">COD(Thanh toán tại nhà) </label>
													</li>
													<li>
														<input type="checkbox" name="shipping_method" value="aa" id="aaa"  class="radio">
														<label for="s_method_flatrate_flatrate">aaa </label>
													</li>
												</ul>
											</dd>
										</dl>
									</div>
								</fieldset>
							</form>
						</div>
					</li>
					<li id="opc-payment" class="section " >
						<div class="step-title collapsed" data-toggle="collapse" data-parent="#checkoutSteps" href="#checkout-step-billing"> 
							<span class="number">3</span>
							<h3 class="one_page_heading">Thông tin khách hàng</h3>
							<!--<a href="#">Edit</a>--> 
						</div>
						<div id="checkout-step-billing" class="step a-item panel-collapse collapse" style="">
							<form id="shipping-zip-form" method="post" action="">
								{{csrf_field()}}
								<fieldset class="group-select">
									<p>Vui lòng điền thông tin của bạn.</p>
									<ul class="form-list">
										<li>
											<label class="required" for="customer_name">Họ và Tên</label>
											<input type="text"  class="input-text required-entry" title="State/Province" value="" name="customer_name" id="customer_name" placeholder="Nhập họ tên">
										</li>
										<li>
											<label class="required" for="customer_email">Email</label>
											<input type="text"  class="input-text required-entry" title="State/Province" value="" name="customer_email" id="customer_email" placeholder="Nhập email">
										</li>
										<li>
											<label class="required" for="customer_phone">Số điện thoại</label>
											<input type="text"  class="input-text required-entry" title="State/Province" value="" name="customer_phone" id="customer_phone" placeholder="Nhập số điện thoại">
										</li>
										<li>
											<label class="required" for="customer_address">Địa chỉ</label>
											<textarea class="input-text required-entry" title="State/Province" value="" name="customer_address" id="customer_address" placeholder="Nhập địa chỉ"></textarea>
										</li>
									</ul>
									<!--buttons-set11-->
									<button type="submit" class="button continue" id="confirm_order"><span>Đặt hàng</span></button>
								</fieldset>
							</form>
						</div>
					</li>
				</ol>
			</section>
		</div>
	</div>
</div>
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

		$('.submit-coupon-payment').on('click',function(event){
			event.preventDefault();
			var coupon_code = $('#coupon_code_payment').val();           
			$.ajax({
				type:'POST', 
				url:'/cart/apply-coupon-payment/'+coupon_code,           
				success:function(response){
					if(response.success){     
      					load_payment(); 						
					}
					else{
						alert(response.message);
					}
				}
			});
		});
		$('.repeat-coupon-payment').on('click',function(event){
			event.preventDefault();
			$.ajax({
				type:'GET', 
				url:'/cart/clear-coupon-payment',           
				success:function(response){
					$('#coupon_code_payment').val('');
					load_payment();
				}
			});
		});
		$('#submit-apply-delevery').on('click',function(event){
			event.preventDefault();
			var fee_matp = $('#fee_matp').val();
			var fee_maquanhuyen = $('#fee_maquanhuyen').val();
			var fee_maxaphuong = $('#fee_maxaphuong').val();
			$.ajax({
				type:'GET', 
				url:'/cart/apply-delevery',
				datatype: 'json',
				data:{
					fee_matp: fee_matp,
					fee_maquanhuyen: fee_maquanhuyen,
					fee_maxaphuong: fee_maxaphuong,
				},           
				success:function(response){
					if(response.success){     
      					load_payment(); 						
					}
					else{
						alert(response.message);
					}
				}
			});
		});
		$('#confirm_order').on('click',function(event){
			event.preventDefault();
			// alert($('input[name="shipping_method"]:checked').val());
			var _token = $('input[name="_token"]').val();
			var fee_matp = $('#fee_matp').val();
			var fee_maquanhuyen = $('#fee_maquanhuyen').val();
			var fee_maxaphuong = $('#fee_maxaphuong').val();
			var order_payment_method = $('input[name="shipping_method"]:checked').val();
			var customer_name = $('#customer_name').val();
			var customer_phone = $('#customer_phone').val();
			var customer_address =$('#customer_address').val();
			var customer_email = $('#customer_email').val();
			// alert(customer_address);
			
			$.ajax({
				type:'POST', 
				url:'/cart/confirm_order',
				datatype: 'json',
				data:{
					fee_matp:fee_matp,
					fee_maquanhuyen: fee_maquanhuyen,
					fee_maxaphuong: fee_maxaphuong,
					order_payment_method:order_payment_method,
					customer_name:customer_name,
					customer_email:customer_email,
					customer_phone:customer_phone,
					customer_address:customer_address,
					_token:_token

				},           
				success:function(response){
					if(response.success){
						var cf = confirm('Bạn chắc chắn muốn xem trạng thái đơn hàng không?');
						if(cf){
							window.location.href="/cart/order_view/"+response.order_customer_id;
						}
						else{
							window.location.href="/home";
						}
						
					}
					else{
						alert(response.message);
						$('#fee_matp').focus();
					}
				}
			});
		});
		function load_payment(){
			$.ajax({
				type:'GET', 
				url:'/cart/load_payment',           
				success:function(response){
					$('.load_in_payment').empty();
					$('.load_in_payment').html(response);
				}
			});
		}

	});
</script>
@endsection