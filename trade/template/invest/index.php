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
										<a href="<?php echo XC_URL;?>/dashboard">Xin chào, <?php echo $_SESSION['user']['fullname']; ?>!</a>
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
                            <a href="index.html">
                                <img src="<?php echo $template_path; ?>/assets/images/logo/logo.png" alt="logo">
                            </a>
                        </div>
                        <ul class="menu">
                            <li>
                                <a href="<?php echo XC_URL;?>">Trang chủ</a>
                            </li>
                            
                            <li>
                                <a href="about.html">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="faq.html">Faqs</a>
                            </li>
                            <li>
                                <a href="contact.html">Liên hệ</a>
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


        <!--=======Banner-Section Starts Here=======-->
        <section class="banner-section" id="home">
            <div class="banner-bg d-lg-none">
                <img src="<?php echo $template_path; ?>/assets/images/banner/banner-bg2.jpg" alt="banner">
            </div>
            <div class="banner-bg d-none d-lg-block bg_img" data-background="<?php echo $template_path; ?>/assets/images/banner/banner.jpg">
                <div class="chart-1 wow fadeInLeft" data-wow-delay=".5s" data-wow-duration=".7s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/chart1.png" alt="banner">
                </div>
                <div class="chart-2 wow fadeInDown" data-wow-delay="1s" data-wow-duration=".7s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/chart2.png" alt="banner">
                </div>
                <div class="chart-3 wow fadeInRight" data-wow-delay="1.5s" data-wow-duration=".7s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/chart3.png" alt="banner">
                </div>
                <div class="chart-4 wow fadeInUp" data-wow-delay="2s" data-wow-duration=".7s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/clock.png" alt="banner">
                </div>
            </div>
            <div class="animation-area d-none d-lg-block">
                <div class="plot">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/plot.png" alt="banner">
                </div>
                <div class="element-1 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/light.png" alt="banner">
                </div>
                <div class="element-2 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/coin1.png" alt="banner">
                </div>
                <div class="element-3 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/coin2.png" alt="banner">
                </div>
                <div class="element-4 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/coin3.png" alt="banner">
                </div>
                <div class="element-5 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/coin4.png" alt="banner">
                </div>
                <div class="element-6 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/coin5.png" alt="banner">
                </div>
                <div class="element-7 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/coin6.png" alt="banner">
                </div>
                <div class="element-8 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/sheild.png" alt="banner">
                </div>
                <div class="element-9 wow fadeIn" data-wow-delay="1s">
                    <img src="<?php echo $template_path; ?>/assets/images/banner/coin7.png" alt="banner">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7">
                        <div class="banner-content">
                            <h1 class="title">Nền tảng giao dịch <span>Tiền điện tử </span> Hàng đầu</h1>
                            <p>
                                Kiếm lời từ giao dịch tiền mã hoá ngay hôm nay!
                            </p>
                            <div class="button-group">
                                <a href="sign-up.html" class="custom-button">Đăng ký ngay</a>
                                <a href="#" class="popup video-button"><i class="flaticon-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======Banner-Section Ends Here=======-->


        <!--=======Counter-Section Starts Here=======-->
        <div class="counter-section">
            <div class="container">
                <div class="row align-items-center mb-30-none justify-content-center">
                    <div class="col-sm-6 col-md-4">
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="<?php echo $template_path; ?>/assets/images/counter/counter01.png" alt="counter">
                            </div>
                            <div class="counter-content">
                                <div class="counter-header">
                                    <h3 class="title odometer" data-odometer-final="36.9">0</h3><h3 class="title">M</h3>
                                </div>
                                <p>Khách hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="<?php echo $template_path; ?>/assets/images/counter/counter02.png" alt="counter">
                            </div>
                            <div class="counter-content">
                                <div class="counter-header">
                                    <h3 class="title odometer" data-odometer-final="174">0</h3>
                                </div>
                                <p>Quốc gia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="<?php echo $template_path; ?>/assets/images/counter/counter03.png" alt="counter">
                            </div>
                            <div class="counter-content">
                                <div class="counter-header">
                                    <h3 class="title">$</h3><h3 class="odometer title" data-odometer-final="10.8">0</h3><h3 class="title">M</h3>
                                </div>
                                <p>Lợi nhuận trung bình</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=======Counter-Section Ends Here=======-->


        <!--=======About-Section Starts Here=======-->
        <section class="about-section padding-top padding-bottom" id="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-none d-lg-block rtl">
                        <img src="<?php echo $template_path; ?>/assets/images/about/about.png" alt="about">
                    </div>
                    <div class="col-lg-6">
                        <div class="section-header left-style">
                            <span class="cate">UY TÍN - AN TOÀN - PHÁT TRIỂN</span>
                            <h2 class="title">INVEST PRO</h2>
                            <p>
                                CHÚNG TÔI HIỂU BẠN VÀ GIÚP BẠN ĐẠT ĐƯỢC MỤC TIÊU CỦA MÌNH , ĐỒNG THỜI CÁC NHÀ TƯ VẤN SỬ DỤNG TƯ DUY TỐT NHẤT VÀ CÔNG NGHỆ SÁNG TẠO CỦA CHÚNG TÔI ĐỂ XÂY DỰNG KẾ HOẠCH CỦA BẠN. BẠN ĐỀ XUẤT KẾ HOẠCH CỦA BẠN VÀ CHÚNG TÔI GIÚP BẠN ÁP DỤNG NÓ VÀO TRONG THỰC TẾ.
                            </p>
                        </div>
                        <div class="about--content">
                            <div class="about-item">
                                <div class="about-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/about/about01.png" alt="about">
                                </div>
                                <div class="about-content">
                                    <h5 class="title">An toàn & Bảo mật</h5>
                                    <p>
                                        Công nghệ bảo mật chuỗi khối Blockchain
                                    </p>
                                </div>
                            </div>
                            <div class="about-item">
                                <div class="about-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/about/about02.png" alt="about">
                                </div>
                                <div class="about-content">
                                    <h5 class="title">Nạp/rút nhanh chóng</h5>
                                    <p>
                                        Hỗ trợ nạp rút 24/7
                                    </p>
                                </div>
                            </div>
                            <div class="about-item">
                                <div class="about-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/about/about03.png" alt="about">
                                </div>
                                <div class="about-content">
                                    <h5 class="title">Chứng nhận toàn cầu</h5>
                                    <p>
										Nền tảng được chứng nhận bởi nhiều tổ chức uy tín.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======About-Section Ends Here=======-->


        <!--=======Feature-Section Starts Here=======-->
        <section class="feature-section padding-top padding-bottom bg_img" data-background="./assets/images/feature/feature-bg.png" id="feature">
            <div class="ball-1" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
            data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="<?php echo $template_path; ?>/assets/images/balls/ball1.png" alt="balls">
            </div>
            <div class="ball-2" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
            data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="<?php echo $template_path; ?>/assets/images/balls/ball2.png" alt="balls">
            </div>
            <div class="ball-3" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
            data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="<?php echo $template_path; ?>/assets/images/balls/ball3.png" alt="balls">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="section-header">
                            <span class="cate">ĐẦU TƯ TIỀN BITCOIN MỞ RA MỘT KỶ NGUYÊN MỚI</span>
                            <h2 class="title">
                                MỞ RA TƯƠNG LAI CỦA CÔNG NGHỆ
                            </h2>
                            <p class="mw-100">
                                TỰ HÀO LÀ ĐỒNG TIỀN QUAN TRỌNG TRONG LƯU THÔNG VÀ LÀ ĐỘNG LỰC QUAN TRỌNG CỦA TRUNG TÂM TÀI CHÍNH QUỐC TẾ
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center feature-wrapper">
                    <div class="col-md-6 col-sm-10 col-lg-4">
                        <div class="feature-item">
                            <div class="feature-thumb">
                                <img src="<?php echo $template_path; ?>/assets/images/feature/feature01.png" alt="feature">
                            </div>
                            <div class="feature-content">
                                <h5 class="title">Tính ổn định</h5>
                                <p>NỀN TẢNG VỮNG CHẮC VÀ CÁC BIỆN PHÁP ĐẢM BẢO CHẤT LƯỢNG ĐỂ BẢO VỆ MỌI NGƯỜI DÙNG.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-10 col-lg-4">
                        <div class="feature-item">
                            <div class="feature-thumb">
                                <img src="<?php echo $template_path; ?>/assets/images/feature/feature02.png" alt="feature">
                            </div>
                            <div class="feature-content">
                                <h5 class="title">Đường truyền dữ liệu</h5>
                                <p>DỮ LIỆU ĐƯỢC TRUYỀN BẰNG CÁCH SỬ DỤNG KẾT NỐI AN TOÀN CỦA LỚP TRUYÊN TẢI ĐƯỢC MÃ HÓA.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-10 col-lg-4">
                        <div class="feature-item">
                            <div class="feature-thumb">
                                <img src="<?php echo $template_path; ?>/assets/images/feature/feature03.png" alt="feature">
                            </div>
                            <div class="feature-content">
                                <h5 class="title">Dịch vụ Khách hàng 24/7</h5>
                                <p>Hỗ trợ và tư vấn 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======Feature-Section Ends Here=======-->


        <!--=======How-Section Starts Here=======-->
        <section class="get-section padding-top padding-bottom">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="section-header">
                            <span class="cate">Bắt đầu kiếm lợi nhuận ngay hôm nay</span>
                            <h2 class="title">Bắt đầu với 3 bước</h2>
                        </div>
                    </div>
                </div>
                <div class="hover-tab">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 d-lg-block d-none">
                            <div class="hover-tab-area">
                                <div class="tab-area">
                                    <div class="tab-item active first">
                                        <img src="<?php echo $template_path; ?>/assets/images/how/how01.png" alt="how">
                                    </div>
                                    <div class="tab-item second">
                                        <img src="<?php echo $template_path; ?>/assets/images/how/how02.png" alt="how">
                                    </div>
                                    <div class="tab-item third">
                                        <img src="<?php echo $template_path; ?>/assets/images/how/how03.png" alt="how">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-9">
                            <div class="hover-tab-menu">
                                <ul class="tab-menu">
                                    <li class="active">
                                        <div class="menu-thumb">
                                            <span>
                                                01
                                            </span>
                                        </div>
                                        <div class="menu-content">
                                            <h5 class="title">Đăng ký tài khoản</h5>
                                            <p>
                                                <a href="#0">Đăng ký ngay</a> chỉ với 30 giây.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="menu-thumb">
                                            <span>
                                                02
                                            </span>
                                        </div>
                                        <div class="menu-content">
                                            <h5 class="title">Giao dịch ngay</h5>
                                            <p>
                                                <a href="#0">Giao dịch</a> dễ dàng, nhanh chóng.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="menu-thumb">
                                            <span>
                                                03
                                            </span>
                                        </div>
                                        <div class="menu-content">
                                            <h5 class="title">Kiếm lời</h5>
                                            <p>
                                                Lợi nhuận tức thời, bạn có thể rút bất kỳ lúc nào.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======How-Section Ends Here=======-->


        


        <!--=======Offer-Section Stars Here=======-->
        <section class="offer-section padding-top padding-bottom pb-max-md-0"  id="plan" style="background-color: #0b203a;">
            <div class="ball-group-1" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
            data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="<?php echo $template_path; ?>/assets/images/balls/ball-group1.png" alt="balls">
            </div>
            <div class="ball-group-2" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
            data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="<?php echo $template_path; ?>/assets/images/balls/ball-group2.png" alt="balls">
            </div>
            <div class="container">
				<div class="tradingview-widget-container">
					<div class="tradingview-widget-container__widget"></div>
					
					<script type="text/javascript"
							src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
						{
							"colorTheme": "dark",
							"dateRange": "12M",
							"showChart": true,
							"locale": "en",
							"largeChartUrl": "",
							"isTransparent": true,
							"showSymbolLogo": true,
							"width": "1110",
							"height": "600",
							"plotLineColorGrowing": "rgba(25, 118, 210, 1)",
							"plotLineColorFalling": "rgba(25, 118, 210, 1)",
							"gridLineColor": "rgba(42, 46, 57, 1)",
							"scaleFontColor": "rgba(120, 123, 134, 1)",
							"belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
							"belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
							"symbolActiveColor": "rgba(33, 150, 243, 0.12)",
							"tabs": [{
							"title": "Indices",
							"symbols": [{
								"s": "KRAKEN:ETHUSD"
							},
								{
									"s": "KRAKEN:EURUSD"
								},

								{
									"s": "KRAKEN:AUDUSD"
								},
								{
									"s": "KRAKEN:GBPUSD"
								},
								{
									"s": "KRAKEN:DASHUSD"
								},
								{
									"s": "KRAKEN:EOSUSD"
								},
								{
									"s": "KRAKEN:LTCUSD"
								}
							],
							"originalTitle": "Indices"
						},
							{
								"title": "Commodities",
								"symbols": [{
									"s": "CME_MINI:ES1!",
									"d": "S&P 500"
								},
									{
										"s": "CME:6E1!",
										"d": "Euro"
									},
									{
										"s": "COMEX:GC1!",
										"d": "Gold"
									},
									{
										"s": "NYMEX:CL1!",
										"d": "Crude Oil"
									},
									{
										"s": "NYMEX:NG1!",
										"d": "Natural Gas"
									},
									{
										"s": "CBOT:ZC1!",
										"d": "Corn"
									}
								],
								"originalTitle": "Commodities"
							},
							{
								"title": "Bonds",
								"symbols": [{
									"s": "CME:GE1!",
									"d": "Eurodollar"
								},
									{
										"s": "CBOT:ZB1!",
										"d": "T-Bond"
									},
									{
										"s": "CBOT:UB1!",
										"d": "Ultra T-Bond"
									},
									{
										"s": "EUREX:FGBL1!",
										"d": "Euro Bund"
									},
									{
										"s": "EUREX:FBTP1!",
										"d": "Euro BTP"
									},
									{
										"s": "EUREX:FGBM1!",
										"d": "Euro BOBL"
									}
								],
								"originalTitle": "Bonds"
							},
							{
								"title": "Forex",
								"symbols": [{
									"s": "FX:EURUSD"
								},
									{
										"s": "FX:GBPUSD"
									},
									{
										"s": "FX:USDJPY"
									},
									{
										"s": "FX:USDCHF"
									},
									{
										"s": "FX:AUDUSD"
									},
									{
										"s": "FX:USDCAD"
									}
								],
								"originalTitle": "Forex"
							}
						]
						}
					</script>
				</div>
                
            </div>
        </section>
        <!--=======Offer-Section Ends Here=======-->



        <!--=======Latest-Transaction-Section Starts Here=======-->
        <section class="latest-transaction padding-top padding-bottom" id="transaction" style="display: none;">
            <div class="transaction-bg bg_img" data-background="<?php echo $template_path; ?>/assets/images/transaction/transaction-bg.png">
                <span class="d-none">Image</span>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <div class="section-header">
                            <span class="cate">Latest Transactions</span>
                            <h2 class="title">Monthly Income Feed</h2>
                            <p>Our goal is to simplify investing so that anyone can be an investor.Withthis in mind, 
                            we hand-pick the investments we offer on our platform.</p>
                        </div>
                    </div>
                </div>
                <div class="tab transaction-tab d-flex flex-wrap justify-content-center">
                    <ul class="tab-menu">
                        <li class="active">
                            <div class="thumb">
                                <i class="flaticon-wallet"></i>
                            </div>
                            <div class="content">
                                <span class="d-block">last</span>
                                <span class="d-block">deposits</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb">
                                <i class="flaticon-atm"></i>
                            </div>
                            <div class="content">
                                <span class="d-block">last</span>
                                <span class="d-block">withdrawals</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb">
                                <i class="flaticon-team"></i>
                            </div>
                            <div class="content">
                                <span class="d-block">last</span>
                                <span class="d-block">investors</span>
                            </div>
                        </li>
                    </ul>
                    <div class="tab-area">
                        <div class="tab-item active">
                            <div class="row justify-content-center mb-30-none">
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">KimHowell21</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction01.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 BTC</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">ildar25864</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction02.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 ETH</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Buha74</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction03.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 LTC</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Eduardo54</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction04.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 XRP</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Pedro33</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction05.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 USD</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Nelson35</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction06.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 XRP</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Doug9544</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction07.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 USD</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Hector 951</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction08.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 LTC</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-item">
                            <div class="row justify-content-center mb-30-none">
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Doug9544</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction07.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 USD</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Hector 951</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction08.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 LTC</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">KimHowell21</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction01.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 BTC</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">ildar25864</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction02.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 ETH</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Buha74</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction03.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 LTC</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Eduardo54</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction04.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 XRP</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Pedro33</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction05.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 USD</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Nelson35</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction06.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 XRP</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-item">
                            <div class="row justify-content-center mb-30-none">
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Buha74</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction03.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 LTC</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Eduardo54</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction04.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 XRP</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Pedro33</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction05.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 USD</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Nelson35</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction06.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 XRP</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Doug9544</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction07.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 USD</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">Hector 951</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction08.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 LTC</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">KimHowell21</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction01.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 BTC</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-3 col-sm-6">
                                    <div class="transaction-item">
                                        <div class="transaction-header">
                                            <h5 class="title">ildar25864</h5>
                                            <span class="date">December 24, 17:57</span>
                                        </div>
                                        <div class="transaction-thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/transaction/transaction02.png" alt="transaction">
                                        </div>
                                        <div class="transaction-footer">
                                            <span class="amount">Amount</span>
                                            <h5 class="sub-title">0.00449721 ETH</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======Latest-Transaction-Section Ends Here=======-->


        


        <!--=======Check-Section Starts Here=======-->
        <section class="client-section padding-bottom padding-top" >
            <div class="background-map">
                <img src="<?php echo $template_path; ?>/assets/images/client/client-bg.png" alt="client">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10">
                        <div class="section-header left-style">
                            <span class="cate">ĐÁNH GIẢ KHÁCH HÀNG</span>
                            <h2 class="title"><span>40,000+</span> Khách hàng giao dịch mỗi ngày</h2>
                            <p class="mw-500">
                               Chúng tôi tự hào cung cấp nền tảng giao dịch tốt nhất cho hơn 12 triệu giao dịch mỗi ngày!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9">
                        <div class="m--30">
                            <div class="client-slider owl-carousel owl-theme">
                                <div class="client-item">
                                    <div class="client-content">
                                        <p>
                                            Hỗ trợ và tư vấn chuyên nghiệp.
                                        </p>
                                        <div class="rating">
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star-half-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="client-thumb">
                                        <a href="#0">
                                            <img src="<?php echo $template_path; ?>/assets/images/client/client01.png" alt="client">
                                        </a>
                                    </div>
                                </div>
                                <div class="client-item">
                                    <div class="client-content">
                                        <p>
                                            Nền tảng GD tại Invest Pro rất dễ sử dụng.
                                        </p>
                                        <div class="rating">
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star-half-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="client-thumb">
                                        <a href="#0">
                                            <img src="<?php echo $template_path; ?>/assets/images/client/client02.png" alt="client">
                                        </a>
                                    </div>
                                </div>
                                <div class="client-item">
                                    <div class="client-content">
                                        <p>
                                            Tôi đã gia tăng 300% tài khoản chỉ sau 1 tháng.
                                        </p>
                                        <div class="rating">
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>
                                                <i class="fas fa-star-half-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="client-thumb">
                                        <a href="#0">
                                            <img src="<?php echo $template_path; ?>/assets/images/client/client03.png" alt="client">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======Check-Section Ends Here=======-->

        
        <!-- ==========Footer-Section Starts Here========== -->
        <footer class="footer-section">
            <div class="newslater-section padding-bottom">
                <div class="container">
                    <div class="newslater-area">
                        <div class="newslater-content padding-bottom padding-top">
                            <span class="cate">ĐĂNG KÝ NHẬN ƯU ĐÃI TỪ INVEST PRO</span>
                            <h3 class="title">Chiến lược giao dịch độc quyền hàng đầu</h3>
                            <form class="newslater-form">
                                <input type="text" placeholder="Vui lòng nhập email" required>
                                <button type="submit">Đăng ký</button>
                            </form>
                        </div>
                        <div class="newslater-thumb">
                            <img src="<?php echo $template_path; ?>/assets/images/footer/footer.png" alt="footer">
                            <div class="coin-1">
                                <img src="<?php echo $template_path; ?>/assets/images/footer/Coin_01.png" alt="footer">
                            </div>
                            <div class="coin-2">
                                <img src="<?php echo $template_path; ?>/assets/images/footer/Coin_02.png" alt="footer">
                            </div>
                            <div class="coin-3">
                                <img src="<?php echo $template_path; ?>/assets/images/footer/Coin_03.png" alt="footer">
                            </div>
                            <div class="coin-4">
                                <img src="<?php echo $template_path; ?>/assets/images/footer/Coin_04.png" alt="footer">
                            </div>
                            <div class="coin-5">
                                <img src="<?php echo $template_path; ?>/assets/images/footer/Coin_05.png" alt="footer">
                            </div>
                            <div class="coin-6">
                                <img src="<?php echo $template_path; ?>/assets/images/footer/Coin_06.png" alt="footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="footer-top">
                    <div class="logo">
                        <a href="index.html">
                            <img src="<?php echo $template_path; ?>/assets/images/logo/footer-logo.png" alt="logo">
                        </a>
                    </div>
                    <ul class="links">
                        <li>
                            <a href="#0">Giới thiệu</a>
                        </li>
                        <li>
                            <a href="#0">Điều khoản</a>
                        </li>
                        <li>
                            <a href="#0">FAQ</a>
                        </li>
                        <li>
                            <a href="#0">Liên hệ</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-bottom">
                    <div class="footer-bottom-area">
                        <div class="left">
                            <p>&copy; 2018 - 2021 <a href="#0">Invest Pro Co., Ltd</a> | All right reserved</p>
                        </div>
                        <ul class="social-icons">
                            <li>
                                <a href="#0">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#0" class="active">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ==========Footer-Section Ends Here========== -->

        
    </div>

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
</body>
</html>