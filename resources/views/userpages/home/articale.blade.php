@extends('userpages.layout.app')
@section('body')
<link rel="stylesheet" href="{{asset('userpages/css/blogmate.css')}}" type="text/css">
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <div class="col-main col-sm-9">
          		<div class="page-title">
            		<h3 class="widget-title"><span>Mọi người đều thích</span></h3>
          		</div>
          		<div class="popular-posts widget widget__sidebar wow" id="recent-posts-4"> 
              		<div class="widget-content">
		                <ul class="posts-list unstyled clearfix">
		                	@foreach($datas as $key=>$item)
		                  	<li>
		                    	<figure class="featured-thumb" style=" padding-left: 0;padding-right: 0;"> <a href="/home/articale_detail/{{$item->article_id}}"> <img width="180" height="120" alt="blog image" src="/article/{{$item->article_avatar}}"> </a> </figure>
		                    	<!--featured-thumb-->
		                    	<h4><a title="Tên tin tức" href="/home/articale_detail/{{$item->article_id}}" style="padding-left: 15px;font-size: 15px;font-weight: bold;">{{$item->article_name}}</a></h4>
		                    	<h4>{{$item->article_description}}</h4>
		                    	<p class="post-meta"><i class="icon-calendar"></i>
		                      	<time class="entry-date">{{$item->updated_at}}</time>
		                      	.</p>
		                  	</li>
		                  	@endforeach
		                </ul>
              		</div>
              		<!--widget-content--> 
            	</div>
            	<div class="article-paginate">
            		{!! $datas->render() !!}
            	</div>
            	
        	</div>
        	<div class="col-right sidebar col-sm-3 wow">
          		<div role="complementary" class="widget_wrapper13" id="secondary">
            		<div class="popular-posts widget widget_categories wow" id="categories-2">
              			<h3 class="widget-title"><span>Categories</span></h3>
              			<div class="box-content box-category">
			              	<ul>
			              		@foreach($category as $key=>$level0)
			              		<li><a href="#" class="">{{$level0->category_name}}</a> <span class="subDropdown plus"></span>
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
@endsection
