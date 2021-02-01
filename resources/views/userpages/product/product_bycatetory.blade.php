@extends('userpages.layout.app')
@section('body')
<section class="main-container col2-left-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 wow"style="width: 100%;">
                <div class="category-title">
                    <h1>Tops & Tees</h1>
                </div>
                <!-- category banner -->
                <div class="category-description std">
                    <div class="slider-items-products">
                        <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col1">
                                <!-- Item -->
                                <div class="item">
                                    <a href="#"><img alt="category-banner" src="{{asset('userpages/images/category-banner-img.jpg')}}"></a>
                                </div>
                                <!-- End Item -->
                                <!-- Item -->
                                <div class="item"><a href="#"><img alt="category-banner" src="{{asset('userpages/images/category-banner-img1.jpg')}}"></a> </div>
                                <!-- End Item -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- category banner -->
                <div class="category-products">
                    <div class="toolbar">
                          <div class="sorter">
                            <div class="view-mode"> <span title="Grid" class="button button-active button-grid">Grid</span> </div>
                        </div>
                        <div id="sort-by">
                            <a class="button-asc left" href="#" title="Set Descending Direction"><span style="color:#999;font-size:15px;top:7px;position:relative;" class="icon-arrow-up"></span></a>
                        </div>
                        <div class="pager">
                            <div class="pages">
                              <label style="font-size: 14px;margin-bottom: 0;display:inline-block;">Page:</label>
                              {!! $lsp->links() !!}
                            </div>
                        </div>
                    </div>
                    <ul class="products-grid">
                        @foreach ($lsp as $key=>$items)
                            <?php $newprice =$items->product_price - ($items->product_sale * $items->product_price)/100; ?>
                            @if($items->product_sale > 0)
                                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <div class="col-item">
                                        <div class="sale-label sale-top-right">Giảm {{$items->product_sale}} %</div>
                                        <div class="images-container">
                                            <a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}"> <img src="/adminpages/images/{{$items->product_image}}" class="img-responsive" style="width: 100%;height: 239px;" alt="a" /> </a>
                                            <div class="actions">
                                                <div class="actions-inner">
                                                    <button type="button" title="Add to Cart" class="button btn-cart" data-id="{{$items->product_id}}"><span>Thêm vào giỏ hàng</span></button>
                                                </div>
                                            </div>
                                            <div class="qv-button-container"> <a class="qv-e-button btn-quickview-1" href="{{url('home/product_detail/'.$items->product_id)}}"><span><span>Xem</span></span></a> </div>
                                        </div>
                                        <div class="info">
                                            <div class="info-inner">
                                                <div class="item-title"> <a title="Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}">{{$items->product_name}}</a> </div>
                                                <!--item-title-->
                                                <div class="item-content">
                                                    <div class="ratings">
                                                        <div class="rating-box">
                                                            <div style="width:60%" class="rating"></div>
                                                        </div>
                                                    </div>
                                                    <div class="price-box">
                                                        <p class="special-price"> <span class="price">{{number_format($newprice).' '.'VNĐ'}}</span> </p>
                                                        <p class="old-price"> <span class="price-sep">-</span> <span class="price">{{number_format($items->product_price).' '.'VNĐ'}}</span> </p>
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
                                        <div class="new-label new-top-right">New</div>
                                        <div class="images-container">
                                            <a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}"> <img src="/adminpages/images/{{$items->product_image}}" class="img-responsive" style="width: 100%;height: 239px;" alt="a" /> </a>
                                            <div class="actions">
                                                <div class="actions-inner">
                                                    <button type="button" title="Add to Cart" class="button btn-cart" data-id="{{$items->product_id}}"><span>Thêm vào giỏ hàng</span></button>
                                                </div>
                                            </div>
                                            <div class="qv-button-container"> <a class="qv-e-button btn-quickview-1" href="{{URL::to('/')}}/adminpages/images/{{$items->product_image}}"><span><span>Xem</span></span></a> </div>
                                        </div>
                                        <div class="info">
                                            <div class="info-inner">
                                                <div class="item-title"> <a title="Sample Product" href="{{URL::to('/')}}/adminpages/images/{{$items->product_image}}">{{$items->product_name}}</a> </div>
                                                <!--item-title-->
                                                <div class="item-content">
                                                    <div class="ratings">
                                                        <div class="rating-box">
                                                            <div style="width:60%" class="rating"></div>
                                                        </div>
                                                    </div>
                                                    <div class="price-box">
                                                        <p class="special-price"><span class="price">{{number_format($items->product_price).' '.'VNĐ'}}</span></p>
                                                    </div>
                                                </div>
                                                <!--item-content-->
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            </section>
        </div>
    </div>               
                            
</section>
{{-- {!!$lsp->render()!!} --}}
@endsection
