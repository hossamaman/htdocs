<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php

             $data = "";
             $data .= Template::title(htmlentities(s("seo/title")));
             $data .= Template::description(htmlentities(s("seo/description")));
             $data .= Template::keywords(htmlentities(s("seo/keywords")));
             $data .= Template::author(htmlentities(s("generale/name")));
             $data .= Template::favicon(htmlentities(s("seo/favicon")));
             $data .= Template::og_title(htmlentities(s("seo/title")));
             $data .= Template::og_image(htmlentities(s("seo/ogimage")));
             $data .= Template::og_site_name(htmlentities(s("generale/name")));
             $data .= Template::og_description(htmlentities(s("seo/description")));
             $data .= Template::jsconfig();
			 $header_code = s("analyse/code");
			 if(!empty($header_code))
			 {
				 $data .= $header_code;
			 }
             echo $data;
             ?>
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo homepage_path; ?>/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo homepage_path; ?>/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo homepage_path; ?>/css/themify-icons.css"/>
	<link rel="stylesheet" href="<?php echo homepage_path; ?>/css/animate.css"/>
	<link rel="stylesheet" href="<?php echo homepage_path; ?>/css/owl.carousel.css"/>
	<link rel="stylesheet" href="<?php echo homepage_path; ?>/css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section clearfix">
		<div class="container-fluid">
			<a href="<?php _router("home"); ?>" class="site-logo">
				<img src="<?php echo homepage_path; ?>/img/logo.png" alt="">
			</a>
			<div class="responsive-bar"><i class="fa fa-bars"></i></div>
			<a href="<?php _router("signup"); ?>" class="user"><i class="fa fa-user"></i></a>
			<a href="<?php _router("signup"); ?>" class="site-btn">Sign Up Free</a>
			<nav class="main-menu">
				<ul class="menu-list">
					<li><a href="<?php _router("page", array("name" => "about-us")); ?>">About</a></li>
					<li><a href="<?php _router("contact"); ?>">Contact</a></li>
                    <li><a href="<?php _router("login"); ?>">Login</a></li>
                </ul>
			</nav>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 hero-text">
					<h2><span>SURFOW</span> <br>traffic exchange</h2>
					<h4>the simplest way to exchange traffic or buy it at very low cost, increasing your website traffic and boosting alexa rankings.</h4>
					<br><a href="<?php _router("signup"); ?>" class="site-btn sb-gradients">Get Started</a>
				</div>
				<div class="col-md-6">
					<img src="<?php echo homepage_path; ?>/img/laptop.png" class="laptop-image" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- About section -->
	<section class="about-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-6 about-text">
					<h2>Why do i need more traffic!</h2>
					<h5>The number of visitors directly affect your website ranking</h5>
					<p>The main goal with any website is to be ranked number one for obvious reasons. search and analytics engines these are powerful tools and are the most efficient and most important way that consumers find information online.</p>
					<a href="<?php _router("signup"); ?>" class="site-btn sb-gradients sbg-line mt-5">Get Started</a>
				</div>
			</div>
			<div class="about-img">
				<img src="<?php echo homepage_path; ?>/img/webmaster.png" alt="">
			</div>
		</div>
	</section>
	<!-- About section end -->


	<!-- Features section -->
	<section class="features-section spad gradient-bg">
		<div class="container text-white">
			<div class="section-title text-center">
				<h2>Our Features</h2>
				<p>the simplest way to exchange traffic or buy it at very low cost.</p>
			</div>
			<div class="row">
				<!-- feature -->
				<div class="col-md-6 col-lg-4 feature">
					<i class="ti-mobile"></i>
					<div class="feature-content">
						<h4>Automatic</h4>
						<p>All operations are fully automatic, payments, purchases, sessions, designed by experts to save your time.</p>

					</div>
				</div>
				<!-- feature -->
				<div class="col-md-6 col-lg-4 feature">
					<i class="ti-shield"></i>
					<div class="feature-content">
						<h4>Safe & Secure</h4>
						<p>Is a smart & secure system keeps you and your websites safe, Visitors can enter your site directly. </p>

					</div>
				</div>
				<!-- feature -->
				<div class="col-md-6 col-lg-4 feature">
					<i class="ti-wallet"></i>
					<div class="feature-content">
						<h4>Wallet</h4>
						<p>You can easily control your spends funds, your money will remain safe in your wallet until you need it. </p>

					</div>
				</div>
				<!-- feature -->
				<div class="col-md-6 col-lg-4 feature">
					<i class="ti-headphone-alt"></i>
					<div class="feature-content">
						<h4>Experts Support</h4>
						<p>We're always stand by to solve any issue that you may appear, 24h Support.</p>

					</div>
				</div>
				<!-- feature -->
				<div class="col-md-6 col-lg-4 feature">
					<i class="ti-reload"></i>
					<div class="feature-content">
						<h4>Instant Exchange</h4>
						<p>When you buy or start a session, you'll start getting visitors instantly from others. </p>

					</div>
				</div>
				<!-- feature -->
				<div class="col-md-6 col-lg-4 feature">
					<i class="ti-panel"></i>
					<div class="feature-content">
						<h4>Simple & Easy</h4>
						<p>Friendly interface wich make it easy to use, we guarantee you the best experience with our service.</p>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->


	<!-- Process section -->
	<section class="process-section spad">
		<div class="container">
			<div class="section-title text-center">
				<h2>How the system works!</h2>
				<p>it's actually easier than you think...</p>
			</div>
			<div class="row">
				<div class="col-md-4 process">
					<div class="process-step">
						<figure class="process-icon">
							<img src="<?php echo homepage_path; ?>/img/process-icons/1.png" alt="#">
						</figure>
						<h4>Setup your account</h4>
						<p>Create an account and add your websites which want to deliver visitors to. </p>
					</div>
				</div>
				<div class="col-md-4 process">
					<div class="process-step">
						<figure class="process-icon">
							<img src="<?php echo homepage_path; ?>/img/process-icons/2.png" alt="#">
						</figure>
						<h4>Earn or buy points</h4>
						<p>Download the exchanger app and start earning points, or just buy traffic package. </p>
					</div>
				</div>
				<div class="col-md-4 process">
					<div class="process-step">
						<figure class="process-icon">
							<img src="<?php echo homepage_path; ?>/img/process-icons/3.png" alt="#">
						</figure>
						<h4>Delivering visitors instantly</h4>
						<p>That's it, now just wait for visitors to come at your websites.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Process section end -->


	<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<div class="row spad">
				<div class="col-md-6 col-lg-3 footer-widget">
					<img src="<?php echo homepage_path; ?>/img/logo.png" class="mb-4" alt="">
					<p>the simplest way to exchange traffic or buy it at very low cost.</p>
					<span>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></span>
				</div>
				<div class="col-md-6 col-lg-2 offset-lg-1 footer-widget">
					<h5 class="widget-title">Resources</h5>
					<ul>
						<li><a href="#">How to Buy</a></li>
						<li><a href="#">Overview</a></li>
						<li><a href="#">Blog News</a></li>
						<li><a href="#">How to use</a></li>
						<li><a href="#">Order package</a></li>
					</ul>
				</div>
				<div class="col-md-6 col-lg-2 offset-lg-1 footer-widget">
					<h5 class="widget-title">Quick Links</h5>
					<ul>
						<li><a href="#">Network Stats</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Developers</a></li>
						<li><a href="#">Signup</a></li>
						<li><a href="#">Login</a></li>
					</ul>
				</div>
				<div class="col-md-6 col-lg-3 footer-widget pl-lg-5 pl-3">
					<h5 class="widget-title">Follow Us</h5>
					<div class="social">
						<a href="" class="facebook"><i class="fa fa-facebook"></i></a>
						<a href="" class="google"><i class="fa fa-google-plus"></i></a>
						<a href="" class="instagram"><i class="fa fa-instagram"></i></a>
						<a href="" class="twitter"><i class="fa fa-twitter"></i></a>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="row">
					<div class="col-lg-4 store-links text-center text-lg-left pb-3 pb-lg-0">
						<a href=""><img src="<?php echo homepage_path; ?>/img/appstore.png" alt="" class="mr-2"></a>
						<a href=""><img src="<?php echo homepage_path; ?>/img/playstore.png" alt=""></a>
					</div>
					<div class="col-lg-8 text-center text-lg-right">
						<ul class="footer-nav">
							<li><a href="<?php _router("page", array("name" => "about-us")); ?>">About</a></li>
							<li><a href="<?php _router("page", array("name" => "tos")); ?>">Terms of Use</a></li>
							<li><a href="<?php _router("page", array("name" => "privacy")); ?>">Privacy Policy </a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>


	<!--====== Javascripts & Jquery ======-->
	<script src="<?php echo homepage_path; ?>/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo homepage_path; ?>/js/owl.carousel.min.js"></script>
	<script src="<?php echo homepage_path; ?>/js/main.js"></script>
</body>
</html>
