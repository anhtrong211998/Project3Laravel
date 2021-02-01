<div id="top-cart-render">
@if(Session::has('Cart') != null)
<div class="block-subtitle">Mục đã thêm gần đây</div>
<ul id="cart-sidebar" class="mini-products-list">

	@foreach (Session::get('Cart')->items as $item)
	<?php $price = $item['item']['product_price'] - ($item['item']['product_price'] * $item['item']['product_sale'])*0.01;  ?>
	<li class="item even" id="xoa_item_{{$item['item']['product_id']}}">
		<a class="product-image" href="{{url('home/product_detail/'.$item['item']['product_id'])}}" title="Downloadable Product "><img alt="Sample Product" src="{{URL::to('/')}}/adminpages/images/{{$item['item']['product_image']}}" width="50" style="height: 50px;margin-top: -13px;"></a>
		<div class="detail-item">	
			<div class="product-details">
				<span title="Remove This Item" data-id="{{$item['item']['product_id']}}" class="icon-remove deleteCart">&nbsp;</span>
				<p class="product-name"><a href="{{url('home/product_detail/'.$item['item']['product_id'])}}" title="Downloadable Product">{{$item['item']['product_name']}}</a></p>
			</div>
			<div class="product-details-bottom">
				<span class="price">{{number_format($price).' '.'VNĐ'}}</span>
				<span class="title-desc">Qty:</span><strong id="cart_item_quanty_{{$item['item']['product_id']}}">{{$item['qty']}}</strong>
			</div>
		</div>
	</li>
	@endforeach                                          
</ul>
<div class="top-subtotal">Tổng tiền: <span class="price" id="cart_total_price">{{number_format(Session::get('Cart')->totalPrice).' '.'VNĐ'}}</span>
</div>
<div class="actions">
	<button class="btn-checkout" type="button"><a href="/cart/checkout"><span>Xem Giỏ Hàng</span></a></button>
</div>
@endif
<input hidden type="number" 
@if(Session::has('Cart') != null)
value="{{Session::get('Cart')->totalQty}}" 
@else
value="0" 
@endif
id="total-quanty-cart" />

</div>