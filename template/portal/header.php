<?php include "config.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LightNing999 - Customer Portal </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $template_path;?>/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="<?php echo $template_path;?>/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?php echo $template_path;?>/vendor/owlcarousel/css/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $template_path;?>/css/style.css">
	<script src="<?php echo $template_path;?>/vendor/jquery/jquery.min.js"></script>
	
    <script src="<?php echo $template_path;?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $template_path;?>/vendor/waves/waves.min.js"></script>
<script src="<?php echo $template_path;?>/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
</head>

<body class="dashboard">
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6092b5fc185beb22b30a527f/1f4uhdphh';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="header dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-lg navbar-light px-0">
                            <a class="navbar-brand" href="<?php echo XC_URL;?>"><img src="<?php echo $template_path;?>/images/logo-ln.png" alt=""></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo XC_URL;?>/dashboard">Tổng quan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" target="_blank" href="http://lightning.vcfmedia.com/trading?game=700&auth=<?php echo $this->config->_config("auth");?>&token=<?php echo $_SESSION['token'];?>">Giao dịch</a>
                                    </li>
									<li class="nav-item">
                                        <a class="nav-link" href="<?php echo XC_URL;?>/tai-khoan.html">Tài khoản</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo XC_URL;?>/lich-su-giao-dich.html">Lịch sử giao dịch</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo XC_URL;?>/ho-so.html">Hồ sơ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard_log my-2">
                                <div class="d-flex align-items-center">
                                    <div class="account_money">
                                        <ul>
                                            <li class="crypto">
                                                <span><?php echo number_format($cus->cus_balance,0);?> VNĐ</span>
                                                <i class="fa fa-money"></i>
                                            </li>
                                            <li class="usd">
                                                <span><?php echo number_format($cus->cus_point,0);?> Điểm</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="profile_log dropdown">
                                        <div class="user" data-toggle="dropdown">
                                            <span class="thumb"><i class="la la-user"></i></span>
                                            <span class="name"><?php echo $cus->cus_fullname;?></span>
                                            <span class="arrow"><i class="la la-angle-down"></i></span>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="<?php echo XC_URL;?>/tai-khoan.html" class="dropdown-item">
                                                <i class="la la-user"></i> Tài khoản
                                            </a>
                                            <a href="<?php echo XC_URL;?>/lich-su-giao-dich.html" class="dropdown-item">
                                                <i class="la la-book"></i> Lịch sử giao dịch
                                            </a>
                                            <a href="<?php echo XC_URL;?>/cai-dat.html" class="dropdown-item">
                                                <i class="la la-cog"></i> Thiết lập
                                            </a>
                                            <a href="<?php echo XC_URL;?>/logout" class="dropdown-item logout">
                                                <i class="la la-sign-out"></i> Đăng xuất
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="page_title section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page_title-content">
                            <p>Xin chào, <span> <?php echo $cus->cus_fullname;?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>