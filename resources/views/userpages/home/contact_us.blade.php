@extends('userpages.layout.app')
@section('body')
<style>
        label.error {
        margin-top: 10px;
        display: inline-block;
        color:red;
        width: 200px;
        margin-bottom: 10px;
        padding-left: 10px;
    }
</style>
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 wow" style="width:75%;">
                <div class="page-title">
                    <h2>Liên hệ</h2>
                </div>
                <div class="static-contain">
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            {!! Session::get('message') !!}
                        </div>
                        <?php session::put('message', null); ?>
                    @endif
                    <form method="post" action="/home/submit_contact_us">
                        {{csrf_field()}}
                        <fieldset class="group-select">
                            <ul>
                                <li id="billing-new-address-form">
                                    <fieldset>
                                        <legend>New Address</legend>
                                        <ul>
                                            <li>
                                                <div class="customer-name">
                                                    <div class="input-box name-firstname">
                                                        <label for="contact_name"> Họ tên<span class="required">*</span></label>
                                                        <br>
                                                        <input type="text" id="contact_name" name="contact_name" value="" title="Họ và tên" class="input-text ">
                                                        @if($errors->has('contact_name'))
                                                        <label class="error" for="contact_name">{{$errors->first('contact_name')}}</label>
                                                           {{--  <div class="alert alert-danger">{{$errors->first('contact_name')}}</div> --}}
                                                        @endif          
                                                    </div>
                                                    <div class="input-box name-lastname">
                                                        <label for="contact_email"> Email <span class="required">*</span> </label>
                                                        <br>
                                                        <input type="text" id="contact_email" name="contact_email" value="" title="email" class="input-text">
                                                        @if($errors->has('contact_email'))
                                                        <label class="error" for="contact_email">{{$errors->first('contact_email')}}</label>
                                                        @endif 
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="input-box">
                                                    <label for="contact_company">Công ty (nếu có)</label>
                                                    <br>
                                                    <input type="text" id="contact_company" name="contact_company" value="" title="Company" class="input-text">
                                                </div>
                                                <div class="input-box">
                                                    <label for="contact_phone">Điện thoại <span class="required">*</span></label>
                                                    <br>
                                                    <input type="text" name="contact_phone" id="contact_phone" value="" title="Số điện toại" class="input-text validate-email">
                                                    @if($errors->has('contact_phone'))
                                                        <label class="error" for="contact_phone">{{$errors->first('contact_phone')}}</label>
                                                    @endif 
                                                </div>
                                            </li>
                                            <li>
                                                <label for="contact_address">Địa chỉ <span class="required">*</span></label>
                                                <br>
                                                <input type="text" title="Địa chỉ" name="contact_address" id="contact_address" value="" class="input-text required-entry">
                                                @if($errors->has('contact_address'))
                                                 <label class="error" for="contact_address">{{$errors->first('contact_address')}}</label>
                                                @endif 
                                            </li>
                                            <li>
                                                <label for="contact_title">Tiêu đề <span class="required">*</span></label>
                                                <br>
                                                <input type="text" title="Tiêu đề thư" name="contact_title" id="contact_title" value="" class="input-text required-entry">
                                            </li>
                                            <li class="">
                                                <label for="contact_content">Nội dung<em class="required">*</em></label>
                                                <br>
                                                <div style="float:none" class="">
                                                    <textarea name="contact_content" id="contact_content" title="Nội dung" class="required-entry input-text" cols="5" rows="3"></textarea>
                                                </div>
                                                @if($errors->has('contact_content'))
                                                 <label class="error" for="contact_content">{{$errors->first('contact_content')}}</label>
                                                @endif
                                            </li>
                                        </ul>
                                    </fieldset>
                                </li>
                                <div class="buttons-set">
                                    <button type="submit" title="Submit" class="button submit"> <span> Gửi </span> </button>
                                </div>
                            </ul>
                        </fieldset>
                    </form>
                </div>
            </section>
            <aside class="col-right sidebar col-sm-3 wow">
                <div class="block block-company">
                    <div class="block-title">Shop</div>
                    <div class="block-content">
                        <ol id="recently-viewed-items">
                            <li class="item odd"><a href="/home/about">Giới thiệu</a></li>
                            <li class="item even"><a href="/home/sitemap">Sơ đồ trang web</a></li>
                            <li class="item  odd"><a href="/home/terms">Điều khoản và điều kiện</a></li>
                            <li class="item even"><a href="/home/policies">Chính sách bảo mật</a></li>
                            <li class="item last"><strong>Liên hệ</strong></li>
                            
                        </ol>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
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
