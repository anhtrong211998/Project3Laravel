<div class="col-lg-8 col-xs-12 col-sm-8 best-seller-pro wow">
	<div class="slider-items-products">
		<div class="new_title center1">
			<h2>Sản phẩm giảm giá</h2>
		</div>
		<div id="best-seller-slider" class="product-flexslider hidden-buttons">
			<div class="slider-items slider-width-col4"> 
				<!-- Item -->
				@foreach($spnew as $key=> $items)
				@if($items->product_sale > 0)
				<?php $newprice =$items->product_price - ($items->product_sale * $items->product_price)/100; ?>
				<div class="item">
					<div class="col-item">
						<div class="new-label new-top-right">New</div>
						<div class="images-container"> <a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}"> <img src="/adminpages/images/{{$items->product_image}}" class="img-responsive" style="width: 100%;height: 239px;" alt="product-image" /> </a>
							<div class="actions">
								<div class="actions-inner">
									<button type="button" title="Add to Cart" class="button btn-cart" data-id="{{$items->product_id}}"><span>Thêm vào giỏ hàng</span></button>
								</div>
							</div>
							<div class="qv-button-container"> 
								<a href="{{url('home/product_detail/'.$items->product_id)}}" class="qv-e-button btn-quickview-1"><span><span>Xem</span></span></a> 
							</div>
						</div>
						<div class="info">
							<div class="info-inner">
								<div class="item-title"> <a title=" Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}"> {{$items->product_name}} </a> </div>
								<!--item-title-->
								<div class="item-content">
									@if($items->rating_product_total >0)
									<?php $total = round($items->product_total_rating/$items->rating_product_total,2); ?>
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
                  <p class="old-price"> <span class="price-sep">-</span> <span class="price"> {{number_format($items->product_price).' '.'VNĐ'}} </span> </p>
                </div>
              </div>
              <!--item-content--> 
            </div>
            <div class="clearfix"> </div>
          </div>
        </div>
      </div>
      @else
      <div class="item">
        <div class="col-item">
          <div class="new-label new-top-right">New</div>
          <div class="images-container">
           <a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}"> <img src="{{URL::to('/')}}/adminpages/images/{{$items->product_image}}" class="img-responsive" style="width: 100%;height: 239px;" alt="a" /></a>
           <div class="actions">
            <div class="actions-inner">
             <button type="button" title="Add to Cart" class="button btn-cart" data-id="{{$items->product_id}}"><span>Thêm vào giỏ hàng</span></button>
           </div>
         </div>
         <div class="qv-button-container"> <a href="{{url('home/product_detail/'.$items->product_id)}}" class="qv-e-button btn-quickview-1"><span><span>Xem</span></span></a> </div>
       </div>
       <div class="info">
        <div class="info-inner">
         <div class="item-title"> <a title=" Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}">{{$items->product_name}}</a> </div>
         <!--item-title-->
         <div class="item-content">
           @if($items->rating_product_total >0)
           <?php $total = round($items->product_total_rating/$items->rating_product_total,2); ?>
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
          <div class="price-box"> <span class="regular-price"> <span class="price">{{number_format($items->product_price).' '.'VNĐ'}}</span> </span> </div>
        </div>
        <!--item-content--> 
      </div>
      <!--info-inner--> 
      
      <!--actions-->
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
@endif
@endforeach
<!-- End Item -->                  
</div>
</div>
</div>
</div>