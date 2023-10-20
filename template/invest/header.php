<?php include "config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo ($page["title"])? $page["title"]." - " : ""; ?>Invest Pro - Sàn giao dịch toàn cầu</title>

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
	<script src="<?php echo $template_path; ?>/assets/js/jquery-3.3.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo $template_path; ?>/assets/js/modernizr-3.6.0.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/plugins.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js" integrity="sha512-mULnawDVcCnsk9a4aG1QLZZ6rcce/jSzEGqUkeOLy0b6q0+T6syHrxlsAGH7ZVoqC93Pd0lBqd6WguPWih7VHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo $template_path; ?>/assets/js/magnific-popup.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/wow.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/odometer.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/viewport.jquery.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/nice-select.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/owl.min.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/paroller.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/chart.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/circle-progress.js"></script>
    <script src="<?php echo $template_path; ?>/assets/js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="<?php echo $template_path; ?>/assets/images/favicon.png" type="image/x-icon">
</head>

<body>
    <div class="main--body dashboard-bg">
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
        <div class="overlay"></div>
        <!--========== Preloader ==========-->
        
        
        <!--=======SideHeader-Section Starts Here=======-->
        <div class="notify-overlay"></div>
        <section class="dashboard-section">
            <div class="side-header oh">
                <div class="cross-header-bar d-xl-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="site-header-container">
                    <div class="side-logo">
                        <a href="<?php echo XC_URL;?>/dashboard">
                            <img src="<?php echo $template_path; ?>/assets/images/logo/logo.png" alt="logo">
                        </a>
                    </div>
                    <ul class="dashboard-menu">
                        <li>
                            <a href="<?php echo XC_URL;?>/dashboard" class="<?php echo ($page["key"] == "dashboard")? "active" : "";?>"><i class="flaticon-man"></i>Tổng quan</a>
                        </li>
						
                        <li class="trade-menu-mobile">
                            <a href="<?php echo TRADE_URL; ?>/?_ckey=<?php echo $_SESSION['token'];?>&symbol=710" class="<?php echo ($page["key"] == "trading")? "active" : "";?>" target="_blank"><i class="flaticon-globe"></i>Giao dịch</a>
                        </li>
                        <li class="trade-menu-desktop">
                            <a target="_blank" href="<?php echo TRADE_URL; ?>/?_ckey=<?php echo $_SESSION['token'];?>&symbol=710" class="<?php echo ($page["key"] == "trading")? "active" : "";?>"><i class="flaticon-globe"></i>Giao dịch</a>
                        </li>
						<li>
                            <a href="<?php echo XC_URL;?>/lich-su-giao-dich.html" class="<?php echo ($page["key"] == "transactions")? "active" : "";?>"><i class="flaticon-coin"></i>Lịch sử</a>
                        </li>
                        <li>
                            <a href="<?php echo XC_URL;?>/nap-tien.html" class="<?php echo ($page["key"] == "deposit")? "active" : "";?>"><i class="flaticon-interest"></i>Nạp tiền</a>
                        </li>
                        <li>
                            <a href="<?php echo XC_URL;?>/rut-tien.html" class="<?php echo ($page["key"] == "withdraw")? "active" : "";?>"><i class="flaticon-atm"></i>Rút tiền</a>
                        </li>
                        <li style="display: none;">
                            <a href="<?php echo XC_URL;?>/doi-tac.html"><i class="flaticon-deal"></i>Đối tác</a>
                        </li>
                        <li>
                            <a href="<?php echo XC_URL;?>/ho-so.html"><i class="flaticon-gears"></i>Hồ sơ</a>
                        </li>
                        
                        <li style="display: none;">
                            <a href="<?php echo XC_URL;?>/ho-tro.html"><i class="flaticon-sms"></i>Hỗ trợ</a>
                        </li>
                        <li>
                            <a href="<?php echo XC_URL;?>/logout"><i class="flaticon-right-arrow"></i>Đăng xuất</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dasboard-body">
                <div class="dashboard-hero">
                    <div class="header-top">
                        <div class="container">
                            <div class="mobile-header d-flex justify-content-between d-lg-none align-items-center">
                                <div class="logo-m">
                                    <img src="<?php echo $template_path; ?>/assets/images/logo/footer-logo.png" alt="dashboard">
                                </div>
                                <div class="cross-header-bar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                            <div class="mobile-header-content d-lg-flex flex-wrap justify-content-lg-between align-items-center">
                                <ul class="support-area" style="">
									<!--
                                    <li>
                                        <a href="#0"><i class="flaticon-support"></i>Hỗ trợ trực tuyến</a>
                                    </li>
                                    <li>
                                        <a href="Mailto:#"><i class="flaticon-email"></i>support@investpro.asia </a>
                                    </li>
                                    <li>
                                        <i class="flaticon-globe"></i>
                                        <div class="select-area">
                                            <select class="select-bar" style="display: none;">
                                                <option value="vi">Tiếng Việt</option>
                                                <option value="en">English</option>
                                            </select>
                                        </div>
                                    </li>
									-->
                                </ul>
                                <div class="dashboard-header-right d-flex flex-wrap justify-content-center justify-content-sm-between justify-content-lg-end align-items-center">
                                    
                                    <ul class="dashboard-right-menus">
                                        <li>
                                            <a href="#0">
                                                <i class="flaticon-email-1"></i>
                                                <span class="number bg-theme-2">4</span>
                                            </a>
                                            <div class="notification-area">
                                                <div class="notifacation-header d-flex flex-wrap justify-content-between">
                                                    <span>4 New Notifications</span>
                                                    <a href="#0">Clear</a>
                                                </div>
                                                <ul class="notification-body">
                                                    <li>
                                                        <a href="#0">
                                                            <div class="icon">
                                                                <img src="<?php echo $template_path; ?>/assets/images/dashboard/author.png" alt="dashboard">
                                                            </div>
                                                            <div class="cont">
                                                                <span class="title">Robinhood Pandey</span>
                                                                <div class="message">Electus rem placeat perspiciatis saepe</div>
                                                                <span class="info">2 Sec ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#0">
                                                            <div class="icon">
                                                                <img src="<?php echo $template_path; ?>/assets/images/dashboard/author.png" alt="dashboard">
                                                            </div>
                                                            <div class="cont">
                                                                <span class="title">Robinhood Pandey</span>
                                                                <div class="message">Electus rem placeat perspiciatis saepe</div>
                                                                <span class="info">2 Sec ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#0">
                                                            <div class="icon">
                                                                <img src="<?php echo $template_path; ?>/assets/images/dashboard/author.png" alt="dashboard">
                                                            </div>
                                                            <div class="cont">
                                                                <span class="title">Robinhood Pandey</span>
                                                                <div class="message">Electus rem placeat perspiciatis saepe</div>
                                                                <span class="info">2 Sec ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="notifacation-footer text-center">
                                                    <a href="#0" class="view-all">View All</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#0">
                                                <i class="flaticon-notification"></i>
                                                <span class="number bg-theme">4</span>
                                            </a>
                                            <div class="notification-area">
                                                <div class="notifacation-header d-flex flex-wrap justify-content-between">
                                                    <span>4 New Notifications</span>
                                                    <a href="#0">Clear</a>
                                                </div>
                                                <ul class="notification-body">
                                                    <li>
                                                        <a href="#0">
                                                            <div class="icon">
                                                                <i class="flaticon-man"></i>
                                                            </div>
                                                            <div class="cont">
                                                                <span class="subtitle">New Affiliate Registered</span>
                                                                <span class="info">2 Sec ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#0">
                                                            <div class="icon">
                                                                <i class="flaticon-atm"></i>
                                                            </div>
                                                            <div class="cont">
                                                                <span class="subtitle">New deposit completed</span>
                                                                <span class="info">2 Sec ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#0">
                                                            <div class="icon">
                                                                <i class="flaticon-wallet"></i>
                                                            </div>
                                                            <div class="cont">
                                                                <span class="subtitle">New Withdraw completed</span>
                                                                <span class="info">2 Sec ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#0">
                                                            <div class="icon">
                                                                <i class="flaticon-exchange"></i>
                                                            </div>
                                                            <div class="cont">
                                                                <span class="subtitle">Fund Transfer Completed</span>
                                                                <span class="info">2 Sec ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="notifacation-footer text-center">
                                                    <a href="#0" class="view-all">View All</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#0" class="author">
                                                <div class="thumb">
                                                    <img src="<?php echo ($cus->cus_avatar)? $upload_path.'/users/'.$cus->cus_avatar : $template_path.'/assets/images/dashboard/user.png'; ?>" alt="dashboard">
                                                    <span class="checked">
                                                        <i class="flaticon-checked"></i>
                                                    </span>
                                                </div>
                                                <div class="content">
                                                    <h6 class="title"><?php echo $cus->cus_username;?></h6>
                                                    <span class="country"><?php echo number_format($cus->cus_balance,0);?> VNĐ</span>
                                                </div>
                                            </a>
                                            <div class="notification-area">
                                                <div class="author-header">
                                                    <div class="thumb">
                                                        <img src="<?php echo $template_path; ?>/assets/images/dashboard/author.png" alt="dashboard">
                                                    </div>
                                                    <h6 class="title"><?php echo $cus->cus_username;?></h6>
                                                    <a href="#"><?php echo number_format($cus->cus_balance,0);?> VNĐ</a>
                                                </div>
                                                <div class="author-body">
                                                    <ul>
                                                        <li>
                                                            <a href="#0"><i class="far fa-user"></i>Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="#0"><i class="fas fa-user-edit"></i>Edit Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo XC_URL;?>/logout"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php if($page["key"] != "trading")
					{
					?>
                    <div class="dashboard-hero-content text-white">
                        <h3 class="title"><?php echo $page["title"];?></h3>
                    </div>
					<?php
					}
					?>
                </div>