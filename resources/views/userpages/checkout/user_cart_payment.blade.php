@extends('userpages.layout.app')
@section('body')
<div class="main-container col2-right-layout">
	<div class="main container">
		@if(Session::has('Cart'))
		<div class="row">
			<section class=" col-sm-9 wow">
				<div class="page-title">
					<h1>Checkout</h1>
				</div>
				<ol class="one-page-checkout" id="checkoutSteps">
					<li id="opc-billing" class="section allow active">
						<div class="step-title"> <span class="number">1</span>
							<h3>Checkout Method</h3>
							<!--<a href="#">Edit</a> --> 
						</div>
						<div id="checkout-step-payment" class="cart">
							<form method="post" action="/cart/user_confirm_order">
								@csrf
								<input type="hidden" value="COD(Thanh toán tại nhà)" name="order_payment_method" id="order_payment_method">
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
										<tfoot>
											<tr class="first last">
												<td class="a-right last" colspan="50">
													<div class="col-sm-4"></div>
													@if(Session::has('session_coupon'))
                                                    <div class="col-sm-4">
                                                        <div class="discount">
                                                            <form method="post" action="">
                                                                {{csrf_field()}}
                                                                <input type="text" value="{{Session::get('session_coupon')['coupon']->coupon_code}}" name="coupon_code" id="coupon_code" class="input-text fullwidth" placeholder="Mã giảm giá(nếu có)" style="width:80%;">
                                                                <button class="button repeat-coupon icon-repeat" type="button" style="width:37px;height:38px;padding:3px 12px;vertical-align:unset;"></button>
                                                                <button class="button submit-coupon " type="submit"><span>Mã giảm giá</span></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @else
													<div class="col-sm-4">
														<div class="discount">
                                                            <form method="post" action="">
                                                                {{csrf_field()}}
                                                                <input type="text" value="" name="coupon_code" id="coupon_code" class="input-text fullwidth" placeholder="Mã giảm giá(nếu có)" style="width:80%;">
                                                                <button class="button repeat-coupon icon-repeat" type="button" style="width:37px;height:38px;padding:3px 12px;vertical-align:unset;"></button>
                                                                <button class="button submit-coupon " type="submit"><span>Mã giảm giá</span></button>
                                                            </form>
                                                        </div>
													</div>
													@endif
													<div class="totals col-sm-4">
														<table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
															<colgroup>
																<col>
																<col width="1">
															</colgroup>
															<tfoot id="show_coupon">  
																<tr>
																	<td colspan="1" class="a-left" style="">&nbsp;</td>
																	<td class="a-right" style=""><strong><span class="price" id="totalprice" >&nbsp;</span></strong></td>
																</tr>  
															</tfoot>
														</table>
														<button class="button btn-checkout" title="Proceed to Checkout" type="submit" style="float: right;"><span>Đặt hàng</span></button>
													</div>
												</td>
											</tr>
										</tfoot>
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
														<span class="price">{{number_format($price).' '.'(đ)'}}</span>
													</span>
												</td>
												<td class="a-center movewishlist" style="text-align: right;">
													<input disabled maxlength="12" class="input-text qty" title="Qty" size="4" value="{{$item['qty']}}" data-id="{{$item['item']['product_id']}}" type="text" style="text-align: center;" />
												</td>
												<td class="a-right movewishlist" colspan="1" style="text-align: right;">
													<span class="cart-price"> 
														<span class="price">{{number_format($item['price']).' '.'(đ)'}}</span>
													</span>
												</td>
												<td>&nbsp;</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</fieldset>
							</form>
							<div style="clear: both;"></div>
						</div>
					</li>
				</ol>
			</section>
			<aside class="col-right sidebar col-sm-3 wow">
				<div class="block block-progress">
					<div class="block-title ">Your Checkout</div>
					<div class="block-content">
						<dl>
							<dt class="complete"> Thông tin vận chuyển <span class="separator">|</span> <a class="js_change_shipping" href="#" value="fee_ship">Change</a> </dt>
							<dd class="complete">
								<address>
									{{Auth::user()->name}}.<br>
									
									Email: {{Auth::user()->email}} <br>
									Số điệ thoại: {{Auth::user()->phone}}<br>
									{{$feeship->f_u_address}}
								</address>
							</dd>
							<dt class="complete"> Phương thức vận chuyển <span class="separator">|</span> <a href="#" class="js_change_shipping" data-value="method">Change</a> </dt>
							<dd class="complete"> COD(Thanh toán tại nhà)</dd>
							<dt> <span>Tổng tiền thanh toán</span></dt>
							<dd id="render_user_cart">
								<span>Tổng tiền <b style="padding-left: 33px;">: =</b> </span><span class="price" style="float:right;margin-right: 13%;">{{number_format(Session::get('Cart')->totalPrice).' '.'(đ)'}}</span><br>
								@if(Session::has('session_coupon'))
								<span>Giảm giá</span><b style="padding-left: 40px;">: -</b><span class="price" style="float:right;margin-right: 13%;">{{number_format(Session::get('session_coupon')['total_amout']).' '.'(đ)'}}</span><br>
								@else
								<span>Giảm giá</span><b style="padding-left: 40px;">: -</b><span class="price" style="float:right;margin-right: 13%;">0 (đ)</span><br>
								@endif
								<span>Phí vận chuyển</span><b style="padding-left: 9px;">: +</b><span class="price" style="float:right;margin-right: 13%;">
									@if($feeship->f_u_fee_id != 0)
									{{number_format($feeship->Feeship->fee_ship).' '.'(đ)'}}
									@else
									{{number_format(50000).' '.'(đ)'}}
									@endif
								</span><br>
								<?php
								if(Session::has('session_coupon')){
									$totalprice = Session::get('Cart')->totalPrice + $feeship->Feeship->fee_ship - Session::get('session_coupon')['total_amout'];
								}
								else{
									$totalprice = Session::get('Cart')->totalPrice + $feeship->Feeship->fee_ship;
								}
								?>
								<span>Tổng thanh toán <b>: =</b> </span><span class="price" style="float:right;margin-right: 13%;">{{number_format($totalprice).' '.'(đ)'}}</span>
							</dd>
						</dl>
					</div>
				</div>
			</aside>
		</div>
		@else
		<div class="row">
			<section class=" col-sm-9 wow">
				<div class="page-title">
					<h1 style="text-align: center;">Giỏ hàng của bạn trống</h1>
				</div>
			</section>
		</div>
		@endif
	</div>
</div>
<script>
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('.submit-coupon').on('click',function(event){
			event.preventDefault();
			var coupon_code = $('#coupon_code').val();           
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
		function load_payment(){
			$.ajax({
				type:'GET', 
				url:'/cart/load_payment_user',           
				success:function(response){
					$('#render_user_cart').empty();
					$('#render_user_cart').html(response);
				}
			});
		}
	});
</script>
@endsection
