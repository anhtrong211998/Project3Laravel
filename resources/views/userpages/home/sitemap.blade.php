@extends('userpages.layout.app')
@section('body')
<section class="main-container col1-layout">
    <div class="main container">
        <div class="col-main">
            <div class="cart wow">
                <div class="page-title">
                    <h2>Sơ đồ trang web</h2>
                </div>
                <div class="row content-row">
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-4">
                        <ul class="simple-list arrow-list bold-list">
                            <li>
                                <a href="#">Danh mục</a>
                            </li>
                            <li><a href="#">Faqs</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Giỏ hàng</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-4">
                        <ul class="simple-list arrow-list bold-list">
                            <li>
                                <a href="#">Dịch vụ khách hàng</a>
                                <ul>
                                    <li><a href="#">Hỗ trợ trực tuyến</a></li>
                                    <li><a href="#">Câu hỏi liên quan</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Information</a>
                                <ul>
                                    <li><a href="#">Giới thiệu</a></li>
                                    <li><a href="#">Chính sách bảo mật</a></li>
                                    <li><a href="#">Điều khoản và điều kiện</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> <img class="img-responsive animate scale" src="/userpages/images/large-icon-sitemap.png" alt=""> </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- brand -->
<footer class="footer">
    <div class="brand-logo ">
        <div class="container">
            <div class="slider-items-products">
                <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col6">
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="/userpages/images/b-logo1.png" alt="Image" width="150" height="50"></a> </div>
                        <!-- End Item -->
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="/userpages/images/b-logo2.png" alt="Image" width="150" height="50"></a> </div>
                        <!-- End Item -->
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="/userpages/images/b-logo3.png" alt="Image" width="150" height="50"></a> </div>
                        <!-- End Item -->
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="/userpages/images/b-logo4.png" alt="Image" width="150" height="50"></a> </div>
                        <!-- End Item -->
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="/userpages/images/b-logo5.png" alt="Image" width="150" height="50"></a> </div>
                        <!-- End Item -->
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="/userpages/images/b-logo6.png" alt="Image" width="150" height="50"></a> </div>
                        <!-- End Item -->
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="/userpages/images/b-logo1.png" alt="Image" width="150" height="50"></a> </div>
                        <!-- End Item -->
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="/userpages/images/b-logo4.png" alt="Image" width="150" height="50"></a> </div>
                        <!-- End Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end brand -->
@endsection
