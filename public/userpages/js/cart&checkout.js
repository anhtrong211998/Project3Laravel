//ajax for cart-shopping
$('.btn-cart').off('click').on('click', function () {
	var id = $(this).data('id');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type:'GET',
		url:'/add-to-cart/'+id,             
		dataType: 'json',
		success:function(data){
			if(data.success){
				alert(data.message);
				load_cart();
			}
			else{
				alert(data.message);
			}
			// $('#top-cart-render').empty();
			// $('#top-cart-render').html(data);
			// $('#cart-total').text($('#total-quanty-cart').val());
		}
	});
});
$('#top-cart-render').on('click','.deleteCart',function(){
	var id = $(this).data('id');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type:'GET',
		url:'/delete-item-cart/'+id,            
		dataType: 'html',
		success:function(data){
			load_cart();
			load_checkout();
			html='<div class="page-title" style="padding: 10px 60px;margin: 10px 10px;text-align: center;">';
			html+='<h2>Giỏ hàng của bạn trống</h2>';
			html+='</div>';
			$('#xoa_'+id).remove();
			var total_in_payment = $('#delete_item_in_payment tbody tr').length;
			// alert(total_in_payment);
			if(total_in_payment > 0){
				load_payment();
			}
			else{				
				$('#checkout-step-payment').empty();
            	$('#checkout-step-payment').html(html);
			}
		}
	});
});
function load_cart(){
	$.ajax({
		type:'GET', 
		url:'/load_cart',           
		success:function(response){
			$('#top-cart-render').empty();
			$('#top-cart-render').html(response);
			$('#cart-total').text($('#total-quanty-cart').val());
		}
	});
}
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
function load_checkout(){
	$.ajax({
		type:'GET', 
		url:'/cart/load_checkout',           
		success:function(response){
			$('#render_checkout').empty();
			$('#render_checkout').html(response);
			$('#cart-total').text($('#total-quanty-cart').val());
			// $('#cart_total_price').text($('#totalprice').data('id')); 
		}
	});
}
//ajax for checkout-shopping
$('#render_checkout').on('change','.edit-qty',function(){
	// console.log($(this).data('id'));
	var id = $(this).data('id');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type:'GET',
		url:'/cart/edit-item-cart/'+id+'/'+$(this).val(),            
		dataType: 'json',
		success:function(data){
			if(data.success){
				load_checkout();
				load_cart();
			}
			else{
				alert(data.message);
				load_checkout();
				load_cart();
			}
			
			// $('#cart_item_quanty_'+id).text($('#change-qty_'+id).val());
		}
	});
});
$('#render_checkout').on('click','.remove-item',function(event){
	// console.log($(this).data('id'));
	event.preventDefault();
	var id = $(this).data('id');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type:'GET',
		url:'/cart/delete-item-checkout-cart/'+id,            
		dataType: 'html',
		success:function(data){
			load_cart();
			load_checkout();
		}
	});
});