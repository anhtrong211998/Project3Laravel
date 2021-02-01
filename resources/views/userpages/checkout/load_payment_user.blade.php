<span>Tổng tiền <b style="padding-left: 33px;">: =</b> </span><span class="price" style="float:right;margin-right: 13%;">{{number_format(Session::get('Cart')->totalPrice).' '.'(đ)'}}</span><br>
@if(Session::has('session_coupon'))
<span>Giảm giá</span><b style="padding-left: 40px;">: -</b><span class="price" style="float:right;margin-right: 13%;">{{number_format(Session::get('session_coupon')['total_amout']).' '.'(đ)'}}</span><br>
@else
<span>Giảm giá</span><b style="padding-left: 40px;">: -</b><span class="price" style="float:right;margin-right: 13%;">0 (đ)</span><br>
@endif
<span>Phí vận chuyển</span><b style="padding-left: 9px;">: +</b><span class="price" style="float:right;margin-right: 13%;">{{number_format($feeship->Feeship->fee_ship).' '.'(đ)'}}</span><br>
<?php
if(Session::has('session_coupon')){
	$totalprice = Session::get('Cart')->totalPrice + $feeship->Feeship->fee_ship - Session::get('session_coupon')['total_amout'];
}
else{
	$totalprice = Session::get('Cart')->totalPrice + $feeship->Feeship->fee_ship;
}
?>
<span>Tổng thanh toán <b>: =</b> </span><span class="price" style="float:right;margin-right: 13%;">{{number_format($totalprice).' '.'(đ)'}}</span>