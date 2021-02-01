@extends('userpages.layout.app')
@section('body')
<section class="main-container col1-layout">
      <div class="main container">
            <div class="col-main">
                  <div class="cart wow" id="render_checkout">
                        @if(Session::has('Cart'))
                        <div class="page-title">
                              <h2>Giỏ hàng của bạn</h2>
                        </div>
                        <div class="table-responsive">
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
                                                      <th rowspan="1" class="a-center" style="text-align: right; padding-right: 60px;">Tổng giá</th>
                                                      <th class="a-center" rowspan="1">Xóa</th>
                                                </tr>
                                          </thead>
                                          <tfoot>
                                                <tr class="first last">
                                                      <td class="a-right last" colspan="50">
                                                            <div class="col-sm-4">
                                                                  <button class="button btn-continue" title="Continue Shopping" type="button">
                                                                        <a href="/home/">
                                                                              <span>Tiếp tục mua sắm</span>
                                                                        </a>
                                                                  </button>
                                                            </div>
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
                                                            <div class="totals col-sm-4">
                                                                  <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                                                                        <colgroup>
                                                                              <col>
                                                                              <col width="1">
                                                                        </colgroup>
                                                                        <tfoot id="show_coupon">
                                                                              <tr>
                                                                                    <td colspan="1" class="a-left" style=""><strong>Thành tiền</strong></td>
                                                                                    <td class="a-right" style="text-align: right;"><strong><span class="price" id="totalprice" data-id="{{Session::get('session_coupon')['totalprice']}}">{{number_format(Session::get('session_coupon')['totalprice']).' '.'VNĐ'}}</span></strong></td>
                                                                              </tr>
                                                                              <tr>
                                                                                    <td colspan="1" class="a-left" style=""><strong>Giảm giá</strong></td>
                                                                                    <td class="a-right" style="text-align: right;"><strong><span class="price">-{{number_format(Session::get('session_coupon')['total_amout']).' '.'VNĐ'}}</span></strong></td>
                                                                              </tr>
                                                                              <tr>
                                                                                    <td colspan="1" class="a-left" style=""><strong>Tổng tiền</strong></td>
                                                                                    <td class="a-right" style="text-align: right;"><strong><span class="price">{{number_format(Session::get('session_coupon')['price_amout']).' '.'VNĐ'}}</span></strong></td>
                                                                              </tr>
                                                                        </tfoot>
                                                                  </table>
                                                                  @if(Auth::check())
                                                                  <a href="/cart/user_cart_payment" class="button btn-checkout" title="Proceed to Checkout" style="float: right;">Thanh toán</a>
                                                                  @else
                                                                  <a href="/cart/cart_payment" class="button btn-checkout" title="Proceed to Checkout" style="float: right;">Thanh toán</a>
                                                                  @endif
                                                            </div>
                                                            @else
                                                            <div class="col-sm-4">
                                                                  <div class="discount">
                                                                        <form method="post" action="">
                                                                              {{csrf_field()}}
                                                                              <input type="text" value="" name="coupon_code" id="coupon_code" placeholder="Mã giảm giá(nếu có)" class="input-text fullwidth" style="width:80%;">
                                                                              <button class="button repeat-coupon icon-repeat" type="button" style="width:37px;height:38px;padding:3px 12px;vertical-align:unset;"></button>
                                                                              <button class="button submit-coupon " type="submit"><span>Mã giảm giá</span></button>
                                                                        </form>
                                                                  </div>
                                                            </div>
                                                            <div class="totals col-sm-4">
                                                                  <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                                                                        <colgroup>
                                                                              <col>
                                                                              <col width="1">
                                                                        </colgroup>
                                                                        <tfoot id="show_coupon">  
                                                                              <tr>
                                                                                    <td colspan="1" class="a-left" style=""><strong>Thành tiền</strong></td>
                                                                                    <td class="a-right" style=""><strong><span class="price" id="totalprice" data-id="{{Session::get('Cart')->totalPrice}}">{{number_format(Session::get('Cart')->totalPrice).' '.'VNĐ'}}</span></strong></td>
                                                                              </tr>  
                                                                        </tfoot>
                                                                  </table>
                                                                  @if(Auth::check())
                                                                  <a href="/cart/user_cart_payment" class="button btn-checkout" title="Proceed to Checkout" style="float: right;">Thanh toán</a>
                                                                  @else
                                                                  <a href="/cart/cart_payment" class="button btn-checkout" title="Proceed to Checkout" style="float: right;">Thanh toán</a>
                                                                  @endif
                                                            </div>
                                                            @endif
                                                      </td>
                                                </tr>
                                          </tfoot>
                                          <tbody id="total_item_checkout">
                                                @foreach (Session::get('Cart')->items as $item)
                                                <?php $price = $item['item']['product_price'] - ($item['item']['product_price'] * $item['item']['product_sale'])*0.01;  ?>
                                                <tr class="first odd" id="xoa_{{$item['item']['product_id']}}">
                                                      <td class="image" >
                                                            <a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$item['item']['product_id'])}}">
                                                                  <img width="75" height="75" alt="Sample Product" src="/adminpages/images/{{$item['item']['product_image']}}">
                                                            </a>
                                                      </td>
                                                      <td colspan="2">
                                                            <h2 class="product-name">
                                                                  <a href="{{url('home/product_detail/'.$item['item']['product_id'])}}">{{$item['item']['product_name']}}</a>
                                                            </h2>
                                                      </td>
                                                      <td class="a-right" style="text-align: right;">
                                                            <span class="cart-price">
                                                                  <span class="price" >{{number_format($price).' '.'VNĐ'}}</span>
                                                            </span>
                                                      </td> 
                                                      <td class="a-center movewishlist" style="text-align: right;">
                                                            <input maxlength="12" class="input-text edit-qty" title="Qty" size="4" value="{{$item['qty']}}" data-id="{{$item['item']['product_id']}}" type="number" id="change-qty_{{$item['item']['product_id']}}">
                                                      </td>
                                                      <td class="a-right movewishlist" style="text-align: right;padding-right:40px;">
                                                            <span class="cart-price">
                                                                  <span class="price" id="price-total">{{number_format($item['price']).' '.'VNĐ'}}</span>
                                                            </span>
                                                      </td>
                                                      <td class="a-center last">
                                                            <a class="button remove-item" title="Remove item" href="" data-id="{{$item['item']['product_id']}}">
                                                                  <span>
                                                                        <span>Remove item</span>
                                                                  </span>
                                                            </a>
                                                      </td>
                                                </tr>
                                                @endforeach
                                          </tbody>
                                    </table>
                              </fieldset>
                        </div>
                        @else
                        <div class="page-title" style="padding: 10px 60px;margin: 10px 10px;text-align: center;">
                              <h2>Giỏ hàng của bạn trống</h2>
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
            </div>
      </div>
</section>
<script>
      $(document).ready(function(){
            $.ajaxSetup({
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            $('#render_checkout').on('click','.submit-coupon',function(){
                  event.preventDefault();
                  var coupon_code = $('#coupon_code').val();           
                  $.ajax({
                        type:'POST', 
                        url:'/cart/apply-coupon/'+coupon_code,           
                        success:function(response){
                              if(response.success){ 
                                    load_checkout(); 
                              }
                              else{
                                    alert(response.message);
                              }
                        }
                  });
            });

            $('#render_checkout').on('click','.repeat-coupon',function(){
                  event.preventDefault();
                  $.ajax({
                        type:'GET', 
                        url:'/cart/clear-coupon',           
                        success:function(response){  
                              load_checkout();
                        }
                  });
            });
            function load_checkout(){
                  $.ajax({
                        type:'GET', 
                        url:'/cart/load_checkout',           
                        success:function(response){
                              $('#render_checkout').empty();
                              $('#render_checkout').html(response);
                              $('#cart-total').text($('#total-quanty-cart').val());
                        }
                  });
            }
      });
</script>
@endsection