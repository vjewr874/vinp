<?php include "config.php"; ?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo $template_path; ?>/frontend/assets/img/favicon.png" type="image/gif" sizes="16x16">
    <title>Lightning999</title>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo $template_path; ?>/frontend/assets/css/base-style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $template_path; ?>/frontend/assets/css/style.css" />
	<script src="<?php echo $template_path;?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo $template_path;?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $template_path;?>/vendor/waves/waves.min.js"></script>
    <script src="<?php echo $template_path; ?>/frontend/assets/js/app.min.js"></script>
    <script src="<?php echo $template_path; ?>/frontend/assets/js/scripts.js"></script>
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
</head>

<body>


<section class="ch-preloader-sec">
    <div id="ch-preloader">

        <div id="chp-top" class="mask">
        <div class="plane"></div>
        </div>
        <div id="chp-middle" class="mask">
        <div class="plane"></div>
        </div>

        <div id="chp-bottom" class="mask">
        <div class="plane"></div>
        </div>
        
        <p><i>LOADING...</i></p>
        
    </div>
</section>

<div class="ch-banner-sec">

    
<canvas id="particles"></canvas>
    <header class="ch-header-sec">
        <div class="container-fluid">
            <div class="header-top py-2 text-white">
                <p>Bitcoin Rate $1756.38 <i class="icofont-long-arrow-up"></i> 17.65%</p>
                <div class="h-lang">
                    <span class="lang-text">Ngôn ngữ</span>
                    <div class="">
                        <label class="lang-item">
                            <input type="radio" name="lang">
                            <span>EN</span>
                        </label>
                        <label class="lang-item">
                            <input type="radio" name="lang" checked>
                            <span>VN</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="ch-header rounded-10 py-2 py-xl-0 bg-white px-3">
                <a href="<?php echo XC_URL;?>" class="h-logo pe-3">
                    <img src="<?php echo $template_path; ?>/frontend/assets/img/lightning-logo-n.png" alt="Logo">
                </a>
                <div class="header-right">
                    <div class="h-menu-wrap d-none d-xl-block">
                        <ul class="h-menu">
                            <li><a href="<?php echo XC_URL;?>" class="active">Trang chủ</a></li>
                            <li><a href="#">Giới thiệu</a></li>
                            <li><a href="#">Khuyến mãi</a></li>
                            <li><a href="#">Tin tức</a></li>
                            <li><a href="#">Liên hệ</a></li>
                        </ul>
                    </div>
                    <div class="menu-trigger d-xl-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="h-btn d-none d-xl-block ms-xl-4">
						<?php if(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")
						{
							?>
							<a href="<?php echo XC_URL;?>/dashboard" class="btn btn-primary rounded-40">
								Bảng điều khiển
							</a>
							<?php
						}
						else
						{
							?>
							<a href="<?php echo XC_URL;?>/login" class="btn btn-primary rounded-40">
								Đăng nhập
							</a>
							<a href="<?php echo XC_URL;?>/register" class="text-heading fw-semibold ms-3">
								Đăng ký
							</a>
							<?php
						}
						?>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-wrap d-xl-none">
            <div class="menu-close">
                <i class="icofont-close-line"></i>
            </div>
            <div class="mobile-menu"></div>
            <div class="my-4">
				<?php if(isset($_SESSION['user']["id"]) && $_SESSION['user']["id"] != "")
				{
					?>
					<a href="<?php echo XC_URL;?>/dashboard" class="btn btn-primary rounded-40">
						Bảng điều khiển
					</a>
					<?php
				}
				else
				{
					?>
					<a href="<?php echo XC_URL;?>/login" class="btn btn-primary rounded-40 me-3">
						Đăng nhập
					</a>
					<a href="<?php echo XC_URL;?>/register" class="btn btn-primary rounded-40">
						Đăng ký
					</a>
					<?php
				}
				?>
                
            </div>
        </div>
    </header>



    



    <div class="py-100">
        <div class="container">
            <div class="">
                <div class="signin-block w500">
                    <h1 class="fw-bold text-white">
                        Đăng ký <span class="text-success-gradient">Tài khoản</span>
                    </h1>
                    <p>Giao dịch ngay hôm nay cùng nền tảng giao dịch toàn cầu</p>
					<form id="form-register">
                    <div class="w400">
                        <div class="input-icon-group-right mb-4">
                            <input type="text" id="register_phone" name="register_phone"  required placeholder="Số điện thoại">
                            <span class="input-icon">
                                <i class="icofont-smart-phone"></i>
                            </span>
							
                        </div>
						<div class="input-icon-group-right mb-4">
                            <input type="text" id="register_username" name="register_username"  required placeholder="Tài khoản">
                            <span class="input-icon">
                                <i class="icofont-ui-user"></i>
                            </span>
							
                        </div>
						<div class="input-icon-group-right mb-4">
                            <input type="text" id="register_name" name="register_name"  required placeholder="Họ và tên">
                            <span class="input-icon">
                                <i class="icofont-ui-user"></i>
                            </span>
                        </div>
						<div class="input-icon-group-right mb-4">
                            <input type="password" id="register_password" name="register_password" required  placeholder="Mật khẩu">
                            <span class="input-icon">
                                <i class="icofont-key"></i>
                            </span>
                        </div>
                        <a href="#" id="btn-register" class="btn btn-light rounded-5">
                            Tiếp tục
                            <i class="icofont-long-arrow-right"></i>
                        </a>
                        <div class="mt-5">
                            <p>Đã có tài khoản? <a href="<?php echo XC_URL;?>/login" class="text-white fw-bold">Đăng nhập</a></p>
                        </div>
                    </div>
					</form>
                </div>
            </div>
        </div>
    </div>

</div>


<footer class="bg-secondary-gradient">
    

    <div class="copyright-sec border-top border-white">
        <div class="container">
            <div class="copyright-inner text-center d-block">
                <p>Copyright © 2021 Lightning999. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>


    
    
    
</body>

</html>