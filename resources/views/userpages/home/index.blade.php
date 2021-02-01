 @extends('userpages.layout.app')
 @section('body')
   <!-- Slider -->
  @include('userpages.layout.slider')
  <!-- end Slider --> 
  <!-- header service -->
  	<div class="header-service">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-3 col-sm-6 col-xs-12" style="margin-left: 7%">
  					<div class="content">
  					<div class="icon-truck">&nbsp;</div>
  					<span><strong>GIAO HÀNG MIỄN PHÍ</strong> CHO ĐƠN HÀNG TRÊN 250000VNĐ</span></div>
  				</div>
  				<div class="col-lg-3 col-sm-6 col-xs-12">
  					<div class="content">
  						<div class="icon-support">&nbsp;</div>
  						<span><strong>HỖ TRỢ KHÁCH HÀNG</strong> DỊCH VỤ</span>
  					</div>
  				</div>
  				<div class="col-lg-3 col-sm-6 col-xs-12">
  					<div class="content">
  						<div class="icon-money">&nbsp;</div>
  						<span><strong>TIỀN TRONG 3 NGÀY</strong>ĐẢM BẢO HOÀN</span>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  <!-- end header service --> 
 <!-- main container -->
<section class="main-container col1-layout home-content-container">
	<div class="container">
		<div class="row">
			<div class="std">
				@include('userpages.layout.product_new')
				<div class="col-sm-4 custom-slider" style="padding-top: 30px">
					<div>
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
							<!-- Indicators -->
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-generic" data-slide-to="1"></li>
								<li data-target="#carousel-example-generic" data-slide-to="2"></li>
							</ol>

							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<div class="item active"><img src="{{asset('userpages/images/b3.jpg')}}" alt="slide1">
									<div class="carousel-caption">
										<h3><a href="product_detail.html" title=" Sample Product">Lựa chọn thông minh</a></h3>
										<p>Luôn mang đến sản phẩm chính hãng, thời trang, phong cách và sang trọng.</p>
									</div>
								</div>
								<div class="item"> <img src="{{asset('userpages/images/b4.jpg')}}" alt="slide2">
									<div class="carousel-caption">
										<h3><a href="product_detail.html" title=" Sample Product">Thỏa thích mua sắm</a></h3>
										<p>Với nhiều ưu đãi hấp dẫn, thể loại đa dạng cho bạn chìm đắm trong sự mua sắm này.</p>
									</div>
								</div>
								<div class="item"> <img src="{{asset('userpages/images/slide3.jpg')}}" alt="slide3">
									<div class="carousel-caption">
										<h3><a href="product_detail.html" title=" Sample Product">Hạnh phúc mỗi ngày</a></h3>
										<p>Mang đến sự phục vụ chu đáo, tận tình để bạn thỏa mãn khi mua sắm ở Inspire .</p>
									</div>
								</div>
							</div>

							<!-- Controls --> 
							<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> 
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span> 
							</a> 
							<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> 
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span> 
							</a> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End main container -->  
<!-- recommend slider -->
<section class="recommend container">
    <div class="new-pro-slider" style="overflow:visible">
      <div class="slider-items-products">
        <div class="new_title center">
           <div class="category-products">
            <div class="toolbar">
              <h2>SẢN PHẨM ĐÁNG MUA</h2>
            </div>
            <ul class="products-grid">
              @foreach($item as $key => $sp)
              @if($sp->product_sale > 0)
              <?php $newprice =$sp->product_price - ($sp->product_sale * $sp->product_price)*0.01; ?>
              <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <div class="col-item">
                  <div class="sale-label sale-top-right">Sale {{$sp->product_sale}} %</div>
                  <div class="images-container"> 
                    <a class="product-image"  title="Sample Product" href="{{url('home/product_detail/'.$sp->product_id)}}"> 
                      <img src="/adminpages/images/{{$sp->product_image}}" class="img-responsive" style="width: 100%;height: 239px;" alt="a" /> 
                    </a>
                    <div class="actions">
                      <div class="actions-inner">
                        <button type="button" title="Add to Cart" class="button btn-cart" data-id="{{$sp->product_id}}"><span>Thêm vào giỏ hàng</span></button>
                      </div>
                    </div>
                    <div class="qv-button-container"> 
                      <a class="qv-e-button btn-quickview-1" href="{{url('home/product_detail/'.$sp->product_id)}}"><span><span>Xem</span></span></a> 
                    </div>
                  </div>
                  <div class="info">
                    <div class="info-inner">
                      <div class="item-title"> <a title=" Sample Product" href="{{url('home/product_detail/'.$sp->product_id)}}"> {{$sp->product_name}} </a> </div>
                      <!--item-title-->
                      <div class="item-content">
                        @if($sp->rating_product_total >0)
                        <?php $total = round($sp->product_total_rating/$sp->rating_product_total,2); ?>
                        <div class="ratings" style="display: flex;">
                          <ul style="display: flex;font-size: 15px;">
                            @for($i=1; $i<=5;$i++)
                            <li><i class="icon-star {{$i <= $total ? 'active':''}}"></i></li>
                            @endfor
                          </ul>
                        </div>
                        @else
                        <div class="ratings" style="display: flex;">
                          <ul style="display: flex;font-size: 15px;">
                            @for($i=1; $i<=5;$i++)
                            <li><i class="icon-star"></i></li>
                            @endfor
                          </ul>
                        </div>
                        @endif
                        <div class="price-box">
                          <p class="special-price"> <span class="price"> {{number_format($newprice).' '.'VNĐ'}} </span> </p>
                          <p class="old-price"> <span class="price-sep">-</span> <span class="price"> {{number_format($sp->product_price).' '.'VNĐ'}} </span> </p>
                        </div>
                      </div>
                      <!--item-content--> 
                    </div>
                    <div class="clearfix"> </div>
                  </div>
                </div>
              </li>
              @else
              <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <div class="col-item">
                  {{-- <div class="new-label new-top-right">New</div> --}}
                  <div class="images-container"> 
                    <a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$sp->product_id)}}"> 
                      <img src="/adminpages/images/{{$sp->product_image}}" class="img-responsive" style="width: 100%;height: 239px;" alt="a" /> 
                    </a>
                    <div class="actions">
                      <div class="actions-inner">
                        <button type="button" title="Add to Cart" class="button btn-cart" data-id="{{$sp->product_id}}"><span>Thêm vào giỏ hàng</span></button>
                      </div>
                    </div>
                    <div class="qv-button-container"> 
                      <a class="qv-e-button btn-quickview-1" href="{{url('home/product_detail/'.$sp->product_id)}}"><span><span>Xem</span></span></a> 
                    </div>
                  </div>
                  <div class="info">
                    <div class="info-inner">
                      <div class="item-title"> <a title=" Sample Product" href="{{url('home/product_detail/'.$sp->product_id)}}"> {{$sp->product_name}} </a> </div>
                      <!--item-title-->
                      <div class="item-content">
                        @if($sp->rating_product_total >0)
                        <?php $total = round($sp->product_total_rating/$sp->rating_product_total,2); ?>
                        <div class="ratings" style="display: flex;">
                          <ul style="display: flex;font-size: 15px;">
                            @for($i=1; $i<=5;$i++)
                            <li><i class="icon-star {{$i <= $total ? 'active':''}}"></i></li>
                            @endfor
                          </ul>
                        </div>
                        @else
                        <div class="ratings" style="display: flex;">
                          <ul style="display: flex;font-size: 15px;">
                            @for($i=1; $i<=5;$i++)
                            <li><i class="icon-star"></i></li>
                            @endfor
                          </ul>
                        </div>
                        @endif
                        <div class="price-box"> <span class="regular-price"> <span class="price">{{number_format($sp->product_price).' '.'VNĐ'}}</span> </span> </div>
                      </div>
                      <!--item-content--> 
                    </div>
                    <!--info-inner--> 
                    
                    <!--actions-->
                    
                    <div class="clearfix"> </div>
                  </div>
                </div>
              </li>
              @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- End Recommend slider --> 
