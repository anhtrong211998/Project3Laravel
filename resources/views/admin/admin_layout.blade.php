<!DOCTYPE html>
<head>
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('adminpages/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('adminpages/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('adminpages/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('adminpages/css/font.css')}}" type="text/css"/>
<link href="{{asset('adminpages/css/font-awesome.css')}}" rel="stylesheet"> 
{{-- <link rel="stylesheet" href="{{asset('adminpages/css/morris.css')}}" type="text/css"/> --}}
<!-- calendar -->
<link rel="stylesheet" href="{{asset('adminpages/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('adminpages/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('adminpages/js/raphael-min.js')}}"></script>
<script src="{{asset('adminpages/plugins/jquery.twbsPagination.min.js')}}"></script>
{{-- <script src="{{asset('adminpages/js/morris.js')}}"></script> --}}
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{url('/admin/dashboard')}}" class="logo">
        Inspire
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('adminpages/images/2.png')}}">
                <span class="username">
                	admin
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{url('admin/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{url('admin/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý danh mục</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{url('admin/category/list/all')}}">Danh sách danh mục</a></li>
						<li><a href="{{url('/admin/category/add')}}">Thêm danh mục</a></li>
                        {{-- <li><a href="#">Sửa danh mục</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý loại sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/catetory/list/all')}}">Danh sách loại sản phẩm</a></li>
                        <li><a href="{{url('/admin/catetory/add')}}">Thêm loại sản phẩm</a></li>
                        {{-- <li><a href="#">Sửa danh mục</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý nhà sản xuất</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{url('/admin/brand/list/all')}}">Danh sách nhà sản xuất</a></li>
						<li><a href="{{url('/admin/brand/add')}}">Thêm nhà sản xuất</a></li>
                        {{-- <li><a href="#">Sửa danh mục</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý nhà cung cấp</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/provider/list/all')}}">Danh sách nhà cung cấpt</a></li>
                        <li><a href="{{url('/admin/provider/add')}}">Thêm nhà cung cấp</a></li>
                        {{-- <li><a href="#">Sửa danh mục</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/product/list/all')}}">Danh sách sản phẩm</a></li>
                        <li><a href="{{url('/admin/product/add')}}">Thêm sản phẩm</a></li>
                        {{-- <li><a href="#">Sửa danh mục</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/coupon/list/all')}}">Danh sách mã giảm giá</a></li>
                        <li><a href="{{url('/admin/coupon/add')}}">Thêm mã giảm giá</a></li>
                        {{-- <li><a href="#">Sửa danh mục</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý phí ship</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/feeship/list/all')}}">Danh sách phí ship</a></li>
                        {{-- <li><a href="#">Sửa danh mục</a></li> --}}
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý tin tức</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/article/list/all')}}">Danh sách tin tức</a></li>
                        <li><a href="{{url('/admin/article/add')}}">Thêm tin tức</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //body here-->
		@yield('content')
		<!-- //end body here-->
	</section>
 <!-- footer -->
	<div class="footer">
	 	<div class="wthree-copyright">
	 		<p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
	 	</div>
	</div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('adminpages/js/bootstrap.js')}}"></script>
<script src="{{asset('adminpages/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('adminpages/js/scripts.js')}}"></script>
<script src="{{asset('adminpages/js/myscripts.js')}}"></script>
<script src="{{asset('adminpages/ckeditor/ckeditor.js')}}"></script>
@stack('jsmore')
<script src="{{asset('adminpages/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('adminpages/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('adminpages/js/jquery.scrollTo.js')}}"></script>

</body>
</html>
