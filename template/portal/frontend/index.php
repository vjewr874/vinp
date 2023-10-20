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




    

    
    <div class="hero-banner-sec">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-5 d-none d-md-block">
                    <div class="hero-banner-img pe-md-5">
                        <img src="<?php echo $template_path; ?>/frontend/assets/img/bitcoin.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="hero-banner-text pt-5">
                        <h2>Nền tảng giao dịch 4.0</h2>
                        <h1><span>cùng</span> Lightning999</h1>
                        <p>Nền tảng giao dịch toàn cầu, hiện đại, uy tín và hiệu quả được chứng nhận.</p>
                        <a href="<?php echo XC_URL;?>/register" class="btn btn-success">
                            Đăng ký ngay
                            <i class="icofont-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="my--40 text-center">
    <div class="container">
        <div class="box-shadow p-3 p-sm-5 rounded-20 bg-white position-relative z-index-5">
            <div class="row">
                <div class="col-lg-8 mx-auto aos-init" data-aos="fade-up">
                    <h4>Vì sao chọn chúng tôi</h4>
                    <p>Chúng tôi là nền tảng quản lý tài sản được cá nhân hóa đầu tiên. Trên thị trường, chúng tôi đặt ra các mục tiêu và chiến lược đầu tư được cá nhân hóa theo nhu cầu, thuộc tính và khả năng chấp nhận rủi ro khác nhau của khách hàng, đồng thời hỗ trợ lựa chọn các công cụ phù hợp.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 py-3 aos-init" data-aos="fade-up">
                    <div class="icon-block">
                        <div class="mb-3">
                            <img src="<?php echo $template_path; ?>/frontend/assets/img/icon/4.png" alt="">
                        </div>
                        <div class="">
                            <h4>Đa thị trường</h4>
                            <p>Hỗ trợ giao dịch thị trường 24/7 với nhiều phương pháp đầu tư mang lại lợi nhuận cao.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 py-3 aos-init" data-aos="fade-up" data-aos-delay="150">
                    <div class="icon-block">
                        <div class="mb-3">
                            <img src="<?php echo $template_path; ?>/frontend/assets/img/icon/5.svg" alt="">
                        </div>
                        <div class="">
                            <h4>Đa dạng tiền tệ</h4>
                            <p>Chúng tôi hỗ trợ nhiều phương pháp giao dịch tối ưu hóa với thuật toán giao dịch hiện đại.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 py-3 aos-init" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-block">
                        <div class="mb-3">
                            <img src="<?php echo $template_path; ?>/frontend/assets/img/icon/6.png" alt="">
                        </div>
                        <div class="">
                            <h4>Đầu tư thông minh</h4>
                            <p>Đầu tư và giao dịch thông minh với công cụ và robot đầu tư</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="timeline-sec bg-secondary-gradient py-100">
    <img src="<?php echo $template_path; ?>/frontend/assets/img/shine-of-bitcoin.png" alt="" class="timeline-img d-none d-lg-block">
    <div class="container">
        <div class="sec-title text-center text-white sec-title-line-modern line-success position-relative aos-init aos-animate" data-aos="fade-up">
            <h1>Tính năng</h1>
            <p>Nền tảng giao dịch hàng đầu</p>
        </div>
        <div class="timeline">
            <div class="timeline-item">
                <div class="tli-head">
                    <h4>
                        <a href="#">Mục tiêu</a>
                    </h4>
                </div>
                <div class="tli-body">
                    <p>Ngoài việc tạo ra sự tăng trưởng thận trọng và chủ động từ đầu tư vốn, có thể cung cấp chuyển giao công nghệ, đào tạo nhân sự, Giá trị gia tăng của đầu tư chung, chia sẻ lợi nhuận, hợp tác xuyên biên giới và các cơ hội mua lại cũng đã trở thành tâm điểm chú ý của các nhà đầu tư.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="tli-head">
                    <h4>
                        <a href="#">Lợi thế</a>
                    </h4>
                </div>
                <div class="tli-body">
                    <p>Trong trường hợp không có các ưu đãi thuế tốt hơn, các loại hình công ty phổ biến nhất thường được sử dụng để thành lập các quỹ đầu tư mạo hiểm địa phương. Các nhà đầu tư là cổ đông của quỹ đầu tư mạo hiểm và lựa chọn một số giám đốc phù hợp theo quy mô của quỹ đầu tư mạo hiểm.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="tli-head">
                    <h4>
                        <a href="#">Giám sát</a>
                    </h4>
                </div>
                <div class="tli-body">
                    <p>Ủy ban Điều tiết Tài chính đã phê duyệt hoặc tuyên bố một loạt quỹ của công ty là hợp lệ, nhưng điều này không có nghĩa là các quỹ liên quan là hoàn toàn không có rủi ro. Các hoạt động trước đây của công ty quản lý quỹ không thể đảm bảo thu nhập đầu tư tối thiểu cho chuỗi quỹ của công ty, và công ty quản lý quỹ không chịu trách nhiệm về lãi lỗ của chuỗi quỹ của công ty, cũng như không đảm bảo thu nhập tối thiểu.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="tli-head">
                    <h4>
                        <a href="#">Chiến lược</a>
                    </h4>
                </div>
                <div class="tli-body">
                    <p>Chiến lược giao dịch ngắn hạn và dài hạn cung cấp những chiến thuật giao dịch mang lại hiệu quả cao.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-100" style="background:url('<?php echo $template_path; ?>/frontend/assets/img/bg.jpg')no-repeat scroll center/cover">
    <div class="container">
        <div class="counter-wrap counter-secondary-wrap">
            <div class="row text-center">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
						<?php 
							$rand3 = rand(5.34,261.96);
							$rand4 = rand(26500,115000);
							$rand5 = rand(120400,750400);
							$rand6 = rand(1120400,3750400);
							$rand7 = rand(251000,980000);
							?>
                        <div class="col-lg-3 col-sm-6 py-3 aos-init aos-animate" data-aos="fade-up">
                            <div class="counter-item">
                                <h2>
                                    <span class="counter-value" data-count="<?php echo $rand4;?>"><?php echo number_format($rand4,0);?></span>
                                </h2>
                                <p>Khách hàng</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="150">
                            <div class="counter-item">
                                <h2>
                                    <span class="counter-value" data-count="<?php echo $rand5;?>"><?php echo number_format($rand5,0);?></span>
                                </h2>
                                <p>Giao dịch hàng ngày</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                            <div class="counter-item">
                                <h2>
                                    <span class="counter-value" data-count="<?php echo $rand6;?>"><?php echo number_format($rand6,0);?></span>USD
                                </h2>
                                <p>Giá trị giao dịch</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="450">
                            <div class="counter-item">
                                <h2>
                                    <span class="counter-value" data-count="<?php echo $rand7;?>"><?php echo number_format($rand7,0);?></span>USD                          
                                </h2>
                                <p>Lợi nhuận</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container" style="height:40px !important">
  <div class="tradingview-widget-container__widget"></div>
  <!-- <div class="tradingview-widget-copyright"><a href="https://uk.tradingview.com" rel="noopener"
          target="_blank"><span class="blue-text">Ticker Tape</span></a> by TradingView</div> -->
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
    {
      "symbols": [{
        "proName": "FX_IDC:EURUSD",
        "title": "EUR/USD"
      },
      {
        "proName": "BITSTAMP:BTCUSD",
        "title": "BTC/USD"
      },
      {
        "proName": "BITSTAMP:ETHUSD",
        "title": "ETH/USD"
      },
      {
        "description": "USD/JPY",
        "proName": "KRAKEN:USDJPY"
      },
      {
        "description": "CND/USD",
        "proName": "BITFINEX:CNDUSD"
      }
      ],
        "showSymbolLogo": true,
          "colorTheme": "light",
            "isTransparent": true,
              "displayMode": "adaptive",
                "locale": "uk"
    }
  </script>