<!-- banner section -->
<div class="top-offer-banner wow">
    <div class="container">
      	<div class="row">
	        <div class="offer-inner col-lg-12"> 
	          <!--newsletter-wrap-->
	          	<div class="left">
	            	<div class="col-1">
	              		<div class="block-subscribe">
	                		<div class="newsletter">
	                  			<form>
	                    			<h4><span>ĐĂNG KÝ NHẬN TIN</span></h4>
	                    			<h5> Nhận tin tức và cập nhật mới nhất từ Inspire</h5>
	                    			<input type="text" placeholder="Enter your email address" class="input-text required-entry validate-email" title="Sign up for our newsletter" id="newsletter1" name="email">
	                    			<button class="subscribe" title="Subscribe" type="submit"><span>Đăng ký</span></button>
	                  			</form>
	                		</div>
	              		</div>
	            	</div>
	            	<div class="col mid">
	              		<div class="inner-text">
	                		<h3>Tai nghe</h3>
	              		</div>
	              	<a href="#"><img src="{{asset('userpages/images/offer-banner2.jpg')}}" alt="offer banner2"></a></div>
	            	<div class="col last">
	              		<div class="inner-text">
	                		<h3>Camera</h3>
	              		</div>
	              		<a href="#"><img src="{{asset('userpages/images/offer-banner3.jpg')}}" alt="offer banner2"></a>
	              	</div>
	          	</div>
	          	<div class="right">
	            	<div class="col">
	              		<div class="inner-text">
	                		<h4>Lựa chọn hàng đầu cho</h4>
	                		<h3>Điện thoại</h3>
	                		<a href="#" class="shop-now1">Mua ngay</a> 
	                	</div>
	              		<a href="#" title=""><img src="{{asset('userpages/images/offer-banner4.jpg')}}" alt=""></a> 
	              	</div>
	          	</div>
	        </div>
      	</div>
    </div>
</div>
  
<!-- End banner section --> 
@include('userpages.layout.product_sale')
<!-- End Featured Slider --> 
<!-- brand -->
<footer class="footer">
    <div class="brand-logo ">
      	<div class="container">
        	<div class="slider-items-products">
          		<div id="brand-logo-slider" class="product-flexslider hidden-buttons">
            		<div class="slider-items slider-width-col6">
		            	<!-- Item -->
		            	@foreach($bran_array as $key => $item)
		            	<div class="item"> <a href="/home/product/brand/{{$item['brand_id']}}"><img src="{{asset('brand/'.$item['brand_logo'])}}" alt="Image" width="150" height="50"></a> 
		            	</div>
		            	@endforeach
                  {{-- @foreach($item as $item1)
                  <div class="item"> <a href="#"><img src="{{asset('brand/'.$item1->Brand->brand_logo)}}" alt="Image" width="150" height="50"></a> 
                  </div>
                  @endforeach --}}
		              	<!-- End Item -->
            		</div>
          		</div>
        	</div>
      	</div>
    </div>
</footer>
<!-- end brand -->
@endsection