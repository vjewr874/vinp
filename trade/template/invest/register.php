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
                <div class="account-header">
                    <h4 class="title">Đăng ký tài khoản</h4>
                </div>
                <div class="account-body">
                    
                    <form name="form-register" id="form-register" class="account-form">
                        <div class="form-group">
                            <label for="register_phone">Số điện thoại</label>
                            <input type="text" placeholder="Số điện thoại" id="register_phone" name="register_phone">
                        </div>
						<div class="form-group">
                            <label for="register_username">Tên tài khoản </label>
                            <input type="text" placeholder="Tên tài khoản" id="register_username" name="register_username">
                        </div>
						<div class="form-group">
                            <label for="register_name">Họ và tên</label>
                            <input type="text" placeholder="Vui lòng nhập họ và tên thật" id="register_name" name="register_name">
                        </div>
						<div class="form-group">
                            <label for="register_password">Mật khẩu</label>
                            <input type="password" placeholder="Nhập mật khẩu" id="register_password" name="register_password">
                        </div>
                        <div class="form-group text-center">
                            <button type="button" id="btn-register">Đăng ký</button>
                            <span class="d-block mt-15">Đã có tài khoản? <a href="<?php echo XC_URL;?>/login">Đăng nhập</a></span>
                        </div>
                    </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).ready(function() {
			jQuery.validator.addMethod("phoneVN", function(phone_number, element) {
				phone_number = phone_number.replace(/\s+/g, "");
				return this.optional(element) || phone_number.length > 9 && 
				phone_number.match(/((09|03|07|08|05)+([0-9]{8})\b)/);
			}, "Please specify a valid phone number");
			jQuery.validator.addMethod(
				"regex",
				function(value, element, regexp) {
					var check = false;
					return this.optional(element) || regexp.test(value);
				},
				"Tên tài khoản không đúng định dạng."
			);

			$("#form-register").validate({
				rules: {
					"register_phone": {
						required: true,
						phoneVN: true,
						maxlength: 12
					},
					"register_name": {
						required: true,
						minlength: 8
					},
					"register_username": {
						required: true,
						regex: /^[a-zA-Z0-9 ]+$/,
						minlength: 6
					},
					"register_password": {
						required: true,
						minlength: 8
					}
				},
				messages: {
					"register_phone": {
						required: "Vui lòng nhập số điện thoại",
						phoneVN: "Số điện thoại không hợp lệ!",
						maxlength: "Số điện thoại không hợp lệ!"
					},
					"register_name": {
						required: "Vui lòng nhập họ tên",
						minlength: "Họ và tên không hợp lệ!"
					},
					"register_username": {
						required: "Vui lòng nhập tên đăng nhập",
						regex: "Tên đăng nhập không hợp lệ!",
						minlength: "Tên đăng nhập không hợp lệ!"
					},
					"register_password": {
						required: "Vui lòng nhập mật khẩu",
						minlength: "Mật khẩu đăng nhập không hợp lệ!"
					}
				}
			});
			$("#btn-register").on("click",function()
			{
				if($("#form-register").valid())
				{
					var phone = $("#register_phone").val();
					var name = $("#register_name").val();
					var username = $("#register_username").val();
					var password = $("#register_password").val();
					$.ajax({
							type: "POST",
							url: "<?php echo XC_URL;?>/api/register",
							data: {phone: phone,name: name, password: password, username: username},
							dataType: "json",
							cache: false,
							success: function(data)
							{
								console.log(data);
								if(data.status != "200")
								{
									Swal.fire({
									  icon: 'error',
									  title: 'Oops...',
									  text: data.message,
									  footer: '<a href>Xem thêm về lỗi này?</a>'
									})
								}
								else
								{
									Swal.fire({
									  icon: 'success',
									  title: 'Thành công',
									  text: 'Cảm ơn bạn đã đăng ký, hệ thống sẽ chuyển sang trang đăng nhập sau vài giây!',
									  timer: 1700
									})
								
									setTimeout(function(){ window.location= ("<?php echo XC_URL;?>/login");    }, 2000);
									//window.location= ("<?php echo XC_URL;?>/");                
								}
							}
						});
				}
				return false;
			});
		});
	</script>

</body>


</html>