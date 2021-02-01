<header class="header-container">
	<div class="header-top">
		<div class="container">
			<div class="row"> 
				<marquee behavior="" direction="" style="color: white;
				font-size: 16px;
				padding: 3px 0 0 0;">Inspire nơi cung cấp sản phẩm chính hãng</marquee>
			</div>
		</div>
	</div>
	<div class="header container">
		<div class="row">
			<div class="col-lg-2 col-sm-3 col-md-2 col-xs-12"> 
				<!-- Header Logo --> 
				<a class="logo" title="Magento Commerce" href="/home"><img alt="Magento Commerce" src="{{asset('userpages/images/logo.png')}}"></a> 
				<!-- End Header Logo --> 
			</div>
			<div class="col-lg-7 col-sm-4 col-md-6 col-xs-12"> 
				<!-- Search-col -->
				<div class="search-box">
					<form action="" method="get" id="search_mini_form" name="Categories">
						{{csrf_field()}}
						<input type="text" placeholder="Search here..." value="" maxlength="70" class="" name="name_search" id="search">
						<button id="submit-button" type="submit" class="search-btn-bg"><span>Tìm kiếm</span></button>
					</form>
				</div>
				<script>
					$(document).ready(function(){
						
						$('#submit-button').on('click',function(event){
							event.preventDefault();
							name_search = $('#search').val();
							$.ajaxSetup({
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								}
							});
							$.ajax({
								type:'GET',
								url:'/home/search/'+name_search,            
								success:function(data){
									window.location.href = '/home/search/'+name_search;
								}
							});
							
						})
					});
                    </script>
				<!-- End Search-col --> 
			</div>
			<!-- Top Cart -->
			<div class="col-lg-3 col-sm-5 col-md-4 col-xs-12">
				@if(Auth::check())
				<div class="dropdown">
	                <button class="btn btn-secondary btn-sm dropdown-toggle signup" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 18px;background: #ad0800;color: white;width: 154px">
	                  {{ Auth::user()->name }}
	                </button>
	                <ul class="dropdown-menu" style="float: right;margin-top: 48px;margin-left: 180px;">
	                  	<li><a href="#" style="padding:8px 24px;border-bottom:1px solid gray;"><span class="icon-user" style="padding-right: 5px;"></span>Thông tin</a></li>
	                  	<li><a href="#" style="padding:8px 24px;border-bottom:1px solid gray;"><span class="icon-truck" style="padding-right: 13px;margin-left:-4px;"></span>Xem đơn hàng</a></li>
	                  	<li><a href="{{route('get.logout.user')}}" style="padding:8px 24px;"><span class="icon-signout" style="padding-right: 15px;"></span>Đăng xuất</a></li>
	                </ul>
              	</div>
				@else
				<div class="signup"><a title="Đăng ký" href="{{route('get.register')}}"><span>Đăng ký</span></a></div>
				<span class="or"> | </span>
				<div class="login"><a title="Đăng nhập" href="{{route('get.login')}}"><span>Đăng nhập</span></a></div>
				@endif
			</div>
			<!-- End Top Cart --> 
		</div>
	</div>
</header>