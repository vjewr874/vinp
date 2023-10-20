<?php include "config.php";?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.themefisher.com/tradient/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Dec 2020 03:13:28 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LightNing999 | Customer Portal | Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo $template_path;?>/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="<?php echo $template_path;?>/vendor/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $template_path;?>/css/style.css">
</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-lg navbar-light px-0 justify-content-between">
                            <a class="navbar-brand" href="index.html"><img src="<?php echo $template_path;?>/images/logo-ln.png" alt="">
                                </a>

                            <div class="dashboard_log">
                                <div class="d-flex align-items-center">
                                    <div class="header_auth">
                                        <a href="signin.html" class="btn btn-success  mx-2">Đăng nhập</a>
                                        <a href="signup.html" class="btn btn-outline-primary  mx-2">Mở tài khoản</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>


        <div class="authincation section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-4 col-md-6">
                        <div class="auth-form card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title">Đăng nhập</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" name="myform" class="signin_validate" action="">
                                    <div class="form-group">
                                        <label>Tài khoản</label>
                                        <input type="text" class="form-control" placeholder="Email/Số điện thoại/Tài khoản" name="username" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password" id="password">
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group mb-0">
                                            <label class="toggle">
                                                <input class="toggle-checkbox" type="checkbox">
                                                <div class="toggle-switch"></div>
                                                <span class="toggle-label">Giữ đăng nhập</span>
                                            </label>
                                        </div>
                                        <div class="form-group mb-0">
                                            <a href="reset.html">Quên mật khẩu?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" id="bntlogin" class="btn btn-success btn-block">Đăng nhập</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Chưa có tài khoản? <a class="text-primary" href="#">Mở tài khoản</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="footer-link text-left">
                            <a href="#" class="m_logo"><img src="images/w_logo.png" alt=""></a>
                            <a href="about.html">Giới thiệu</a>
                            <a href="privacy-policy.html">Chính sách bảo mật</a>
                            <a href="term-condition.html">Điều khoản sử dụng</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 text-lg-right text-center">
                        <div class="social">
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-12 text-center text-lg-right">
                        <div class="copy_right text-center text-lg-center">
                            Copyright © 2021 LightNing999. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="bg_icons"></div>


    <script src="<?php echo $template_path;?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo $template_path;?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $template_path;?>/vendor/waves/waves.min.js"></script>

    <script src="<?php echo $template_path;?>/vendor/validator/jquery.validate.js"></script>
    <script src="<?php echo $template_path;?>/vendor/validator/validator-init.js"></script>

    <script src="<?php echo $template_path;?>/js/scripts.js"></script>
	<script>
		$(document).ready(function() {
			$("#bntlogin").on("click",function()
				{
					if($("#username").val().length <=3)
					{
						$("#message").fadeIn(200);
						$("#message").html("Tài khoản không hợp lệ, vui lòng nhập lại");
						alert("Tài khoản không hợp lệ, vui lòng nhập lại");
						$("#username").focus();
					}
					else				
					{
						var user = $("#username").val();
						var pass = $("#password").val();
						var dataString = 'username='+ user + '&password=' + pass;
						$.ajax({
							type: "POST",
							url: "<?php echo XC_URL;?>/api/login",
							data: {username: user, password: pass},
							dataType: "json",
							cache: false,
							success: function(data)
							{
								if(data.status != "200")
								{
									$("#message").fadeIn(200);
									alert("Tài khoản hoặc mật khẩu không đúng, vui lòng kiểm tra lại...");
								}
								else
								{
									window.location= ("<?php echo XC_URL;?>/");                
								}
							}
						});
					}
					return false;
				});
					
		});
		</script>
</body>


<!-- Mirrored from demo.themefisher.com/tradient/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Dec 2020 03:13:28 GMT -->
</html>