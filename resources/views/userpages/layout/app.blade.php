<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Inspire shop</title>
	<!-- Favicons Icon -->
	<link rel="icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS Style -->

	<link rel="stylesheet" href="{{asset('userpages/css/bootstrap.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('userpages/css/style.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('userpages/css/revslider.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('userpages/css/owl.carousel.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('userpages/css/owl.theme.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('userpages/css/font-awesome.css')}}" type="text/css">
	
	
	<!-- Google Fonts -->
	<link rel="stylesheet" href="{{asset('userpages/css/rate.css')}}" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
	@include('userpages.layout.script')
</head>
<body>
<div class="page"> 
  <!-- Header -->	
    @include('userpages.layout.header')	
  <!-- end header --> 
  <!-- Navbar -->
  	@include('userpages.layout.navbar')

 <!--body-->
 	@yield('body')

<!--  end body -->

  <!-- Footer-->
  @include('userpages.layout.footer')
  <!-- End Footer --> 
</div>
<script type="text/javascript" src="{{asset('userpages/js/cart&checkout.js')}}"></script>
<script src="{{asset('adminpages/js/myscripts.js')}}"></script>
</body>
</html>