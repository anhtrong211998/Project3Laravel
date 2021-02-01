<section class="featured-pro wow animated parallax parallax-2">
    <div class="container">
        <div class="std">
            <div class="slider-items-products">
                <div class="featured_title center">
                    <h2>SẢN PHẨM HOT SALE</h2>
                </div>
                <div id="featured-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4">
                        <!-- Item -->
                        @foreach ($spsale as $key=>$tiems)
                          <?php $newprice =$tiems->product_price - ($tiems->product_sale * $tiems->product_price)/100; ?>
                            <div class="item">
                                <div class="col-item">
                                    <div class="sale-label sale-top-right">Sale {{$tiems->product_sale}} %</div>
                                    <div class="images-container">
                                        <a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$tiems->product_id)}}"> <img src="{{URL::to('/')}}/adminpages/images/{{$tiems->product_image}}" class="img-responsive" style="width: 100%;height: 239px;" alt="a" /></a>
                                        <div class="actions">
                                            <div class="actions-inner">
                                                <button type="button" title="Add to Cart" class="button btn-cart" data-id="{{$tiems->product_id}}"><span>Thêm vào giỏ hàng</span></button>
                                            </div>
                                        </div>
                                        <div class="qv-button-container"> <a href="{{url('home/product_detail/'.$tiems->product_id)}}" class="qv-e-button btn-quickview-1"><span><span>Xem</span></span></a> </div>
                                    </div>
                                    <div class="info">
                                        <div class="info-inner">
                                            <div class="item-title"> <a title="Sample Product" href="{{url('home/product_detail/'.$tiems->product_id)}}">{{$tiems->product_name}}</a> </div>
                                            <!--item-title-->
                                            <div class="item-content">
                                                @if($tiems->rating_product_total >0)
                                                <?php $total = round($tiems->product_total_rating/$tiems->rating_product_total,2); ?>
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
                                                    <p class="special-price"> <span class="price">{{number_format($newprice).' '.'VNĐ'}}</span> </p>
                                                    <p class="old-price"> <span class="price-sep">-</span> <span class="price">{{number_format($tiems->product_price).' '.'VNĐ'}}</span></p>
                                                </div>
                                            </div>
                                            <!--item-content-->
                                        </div>
                                        <!--info-inner-->

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- End Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
