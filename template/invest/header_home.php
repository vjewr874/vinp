<?php include "config.php";?>
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
    <div class="main--body">
        <!--========== Preloader ==========-->
        <div class="loader">
            <div class="loader-inner">
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
            </div>
        </div>
        <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
        <div class="overlay"></div>
        <!--========== Preloader ==========-->
        

        <!--=======Header-Section Starts Here=======-->
        <header class="header-section">
            <div class="header-top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <ul class="support-area">
                                <li>
                                    <a href="#0"><i class="flaticon-support"></i>Hỗ trợ</a>
                                </li>
                                <li>
                                    <a href="Mailto:#"><i class="flaticon-email"></i>support@investpro.asia </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">                            
                            <ul class="cart-area">
                                <li>
                                    <i class="flaticon-globe"></i>
                                    <div class="select-area">
                                        <select class="select-bar">
                                            <option value="vi">Tiếng Việt</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                </li>
								<?php
								if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] != "")
								{
									?>
									<li>
										<a href="<?php echo XC_URL;?>/dashboard">Xin chào, <?php echo $_SESSION['user']['username']; ?>!</a>
									</li>
								<?php
								}
								else
								{
									?>
									<li>
										<a href="<?php echo XC_URL;?>/login">Đăng nhập</a>
									</li>
									<li>
										<a href="<?php echo XC_URL;?>/register">Đăng ký</a>
									</li>
									<?php
								}
								?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <div class="header-area">
                        <div class="logo">
                            <a href="<?php echo XC_URL;?>">
                                <img src="<?php echo $template_path; ?>/assets/images/logo/logo.png" alt="logo">
                            </a>
                        </div>
                        <ul class="menu">
                            <li>
                                <a href="<?php echo XC_URL;?>">Trang chủ</a>
                            </li>
                            
                            <li>
                                <a href="<?php echo XC_URL;?>/page/about">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="<?php echo XC_URL;?>/page/faq">Faqs</a>
                            </li>
                            <li>
                                <a href="<?php echo XC_URL;?>/page/contact">Liên hệ</a>
                            </li>
                            <li class="pr-0">
								<?php
								if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] != "")
								{
									?>
									 <a href="<?php echo XC_URL;?>/dashboard" class="custom-button">Trung tâm Hội viên</a>
									<?php
								}
								else
								{
									?>
									<a href="<?php echo XC_URL;?>/login" class="custom-button">Đăng nhập</a>
									<?php
								}
								?>
                               
                            </li>
                        </ul>
                        <div class="header-bar d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--=======Header-Section Ends Here=======-->
