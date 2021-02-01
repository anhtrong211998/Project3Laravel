@extends('userpages.layout.app')
@section('body')
<link rel="stylesheet" href="{{asset('userpages/css/blogmate.css')}}" type="text/css">
<div class="main-container col2-right-layout">
	<div class="main container">
		<div class="row">
			<div class="col-main col-sm-9 wow">
				<div class="blog-wrapper" id="main">
					<div class="site-content" id="primary">
						<div role="main" id="content">
							<article class="blog_entry clearfix" id="post-29">
								<header class="blog_entry-header clearfix">
									<div class="blog_entry-header-inner">
										<h2 class="blog_entry-title">{{$item->article_name}}</h2>
									</div>
									<!--blog_entry-header-inner--> 
								</header>
								<!--blog_entry-header clearfix-->
								<div class="entry-content">
									<div class="featured-thumb"><a href="#"><img alt="blog-img4" src="/article/{{$item->article_avatar}}"></a></div>
									<div class="entry-content read-more">
										{!! $item->article_content !!}
									</div>
								</div>
								<footer class="entry-meta"> Mục này đã được đăng vào<a rel="category tag" title="View all posts in First Category" href="#first-category">
									<time class="entry-date">{{$item->updated_at}}</time>
								. </footer>
							</article>
							{{-- <div class="comment-content wow">
								<div class="comments-wrapper">
									<h3> Comments </h3>
									<ul class="commentlist">
										<li class="comment">
											<div class="comment-wrapper" id="post-29">
												<div class="comment-author vcard"> <p class="gravatar"><a href="#"><img width="60" height="60" alt="avatar" src="/userpages/images/avatar60x60.jpg"></a></p><span class="author">John Doe</span> </div>
												<!--comment-author vcard-->
												<div class="comment-meta">
													<time datetime="2014-07-10T07:26:28+00:00" class="entry-date">Thu, Jul 10, 2014 07:26:28 am</time>
												. </div>
												<!--comment-meta-->
												<div class="comment-body"> Curabitur at vestibulum sem. Aliquam vehicula neque ac nibh suscipit ultrices. Morbi interdum accumsan arcu nec scelerisque ellentesque id erat sem, ut commodo nulla. Sed a nulla et eros fringilla. Phasellus eget purus nulla. </div>
											</div>
										</li>
										<!--comment-->
									</ul>
									<!--commentlist--> 
								</div>
								<!--comments-wrapper-->

								<div class="comments-form-wrapper clearfix">
									<h3>Để lại bình luận</h3>
									<form class="comment-form" method="post" id="postComment" action="#">
										<div class="field">
											<label for="name">Tên<em class="required">*</em></label>
											<input type="text" class="input-text" title="Họ và tên" value="" id="user" name="user_name">
										</div>
										<div class="field">
											<label for="email">Email<em class="required">*</em></label>
											<input type="text" class="input-text validate-email" title="Email" value="" id="email" name="user_email">
										</div>
										<div class="clear"></div>
										<div class="field aw-blog-comment-area">
											<label for="comment">Nội dung<em class="required">*</em></label>
											<textarea rows="5" cols="50" class="input-text" title="Nội dung " id="comment" name="comment"></textarea>
										</div>
										<div style="width:96%" class="button-set">
											<input type="hidden" value="1" name="blog_id">
											<button type="submit" class="bnt-comment"><span><span>Bình luận</span></span></button>
										</div>
									</form>
								</div>
								<!--comments-form-wrapper clearfix--> 

							</div> --}}
						</div>
					</div>
				</div>
			</div>
			<div class="col-right sidebar col-sm-3">
				<div role="complementary" class="widget_wrapper13" id="secondary">
					<div class="popular-posts widget widget__sidebar wow" id="recent-posts-4">
						<h3 class="widget-title"><span>Most Popular Post</span></h3>
						<div class="widget-content">
							<ul class="posts-list unstyled clearfix">
								@foreach($datas as $key=>$data)
								<li style="border:1px solid #dedede;">
									<figure class="featured-thumb"> <a href="/home/articale_detail/{{$data->article_id}}"> <img width="80" height="53" alt="blog image" src="/article/{{$data->article_avatar}}"> </a> </figure>
									<!--featured-thumb-->
									<h4><a title="Pellentesque posuere" href="/home/articale_detail/{{$data->article_id}}">{{$data->article_name}}</a></h4>
									<p class="post-meta"><i class="icon-calendar"></i>
										<time class="entry-date">{{$data->updated_at}}</time>
									.</p>
								</li>
								@endforeach
							</ul>
						</div>
						<!--widget-content--> 
					</div>
					<div class="popular-posts widget widget_categories wow" id="categories-2">
						<h3 class="widget-title"><span>Categories</span></h3>
						<div class="box-content box-category">
							<ul>
								@foreach($category as $key=>$level0)
			              		<li>
			              			<a href="#" class="">{{$level0->category_name}}</a> <span class="subDropdown plus"></span>
			                  		<ul class="level0_415" style="display:none">
			                  			@foreach($level0->Catetory as $key=>$level1)
			                  			@if($level1->catetory_status != 0)
			                    		<li>
			                    			<a href="{{url('home/product/catetory/'.$level1->catetory_id)}}">{{$level1->catetory_name}}</a> 
			                      			<!--level1--> 
			                    		</li>
			                    		@endif
				                    	<!--level1-->
				                    	@endforeach
			                  		</ul>
			                  	<!--level0--> 
			                	</li>
								@endforeach
			                <!--level 0-->
							</ul>
						</div>
					</div>
					<div class="popular-posts widget widget_categories wow" id="categories-2">
						<div class="block block-cart">
							<div class="block-title"><span>New Product</span></div>
							<div class="block-content">
								<ul>
									@foreach($spnew as $key=>$sp)
									
									<li class="item"> <a class="product-image" title="Fisher-Price Bubble Mower" href="{{url('home/product_detail/'.$sp->product_id)}}"><img width="80" alt="Fisher-Price Bubble Mower" src="/adminpages/images/{{$sp->product_image}}"></a>
										<div class="product-details">
											<p class="product-name"> <a href="{{url('home/product_detail/'.$sp->product_id)}}">{{$sp->product_name}}</a></p>
											@if($sp->product_sale > 0)
											<?php $newprice =$sp->product_price - ($sp->product_sale * $sp->product_price)/100; ?>
											<p class="special-price"> <span class="price" style="font-size: 11px;">{{number_format($newprice).' '.'đ'}}</span> </p>
											<p class="old-price"> <span class="price-sep">-</span> <span class="price" style="font-size: 11px;padding: 0;margin: 0;">{{number_format($sp->product_price).' '.'đ'}}</span></p>
											@else
											<p class="special-price"> <span class="price" style="font-size: 11px;padding: 0;margin: 0;">{{number_format($sp->product_price).' '.'đ'}}</span> </p>
											@endif
											@if($sp->rating_product_total >0)
											<?php $total = round($sp->product_total_rating/$sp->rating_product_total,2); ?>
											<div class="ratings" style="display: flex;">
												<ul style="display: flex;font-size: 11px;">
													@for($i=1; $i<=5;$i++)
													<li style="margin: 0;padding: 3px;"><i class="icon-star {{$i <= $total ? 'active':''}}"></i></li>
													@endfor
												</ul>
											</div>
											@else
											<div class="ratings" style="display: flex;">
												<ul style="display: flex;font-size: 11px;">
													@for($i=1; $i<=5;$i++)
													<li style="margin: 0;padding: 3px;"><i class="icon-star"></i></li>
													@endfor
												</ul>
											</div>
											@endif
										</div>
									</li>
									
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- brand -->
<footer class="footer">
    <div class="brand-logo ">
        <div class="container">
            <div class="slider-items-products">
                <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end brand -->
<script type="text/javascript">
    $(document).ready(function(){
        var readmoreHtml = $(".read-more").html();
        var lessText = readmoreHtml.substr(0,1000);
        if(readmoreHtml.length > 1000){
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
