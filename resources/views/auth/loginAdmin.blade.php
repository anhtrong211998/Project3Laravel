<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Communal Login Form Responsive Widget, Audio and Video players, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"
    />
    <link rel="icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Meta tags -->
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="/login_user/css/font-awesome.min.css" />
    <!-- //font-awesome icons -->
    <!--stylesheets-->
    <link href="/login_user/css/style.css" rel='stylesheet' type='text/css' media="all">
</head>

<body>
    <h1 class="header-w3ls">
        Inspire</h1>
    <div class="appointment-w3">

        <form action="" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <h2 class="sub-heading-wthree">Đăng nhập</h2>
            <div class="main">
                <div class="form-left-w3l">
                    <input type="email" name="email" placeholder="email" required="" id="user_email">
                </div>
                <div class="form-right-w3ls ">

                    <input type="password" name="password" placeholder="password" id="user_password" required="">

                    <div class="clearfix"></div>
                </div>

            </div>
            <div class="btnn">
                <button type="submit">Đăng nhập</button><br>
            </div>
        </form>
    </div>
</body>
</html>