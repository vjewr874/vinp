<?php
include_once('header_home.php');
?>

        <!--=======Banner-Section Starts Here=======-->
        <section class="hero-section bg_img" data-background="<?php echo $template_path; ?>/assets/images/about/hero-bg.png">
            <div class="container">
                <div class="hero-content">
                    <h1 class="title">Giới thiệu</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                           Giới thiệu
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!--=======Banner-Section Ends Here=======-->


        <!--=======About-Section Starts Here=======-->
        <section class="about-section padding-top padding-bottom section-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-none d-lg-block rtl">
                        <img src="<?php echo $template_path; ?>/assets/images/about/about.png" alt="about">
                    </div>
                    <div class="col-lg-6">
                        <div class="section-header left-style">
                            <span class="cate"><?php echo $this->helper->_config('website_name');?></span>
                            <h2 class="title">giới thiệu</h2>
                            <p>
                                <?php echo $this->helper->_config('website_description'); ?>
                            </p>
                        </div>
                        <div class="about--content">
                            <div class="about-item">
                                <div class="about-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/about/about01.png" alt="about">
                                </div>
                                <div class="about-content">
                                    <h5 class="title">An toàn</h5>
                                    <p>
                                        Nền tảng giao dịch 4.0 thời gian thực
                                    </p>
                                </div>
                            </div>
                            <div class="about-item">
                                <div class="about-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/about/about02.png" alt="about">
                                </div>
                                <div class="about-content">
                                    <h5 class="title">Rút tiền tức thời</h5>
                                    <p>
                                        Giao dịch rút tiền xử lý tức thời
                                    </p>
                                </div>
                            </div>
                            <div class="about-item">
                                <div class="about-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/about/about03.png" alt="about">
                                </div>
                                <div class="about-content">
                                    <h5 class="title">Toàn cầu</h5>
                                    <p>
                                        Giao dịch toàn cầu với hơn 3.000.000 nhà đầu tư.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======About-Section Ends Here=======-->


        <!--=======CEO-Section Starts Here=======-->
        <section class="ceo-section padding-bottom padding-top bg_img d-none" data-background="<?php echo $template_path; ?>/assets/images/about/ceo-bg.jpg">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-7 col-xl-6">
                        <div class="ceo-content">
                            <h3 class="title">Our goal is to be at the heart of the financial services industry</h3>
                            <div class="author">
                                <h6 class="subtitle"><a href="#0">Adam Phelps</a></h6>
                                <span class="info">CEO of hyipland</span>
                                <div class="sign">
                                    <img src="<?php echo $template_path; ?>/assets/images/about/sign-ceo.png" alt="about">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="ceo-thumb">
                            <img src="<?php echo $template_path; ?>/assets/images/about/certificate-ceo.png" alt="about">
                        </div>
                        <a href="#0" class="custom-button">Open Certificate</a>
                    </div>
                </div>
            </div>
        </section>
        <!--=======CEO-Section Ends Here=======-->


        <!--=======Mission-Section Starts Here=======-->
        <section class="mission-section padding-top padding-bottom">
            <div class="mission-shape">
                <img src="<?php echo $template_path; ?>/assets/images/mission/mission-shape.png" alt="about">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="section-header">
                            <span class="cate">Our Mission to help our user</span>
                            <h2 class="title">
                                To maximize Money
                            </h2>
                            <p class="mw-100">
                                We are worldwide investment company who are committed to the principle of revenue maximization and reduction of the financial risks at investing.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 rtl">
                        <div class="mission--thumb">
                            <img class="wow slideInLeft" src="<?php echo $template_path; ?>/assets/images/mission/mission.png" alt="about">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="mission-wrapper owl-theme owl-carousel">
                            <div class="mission-item">
                                <div class="mission-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/mission/1.png" alt="mission">
                                </div>
                                <div class="mission-content">
                                    <h5 class="title">Low invest</h5>
                                    <p>
                                        Praesent sagittis nibh vehicula diam tesque 
                                    </p>
                                    <a href="#0">Learn More <i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                            <div class="mission-item">
                                <div class="mission-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/mission/2.png" alt="mission">
                                </div>
                                <div class="mission-content">
                                    <h5 class="title">One tap invest</h5>
                                    <p>
                                        Praesent sagittis nibh vehicula diam tesque 
                                    </p>
                                    <a href="#0">Learn More <i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                            <div class="mission-item">
                                <div class="mission-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/mission/3.png" alt="mission">
                                </div>
                                <div class="mission-content">
                                    <h5 class="title">Max. returns</h5>
                                    <p>
                                        Praesent sagittis nibh vehicula diam tesque 
                                    </p>
                                    <a href="#0">Learn More <i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                            <div class="mission-item">
                                <div class="mission-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/mission/4.png" alt="mission">
                                </div>
                                <div class="mission-content">
                                    <h5 class="title">Transparency</h5>
                                    <p>
                                        Praesent sagittis nibh vehicula diam tesque 
                                    </p>
                                    <a href="#0">Learn More <i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======Mission-Section Ends Here=======-->


        <!--=======Investor-Section Starts Here=======-->
        <section class="investor-section padding-bottom padding-top pt-max-lg-0 d-none">
            <div class="ball-group-1 ball-group-4" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60" data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="<?php echo $template_path; ?>/assets/images/balls/ball-group4.png" alt="balls">
            </div>
            <div class="ball-group-2 ball-group-3" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30" data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="<?php echo $template_path; ?>/assets/images/balls/ball-group3.png" alt="balls">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-xl-6">
                        <div class="section-header">
                            <span class="cate">TRANDING PEOPLE</span>
                            <h2 class="title">
                                Our Top Investors
                            </h2>
                            <p>
                                A look at the top ten investors of all time and the strategies they used to make their money.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel owl-theme investor-slider">
                    <div class="investor-item">
                        <div class="investor-thumb">
                            <img src="<?php echo $template_path; ?>/assets/images/investor/investor1.png" alt="investor">
                        </div>
                        <div class="investor-content">
                            <h5 class="title"><a href="#0">Sean Obrien</a></h5>
                            <h3 class="amount">$50,000.00</h3>
                        </div>
                    </div>
                    <div class="investor-item">
                        <div class="investor-thumb">
                            <img src="<?php echo $template_path; ?>/assets/images/investor/investor2.png" alt="investor">
                        </div>
                        <div class="investor-content">
                            <h5 class="title"><a href="#0">Sylvia Fox</a></h5>
                            <h3 class="amount">$50,000.00</h3>
                        </div>
                    </div>
                    <div class="investor-item">
                        <div class="investor-thumb">
                            <img src="<?php echo $template_path; ?>/assets/images/investor/investor3.png" alt="investor">
                        </div>
                        <div class="investor-content">
                            <h5 class="title"><a href="#0">Dexter Nichols</a></h5>
                            <h3 class="amount">$50,000.00</h3>
                        </div>
                    </div>
                    <div class="investor-item">
                        <div class="investor-thumb">
                            <img src="<?php echo $template_path; ?>/assets/images/investor/investor4.png" alt="investor">
                        </div>
                        <div class="investor-content">
                            <h5 class="title"><a href="#0">Tami Oliver</a></h5>
                            <h3 class="amount">$50,000.00</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=======Investor-Section Ends Here=======-->
        

        <!--=======Check-Section Starts Here=======-->
        <section class="call-section call-overlay bg_img d-none" data-background="<?php echo $template_path; ?>/assets/images/call/call-bg.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 col-xl-6">
                        <div class="call-item text-center text-sm-left">
                            <div class="call-icon">
                                <img src="<?php echo $template_path; ?>/assets/images/call/icon01.png" alt="call">
                            </div>
                            <div class="call-content">
                                <h5 class="title">Ready To Start Your Earnings Through Crypto Currency</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-xl-6 text-center text-sm-left text-md-right">
                        <a href="#0" class="custom-button">learn more <i class="flaticon-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!--=======Check-Section Ends Here=======-->


        <!--=======Check-Section Starts Here=======-->
        <section class="client-section padding-bottom padding-top d-none">
            <div class="background-map">
                <img src="<?php echo $template_path; ?>/assets/images/client/client-bg.png" alt="client">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10">
                        <div class="section-header left-style">
                            <span class="cate">TESTIMONIALS</span>
                            <h2 class="title"><span>40,000</span> HAPPY CLIENTS AROUND THE WORLD</h2>
                            <p class="mw-500">
                                We have many happy investors invest with us .Some impresions from our Customers!
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
                                            Perfect work to start on, support is awesome
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
                                            Very easy to use, perfect for invest
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
                                            Awesome hyipland most profitable site!
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

<?php
include_once('footer_home.php');
?>