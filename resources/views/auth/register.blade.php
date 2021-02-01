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
<section class="main-container col1-layout">
    <div class="main container">
        <div class="account-login">
            <div class="page-title">
                <h2>Đăng ký tài khoản</h2>
            </div>
            <form action="/dang-ky" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row"> 
                <div class="col-sm-1"></div>  
                <div class="col-sm-5" style="padding: 10px; border: 1px solid #dedede;">
                    <div class="form-group">
                        <label for="name">Họ và tên:</label>
                        <input type="text" class="form-control" id="name" placeholder="Họ và tên" name="name">
                        @if($errors->has('name'))
                        <label class="error" for="name">{{$errors->first('name')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" placeholder="Số điện thoại" name="phone">
                        @if($errors->has('phone'))
                        <label class="error" for="phone">{{$errors->first('phone')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" placeholder="Email...." name="email">
                        @if($errors->has('email'))
                        <label class="error" for="email">{{$errors->first('email')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu của bạn...." name="password">
                        @if($errors->has('password'))
                        <label class="error" for="password">{{$errors->first('password')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="re-password">Nhập lại mật khẩu:</label>
                        <input type="password" class="form-control" id="re-password" placeholder="Xác nhận lại mật khẩu..." name="re-password">
                        <span id='message'></span>
                    </div>
                    <button type="submit" class="btn btn-danger" style="margin:9px 0;">Lưu thông tin</button>
                </div>
                <div class="col-sm-5" style="padding: 10px; border: 1px solid #dedede;border-left: 0;">
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" class="form-control" id="avatar" placeholder="Chọn avatar nếu bạn muốn....">
                    </div>
                    <div class="form-group">
                        <label for="f_u_address">Địa chỉ:</label>
                        <textarea name="f_u_address" id="f_u_address" class="form-control" cols="30" rows="3" placeholder="vui lòng nhập đia chỉ...."></textarea>
                        @if($errors->has('f_u_address'))
                        <label class="error" for="f_u_address">{{$errors->first('f_u_address')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="fee_matp">Tỉnh/thành phố:</label>
                        <select id="fee_matp" name="fee_matp" class="custom-select form-control">
                            <option value="">--Chọn tỉnh/thành phố</option>
                            @foreach($cities as $key => $city)
                            <option value="{{$city->matp}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('fee_matp'))
                        <label class="error" for="fee_matp">{{$errors->first('fee_matp')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="fee_maquanhuyen">Quận/Huyện:</label>
                        <select id="fee_maquanhuyen" name="fee_maquanhuyen" class="custom-select form-control">
                            <option value="">--Chọn quận/huyện</option>
                            @foreach($provinces as $key => $province)
                            <option value="{{$province->maqh}}">{{$province->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('fee_maquanhuyen'))
                        <label class="error" for="fee_maquanhuyen">{{$errors->first('fee_maquanhuyen')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="fee_maxaphuong">Xã/Phường/Thị trấn:</label>
                        <select id="fee_maxaphuong" name="fee_maxaphuong" class="custom-select form-control">
                            <option value="">--Chọn xã/phường</option>
                            @foreach($wards as $key => $ward)
                            <option value="{{$ward->xaid}}">{{$ward->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('fee_maxaphuong'))
                        <label class="error" for="fee_maxaphuong">{{$errors->first('fee_maxaphuong')}}</label>
                        @endif 
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            
        </form>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</section>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#fee_matp").change(function(){
        var matp = $(this).val();
        $.get("/admin/feeship/getprovince/"+matp,function(data){
            $("#fee_maquanhuyen").html(data);
        });
    });
    $("#fee_maquanhuyen").change(function(){
        var maqh = $(this).val();
        $.get("/admin/feeship/getwards/"+maqh,function(data){
            $("#fee_maxaphuong").html(data);
        });
    });
    $('#password,#re-password').on('keyup', function (){
        if ($('#password').val() == $('#re-password').val()) {
            $('#message').html('Chính xác').css('color', 'green');
            $('.btn-danger').removeAttr("disabled");
        } 
        else{
            $('#message').html('Không giống').css('color', 'red');
            $('.btn-danger').attr("disabled", "disabled");
        }
    });
});   
</script>
@endsection
