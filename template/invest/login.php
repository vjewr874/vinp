<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Invest Pro - Sàn giao dịch toàn cầu</title>

    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/odometer.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/owl.min.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo $template_path; ?>/assets/css/main.css">

    <link rel="shortcut icon" href="<?php echo $template_path; ?>/assets/images/favicon.png" type="image/x-icon">
    
  
</head>

<body>

    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!--============= Sign In Section Starts Here =============-->
    <div class="account-section bg_img" data-background="<?php echo $template_path; ?>/assets/images/account-bg.jpg">
        <div class="container">
            <div class="account-title text-center">
                <a href="<?php echo XC_URL;?>" class="back-home"><i class="fas fa-angle-left"></i><span>Quay lại <span class="d-none d-sm-inline-block">Invest Pro</span></span></a>
                <a href="#0" class="logo">
                    <img src="<?php echo $template_path; ?>/assets/images/logo/footer-logo.png" alt="logo">
                </a>
            </div>
            <div class="account-wrapper">
                <div class="account-body">
                    <h4 class="title mb-20">Đăng nhập</h4>
                    <form class="account-form">
                        <div class="form-group">
                            <label for="username">Tài khoản </label>
                            <input type="text" placeholder="Username/Email/Điện thoại" id="username" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" placeholder="Mật khẩu" id="password" name="password">
                            <span class="sign-in-recovery">Quên mật khẩu? <a href="#0">Yêu cầu khôi phục</a></span>
                        </div>
                        <div class="form-group text-center">
                            <button type="button" id="bntlogin" class="mt-2 mb-2">Đăng nhập</button>
                        </div>
                    </form>
                </div>
                <div class="or">
                    <span>HOẶC</span>
                </div>
                <div class="account-header pb-0">
                    <span class="d-block mb-30 mt-2">Đăng nhập với</span>
                    <a href="#0" class="sign-in-with"><img src="<?php echo $template_path; ?>/assets/images/icon/google.png" alt="icon"><span>Google</span></a>
                    <span class="d-block mt-15">Chưa có tài khoản? <a href="<?php echo XC_URL;?>/register">Đăng ký ngay</a></span>
                </div>
            </div>
        </div>
    </div>
    <!--============= Sign In Section Ends Here =============-->
    <script src="<?php echo $template_path; ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/modernizr-3.6.0.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/plugins.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/magnific-popup.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/wow.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/odometer.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/viewport.jquery.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/nice-select.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/owl.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/paroller.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).ready(function() {
			function login()
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
								/*
								$("#message").fadeIn(200);
								alert("Tài khoản hoặc mật khẩu không đúng, vui lòng kiểm tra lại...");
								*/
								Swal.fire({
								  icon: 'error',
								  title: 'Oops...',
								  text: data.message,
								  footer: '<a href>Xem thêm về lỗi này?</a>'
								})
							}
							else
							{
								window.location= ("<?php echo XC_URL;?>/");                
							}
						}
					});
				}
				return false;
			}
			$("input").keyup(function(e){
				if(e.keyCode == 13)
				{
					login();
				}
			});
			$("#bntlogin").on("click",function()
				{
					login();
				});
					
		});
		</script>

</body>
</html>