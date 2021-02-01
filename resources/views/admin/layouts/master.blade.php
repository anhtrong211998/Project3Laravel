<!DOCTYPE html>
<head>
<title>Inspire Shop Admin</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('/adminpages/css/bootstrap.min.css')}}" >
<link rel="stylesheet" href="{{asset('/adminpages/css/ie10-viewport-bug-workaround.css')}}" >
<link rel="stylesheet" href="{{asset('/adminpages/css/dashboard.css')}}" >

<!-- font-awesome icons -->
<link href="{{asset('/adminpages/css/font-awesome.css')}}" rel="stylesheet"> 
<link href="{{asset('/adminpages/css/search-box.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('/adminpages/js/ie-emulation-modes-warning.js')}}"></script>
<script src="{{asset('/adminpages/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
          	<a class="navbar-brand" href="#">Inspire</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          	<ul class="nav navbar-nav navbar-right" style="margin-right: 5%;font-size: 17px;color: white;font-weight: 700">
              @if(Auth::guard('admins')->check())
	            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="username">
                      Hoàng Đình Trọng
                    </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                  {{--   <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> --}}
                    <li><a href="{{route('get.logout.admin')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                </ul>
              </li>
              @endif
              <li></li>
              <li></li>
          	</ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
  	<div class="row">
    	<div class="col-sm-3 col-md-2 sidebar">
          	<ul class="nav nav-sidebar">
	            <li class="active"><a href="/admin/dashboard">Trang Tổng Quan <span class="sr-only">(current)</span></a></li>
	            <li class="{!!  Request::is('admin/category') || Request::is('admin/category/*') ? 'active ' : '' !!}"><a href="/admin/category/list">Danh mục</a></li>
              <li class="{!!  Request::is('admin/catetory') || Request::is('admin/catetory/*') ? 'active ' : '' !!}"><a href="/admin/catetory/list">Loại sản phẩm</a></li>
	            <li class="{!!  Request::is('admin/provider') || Request::is('admin/provider/*') ? 'active ' : '' !!}"><a href="/admin/provider/list">Nhà cung cấp</a></li>
	            <li class="{!!  Request::is('admin/brand') || Request::is('admin/brand/*') ? 'active ' : '' !!}"><a href="/admin/brand/list">Nhãn hiệu</a></li>
                <li class="dropdown_level1 {!!  Request::is('admin/product') || Request::is('admin/product/*') ? 'active ' : '' !!}">
                  <a href="#" class="click_dropdown">Sản phẩm</a>
                  <div class="dropdown-lvl1" style=" display: none;">
                      <div class="panel-body" >
                          <ul class="sub">
                              <li><a href="/admin/product/list">Danh sách sản phẩm</a></li>
                              <li><a href="/admin/product/create">Thêm sản phẩm</a></li>
                          </ul>
                      </div>
                  </div>
                </li>
                <li class="{!!  Request::is('admin/feeship') || Request::is('admin/feeship/*') ? 'active ' : '' !!}"><a href="/admin/feeship/list">Phí Ship</a></li>
                <li class="{!!  Request::is('admin/coupon') || Request::is('admin/coupon/*') ? 'active ' : '' !!}"><a href="/admin/coupon/list">Phiếu giảm giá</a></li>
                <li class="dropdown_level1 {!!  Request::is('admin/article') || Request::is('admin/article/*') ? 'active ' : '' !!}">
                    <a href="#" class="click_dropdown">Tin tức</a>
                    <div class="dropdown-lvl1" style=" display: none;">
                        <div class="panel-body" >
                            <ul class="sub">
                                <li><a href="{{route('admin.article.list')}}">Danh sách tin tức</a></li>
                                <li><a href="{{route('admin.article.get.create')}}">Thêm tin tức</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class=" {!!  Request::is('admin/banner') || Request::is('admin/banner/*') ? 'active ' : '' !!}">
                    <a href="{{route('admin.banner.list')}}">Banner</a>
                </li>
                <li class=" {!!  Request::is('admin/user') || Request::is('admin/user/*') ? 'active ' : '' !!}"><a href="{{route('admin.user.list')}}">Thành viên</a></li>
                <li class=" {!!  Request::is('admin/customer') || Request::is('admin/customer/*') ? 'active ' : '' !!}"><a href="/admin/customer/list">Khách hàng</a></li>
                <li class="dropdown_level1 {!!  Request::is('admin/order') || Request::is('admin/order/*') ? 'active ' : '' !!}">
                    <a href="#" class="click_dropdown">Đơn hàng</a>
                  <!-- Dropdown level 1 -->
                    <div class="dropdown-lvl1" style=" display: none;">
                        <div class="panel-body">
                            <ul class="sub">
                                <li><a href="/admin/order/list_default">Chưa xử lý</a></li>
                                <li><a href="/admin/order/list_info">Đã xử lý</a></li>
                                <li><a href="/admin/order/list_warning">Đang giao</a></li>
                                <li><a href="/admin/order/list_success">Đã giao hàng</a></li>
                                <li><a href="/admin/order/list_danger">Đã hủy</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class=" {!!  Request::is('admin/personnel') || Request::is('admin/personnel/*') ? 'active ' : '' !!}"><a href="/admin/personnel/list">Nhân viên</a></li>
                
                <li class=" {!!  Request::is('admin/account') || Request::is('admin/account/*') ? 'active ' : '' !!}"><a href="/admin/account/list">Tài khoản</a></li>
                <li><a href="#">Phiếu nhập</a></li>
          	</ul>
    	</div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          	@yield('content')
        </div>
  	</div>
</div>
<script src="{{asset('/adminpages/js/bootstrap.js')}}"></script>
<script>
  $(document).ready(function(){
    $("div.alert").delay(1000).slideUp();
    $('.click_dropdown').click(
      function(event){
        event.preventDefault();
        $(this).closest('li').find('div.dropdown-lvl1').toggleClass('show');
      });
  });
</script>
<script src="{{asset('/adminpages/js/ie10-viewport-bug-workaround.js')}}"></script>
<script src="{{asset('/adminpages/js/holder.min.js')}}"></script>
<script src="{{asset('/adminpages/ckeditor/ckeditor.js')}}"></script>
@stack('jsmore')

</body>
</html>