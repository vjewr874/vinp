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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    
</head>

<body>

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
									/*
									$("#message").fadeIn(200);
									alert("Tài khoản hoặc mật khẩu không đúng, vui lòng kiểm tra lại...");
									*/
									Swal.fire({
									  icon: 'error',
									  title: 'Oops...',
									  text: 'Tài khoản hoặc mật khẩu không đúng, vui lòng thử lại!',
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
				});
					
		});
		</script>
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
                <div class="signin-block w400">
                    <h1 class="text-success-gradient fw-bold">Đăng nhập</h1>
                    <p>Đăng nhập vào tài khoản Khách hàng</p>
                    <div class="input-icon-group-right mb-4">
                        <input id="username" type="text" placeholder="Username/Tài khoản/Số điện thoại">
                        <span class="input-icon">
                            <i class="icofont-ui-user"></i>
                        </span>
                    </div>
					<div class="input-icon-group-right mb-4">
                        <input id="password" type="password" placeholder="Mật khẩu">
                        <span class="input-icon">
                            <i class="icofont-key"></i>
                        </span>
                    </div>
                    <a href="#" id="bntlogin" class="btn btn-light rounded-5">
                        Đăng nhập
                        <i class="icofont-long-arrow-right"></i>
                    </a>
                    <div class="mt-5">
                        <p>Chưa có tài khoản? <a href="<?php echo XC_URL;?>/register" class="text-white fw-bold">Đăng ký ngay</a></p>
                    </div>
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


    
    
    
    <script src="<?php echo $template_path; ?>/frontend/assets/js/app.min.js"></script>
    <script src="<?php echo $template_path; ?>/frontend/assets/js/scripts.js"></script>
</body>

</html>