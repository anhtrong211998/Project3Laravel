@extends('userpages.layout.app')
@section('body')
<section class="main-container col1-layout">
	<div class="main container">
		<div class="col-main">
			<div class="row">
				<div class="product-view wow">
					<div class="row">
						<div class="col-lg-5 col-md-8 single-right-left ">
							<div class="grid images_3_of_2">
								<div class="flexslider">
									<img src="{{URL::to('/')}}/adminpages/images/{{$sp->product_image}}" style="height:416px;width:310px;margin-top:0px;margin-left:70px;" />
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 single-right-left simpleCart_shelfItem">
							<h3 class="mb-3" style="font-size: 25px !important">{{$sp->product_name}}</h3>

							<?php 
								if($sp->rating_product_total > 0){
									$total = round($sp->product_total_rating/$sp->rating_product_total,2); 
								}
								else{
									$total = 0;
								}
							?>
							<div class="ratings">
                          		<ul style="display: flex;font-size: 15px;margin-bottom: 10px;">
                          			@for($i=1; $i<=5;$i++)
                            		<li><i class="icon-star {{$i <= $total ? 'active':''}}"></i></li>
                            		@endfor
                          		</ul>
                        	</div>
							<p class="mb-3">
								@if($sp->product_sale > 0)
								<?php $newprice =$sp->product_price - ($sp->product_sale * $sp->product_price)/100; ?>
									<span class="item_price">{{number_format($newprice).' '.'VNĐ'}}</span>
									<del class="mx-2 font-weight-light">{{number_format($sp->product_price).' '.'VNĐ'}}</del>				
								@else
									<span class="item_price">{{number_format($sp->product_price).' '.'VNĐ'}}</span>
								@endif
								<label>Giao hàng miễn phí</label>
							</p>
							<div class="single-infoagile">
								{!!$sp->product_desc!!}
							</div>
							<div class="product-single-w3l">
								<ul>
									<li class="mb-3">
										Bảo hành 12 tháng.
									</li>
									<li class="mb-3">
										Tốc độ giao hàng nhanh.
									</li>
									<li class="mb-3">
										Được bán bởi Inspire.
									</li>
								</ul>
								<p class="my-3">
									<i class="fa icon-hand-right mr-2"></i>
									Đổi trả miễn phí
									<label>48 giờ</label> nhận hàng
								</p>

							</div>
							<div class="occasion-cart">
								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
									<button data-id="{{$sp->product_id}}" class="button btn-cart">Thêm vào giỏ hàng</button>
								</div>
							</div>
						</div>
					</div>
					<!-- middle section -->
					<div class="product-collateral">
						<div class="col-sm-12 wow">
							<ul id="product-detail-tab" class="nav nav-tabs product-tabs">
								<li class="active" style="width: 20%;text-align: center;">
									<a href="#product_tabs_comment" data-toggle="tab">Mô tả</a>
								</li>
								<li style="width: 20%;text-align: center;">
									<a href="#reviews_tabs" data-toggle="tab">Bình luận</a>
								</li>
							</ul>
							<div id="productTabContent" class="tab-content">
								<div class="tab-pane fade in active" id="product_tabs_comment">
									<div class="std read-more" style="font-size: 15px;line-height: 2.875rem;font-weight: normal;color: rgba(0,0,0,.8);">
										{!!$sp->product_content!!}                                 
									</div> 

								</div>
								<div class="tab-pane fade" id="reviews_tabs">
									<div class="box-collateral box-reviews" id="customer-reviews">
										<div class="box-reviews2">
											<h3>Bình luận</h3>
											@if(count($rates) > 0)
											<div class="box visible">
												<ul>
													@foreach($rates as $key=>$rating)
													<li>
														<table class="ratings-table">
															<colgroup>
																<col width="1">
																<col>
															</colgroup>
															<tbody>
																<tr>
																	<td>
																		<ul style="display: flex;font-size: 15px;margin-left: 15px;margin-top: 25px;">
                                                                			@for($i=1; $i<=5; $i++)
                                                                			<li><i class="icon-star {{$i <= $rating->rating_number ? 'active':'' }}"></i></li>
                                                              				@endfor
                                                              			</ul>
																	</td>
																</tr>
															</tbody>
														</table>
														<div class="review">
															@if($rating->rating_number==1)
															<h6><a href="">Tồi tệ</a></h6>
															@elseif($rating->rating_number==2)
															<h6><a href="">Kém</a></h6>
															@elseif($rating->rating_number==3)
															<h6><a href="">Tạm được</a></h6>
															@elseif($rating->rating_number==4)
															<h6><a href="">Tốt</a></h6>
															@elseif($rating->rating_number==5)
															<h6><a href="">Tuyệt vời</a></h6>
															@endif
															<small style="font-size: 95%;text-transform: none;">Đánh giá bởi <span>{{$rating->User->name}}</span>vào {{$rating->created_at}} </small>
															<div class="review-txt" style="margin-top: 5px;">{{$rating->rating_content}}</div>
														</div>
													</li>
													@endforeach
												</ul>
											</div>
											@else
											<div class="box visible" style="text-align: center;color: #ad0800;font-size: 18px;">
												<span>Không có bình luận nào</span>
											</div>
											@endif
										</div>
										<div class="box-reviews1">
											<div class="form-add">
												<form id="review-form" method="post" action="{{route('post.comment',[$sp->product_id])}}">
													{{csrf_field()}}
													<h3>Đánh giá</h3>
													<fieldset>
														<div id="rating">
															<input type="radio" id="star5" name="rating_number" value="5" />
															<label class="full" for="star5" title="Awesome - 5 stars"></label>

															<input type="radio" id="star4" name="rating_number" value="4" />
															<label class="full" for="star4" title="Pretty good - 4 stars"></label>

															<input type="radio" id="star3" name="rating_number" value="3" />
															<label class="full" for="star3" title="Meh - 3 stars"></label>

															<input type="radio" id="star2" name="rating_number" value="2" />
															<label class="full" for="star2" title="Kinda bad - 2 stars"></label>

															<input type="radio" id="star1" name="rating_number" value="1" />
															<label class="full" for="star1" title="Sucks big time - 1 star"></label>
														</div>
														<div class="review2">
															<div class="input-box">
																<label class="required1 label-wide" for="rating_content">Nhận xét<em>*</em></label>
																<textarea class="required-entry" rows="3" cols="5" id="rating_content" name="rating_content"></textarea>
															</div>
															<div class="buttons-set">
																<button class="button submit" title="Submit Review" type="submit"><span>Nhận xét</span></button>
															</div>
														</div>
													</fieldset>
												</form>
											</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="product-collateral join-w3l1 ">
						<div style="background:rgba(0,0,0,0.75);height:150px">

						</div>
					</div>
					<!-- middle section -->
					<div class="col-sm-12" style="padding-top:3rem;">
						<div class="box-additional">
							<div class="related-pro wow">
								<div class="slider-items-products">
									<div class="new_title center">
										<h2>Sản phẩm tương tự</h2>
									</div>
									<div id="related-products-slider" class="product-flexslider hidden-buttons">
										<div class="slider-items slider-width-col4">
											<!-- Item -->
											@foreach($spsame as $key=> $items)
											@if($items->product_sale > 0)
											<?php $newprice =$items->product_price - ($items->product_sale * $items->product_price)/100; ?>
											<div class="item">
												<div class="col-item">
													<div class="sale-label sale-top-right" style="top:15px;right:13px;">Sale {{$items->product_sale}} %</div>
													<div class="images-container"> <a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}"> <img src="/adminpages/images/{{$items->product_image}}" class="img-responsive" style="width: 98%;height: 252px;" alt="product-image" /> </a>
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
																<div class="ratings">
																	<div class="rating-box">
																		<div style="width:60%" class="rating"></div>
																	</div>
																</div>
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
													{{-- <div class="new-label new-top-right">New</div> --}}
													<div class="images-container">
														<a class="product-image" title="Sample Product" href="{{url('home/product_detail/'.$items->product_id)}}"> <img src="{{URL::to('/')}}/adminpages/images/{{$items->product_image}}" class="img-responsive" style="width: 98%;height: 252px;" alt="a" /></a>
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
																<div class="ratings">
																	<div class="rating-box">
																		<div style="width:60%" class="rating"></div>
																	</div>
																</div>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        var readmoreHtml = $(".read-more").html();
        var lessText = readmoreHtml.substr(0,1500);
        if(readmoreHtml.length > 1500){
            $(".read-more").html(lessText).append("<a href='' class='read-more-link'> Show more </a>");
        }
        else{
            $(".read-more").html(readmoreHtml);
        }
        $("body").on("click",".read-more-link",function(event){
            event.preventDefault();
            $(this).parent(".read-more").html(readmoreHtml).append("<a href='' class='show-less-link'> Show less </a>");
        });
        $("body").on("click",".show-less-link",function(event){
            event.preventDefault();
            $(this).parent(".read-more").html(readmoreHtml.substr(0,1500)).append("<a href='' class='read-more-link'> Show more </a>");
        });

    });
</script> 
@endsection