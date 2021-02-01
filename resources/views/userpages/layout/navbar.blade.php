<nav>
	<div class="container">
		<div class="nav-inner">        
			<a class="logo-small" title="Magento Commerce" href="{{url('home/')}}"><img alt="Magento Commerce" src="{{asset('userpages/images/logo-small.png')}}"></a>
			<ul id="nav" class="hidden-xs">
				<li class="level0 parent drop-menu"><a href="{{url('home/')}}" class="active"><span>Trang chủ</span> </a>
				</li>
				<li class="level0 parent drop-menu"><a href="/home/about"><span>Giới thiệu</span> </a>
				</li>
				<li class="level0 nav-5 level-top first"> 
					<a class="level-top" href="#"><span>Danh mục</span> </a>
					<div style="display:none;" class="level0-wrapper dropdown-6col">
						<div class="level0-wrapper2">
							<div class="nav-block nav-block-center grid12-8 itemgrid itemgrid-4col"> 
								<!--mega menu-->
								<ul class="level3">
								@foreach($loai_sp as $key=>$item)
									<li class="level3 nav-6-1 parent item"> 
										<a href="grid.html"><span>{{$item->category_name}}</span></a> 
										<!--sub sub category-->
										{{-- @for($i=0; $i<Count($item->Catetory)
										; $i++) --}}	
										@foreach($item->Catetory as $cate)			
										<ul class="level1">
										{{-- @for($j=1; $j<=8; $j++){ --}}
										{{-- <?php ?> --}}
											{{-- @if($item->Catetory[$i]->catetory_status != 0) --}}
											@if($cate->catetory_status != 0)
											<li class="level2 nav-6-1-1"> <a href="{{url('home/product/catetory/'.$cate->catetory_id)}}"><span>{{$cate->catetory_name}}</span></a> </li>
											@endif
										{{-- @endfor --}}
											<!--level2 nav-6-1-1-->
										</ul>
										<!--level1--> 
										@endforeach
										{{-- @endfor --}}
									</li>
									@endforeach
									<!--level1 nav-6-1 parent item-->
								</ul>
								<!--level0--> 
							</div>
							<!--nav-block nav-block-center-->
							<div class="nav-block nav-block-right std grid12-4">
								<p><a href="#"><img class="fade-on-hover" src="{{asset('userpages/images/nav-img1.jpg')}}" alt="nav img"></a></p>
								<h3 class="heading">Inspire</h3>
								<p>Sự lựa chọn thông minh!.</p>
								<!--  <p><a class="btn-button-st" title="Shop collection now" href="#">Shop collection now</a></p>  -->
							</div>
							<!--nav-block nav-block-right std grid12-4--> 
						</div>
					</div>
				</li>
				<li class="level0 nav-5 level-top parent"><a href="/home/faqs"><span>Faqs</span> </a>
				</li>
				<li class="level0 parent drop-menu"><a href="/home/blog"><span>Blog</span> </a>
					<ul style="display: none;" class="level1">
						<li class="level1 first"><a href="/home/blog_posts_table_view"><span>Table View</span></a> </li>
						<li class="level1 parent"><a href="/home/blog_single_post"><span>Single Post</span></a> </li>
					</ul>
				</li>
				<li class="level0 nav-5 level-top parent"> <a class="level-top" href="/home/contact_us"><span>Liên hệ</span></a>
				</li>
				<li class="level0 nav-5 level-top parent"> <a class="level-top" href="/home/articale"><span>Tin tức</span></a>
				</li>
				<li class="level0 nav-5 level-top parent nav-cart">
					<div class="top-cart-contain">
						<div class="mini-cart">
							<div class="basket dropdown-toggle-cart">
								<a href="/cart/checkout">
									<i class="icon-cart"></i>
									<div class="cart-box">
										<span class="title">My Cart</span>
										@if(Session::has('Cart'))
										<span id="cart-total">{{Session::get('Cart')->totalQty}}</span>
										@else 
										<span id="cart-total">0</span> 
										@endif
									</div>
								</a>
							</div>
							<div class="top-cart-content arrow_box">
								<div id="top-cart-render">
								@if(Session::has('Cart') != null)
									<div class="block-subtitle">Mục đã thêm gần đây</div>
									<ul id="cart-sidebar" class="mini-products-list total_item_cart">
									
									@foreach (Session::get('Cart')->items as $item)
										<li class="item even" id="xoa_item_{{$item['item']['product_id']}}">
											<a class="product-image" href="{{url('home/product_detail/'.$item['item']['product_id'])}}" title="Downloadable Product "><img alt="Sample Product" src="{{URL::to('/')}}/adminpages/images/{{$item['item']['product_image']}}" width="50" style="height: 50px;margin-top: -13px;"></a>
											<div class="detail-item">	
												<div class="product-details">
													<span title="Remove This Item" data-id="{{$item['item']['product_id']}}" class="icon-remove deleteCart">&nbsp;</span>
													<p class="product-name"><a href="{{url('home/product_detail/'.$item['item']['product_id'])}}" title="Downloadable Product">{{$item['item']['product_name']}}</a></p>
												</div>
												<div class="product-details-bottom">
													<span class="price">{{number_format($item['item']['product_price']).' '.'VNĐ'}}</span>
													<span class="title-desc">Qty:</span><strong id="cart_item_quanty_{{$item['item']['product_id']}}">{{$item['qty']}}</strong>
												</div>
											</div>
										</li>
										@endforeach                                          
									</ul>
								<div class="top-subtotal">Tổng tiền: <span class="price" id="cart_total_price">{{number_format(Session::get('Cart')->totalPrice).' '.'VNĐ'}}</span></div>
								<div class="actions">
									<button class="btn-checkout" type="button"><a href="/cart/checkout"><span>Xem Giỏ Hàng</span></a></button>
								</div>
								@endif
								</div>	
							</div>                          
						</div>
					</div>                   
				</li>
			</ul>
		</div>
	</div>
</nav>