</div>
<!-- TradingView Widget END -->
<div class="py-100">
    <div class="container">
        <div class="sec-title text-center sec-title-line-modern aos-init" data-aos="fade-up">
            <h1><span>Tin </span> tức</h1>
            <p>Xem bài viết mới nhất từ Lightning999</p>
        </div>
        <div class="row">
            <div class="col-lg-6 aos-init" data-aos="fade-up">
                <div class="article-item bg-gray">
                    <div class="ai-img">
                        <a href="#" class="ai-img-inner">
                            <img src="https://tapchibitcoin.io/wp-content/uploads/2021/05/Muc-tieu-gia-eth-tiep-theo-1-180x135.png" alt="">
                        </a>
                    </div>
                    <div class="ai-text">
                        <div class="ai-meta">
                            <span>25 tháng 4 năm 2021</span>
                        </div>
                        <h5 class="ai-title">
                            <a href="#">Giá Ethereum sẽ đi về đâu tiếp theo sau khi đạt ATH mới?</a>
                        </h5>
                        <a href="#" class="readmore">
                            Xem chi tiết <i class="icofont-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 aos-init" data-aos="fade-up" data-aos-delay="150">
                <div class="article-item bg-gray">
                    <div class="ai-img">
                        <a href="#" class="ai-img-inner">
                            <img src="https://tapchibitcoin.io/wp-content/uploads/2021/05/bitcoin-tiep-can-60k-180x135.png" alt="">
                        </a>
                    </div>
                    <div class="ai-text">
                        <div class="ai-meta">
                            <span>25 tháng 4 năm 2021</span>
                        </div>
                        <h5 class="ai-title">
                            <a href="#">Giá BTC tiếp cận $ 60K: 5 điều cần chú ý trong tuần này</a>
                        </h5>
                        <a href="#" class="readmore">
                            Xem chi tiết <i class="icofont-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>          
                      
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-secondary">
                Xem các bài viết khác
                <i class="icofont-long-arrow-right"></i>
            </a>
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