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

