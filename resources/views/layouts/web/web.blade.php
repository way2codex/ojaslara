<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <meta name="theme-color" content="#ff3131">
    <meta name="description" content="">
    <meta name="keywords" content="=">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')


    <!--Favicon-->
    <link rel="icon" href="{{ asset('web_asset/images/favicon.png') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('web_asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web_asset/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('web_asset/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_asset/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('web_asset/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_asset/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_asset/css/colorbox.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,500,600,700,800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700,800&amp;display=swap" rel="stylesheet">

    <script src="{{ asset('web_asset/js/jquery-3.2.1.min.js') }}"></script>
    <?php echo store_data()['header_script']; ?>
</head>

<body>

    <!-- Start Pre Loader -->
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">

                    <span data-text-preloader="&nbsp;" class="letters-loading">&nbsp;</span>

                </div>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pre Loader -->

    <div class="body-inner">
        <!-- Topbar Start -->
        <div id="top-bar" class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="unstyled top-nav">
                            <li>
                                <a style="line-height: normal;" href="#">Trending</a>
                            </li>
                            <li>
                                <?php
                                $trend = popular_article(1)[0];
                                ?>
                                <a href="<?php echo route('article', [$trend['id'], $trend['slug']]); ?>">
                                    {{ substr($trend['name'], 0, 80); }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="col-md-4 top-social text-lg-right text-md-center">
                        <ul class="unstyled">
                            <li> <a title="Facebook" href="#"> <span class="social-icon"><i class="fa fa-facebook"></i></span> </a> <a title="Twitter" href="#"> <span class="social-icon"><i class="fa fa-twitter"></i></span> </a> <a title="Google+" href="#"> <span class="social-icon"><i class="fa fa-google-plus"></i></span> </a> <a title="Linkdin" href="#"> <span class="social-icon"><i class="fa fa-linkedin"></i></span> </a> <a title="Rss" href="#"> <span class="social-icon"><i class="fa fa-rss"></i></span> </a> <a title="Skype" href="#"> <span class="social-icon"><i class="fa fa-skype"></i></span> </a> </li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Header start -->
        <header id="header" class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="logo">
                            <a href="<?php echo route('home'); ?>">
                                <!-- <img src="{{ asset('web_asset/images/logo.png') }}" alt=""> -->
                                <h4 style="
                                    font-family: cursive;
                                    font-size: xx-large;
                                    background: #ff3131;
                                    color: white;
                                    width: auto !important;
                                    text-align: center;
                                    padding-top: 15px;
                                    padding-bottom: 15px;
                                ">
                                    <?php echo store_data()['name']; ?>
                                </h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 header-right">
                        <!-- <div class="ad-banner float-right"> <a href="#"><img src="{{ asset('web_asset/images/banner-ads/ad-top-header.png') }}" class="img-fluid" alt=""></a> </div> -->
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->

        <!-- Mani Nav Start -->
        <div class="utf_main_nav_area clearfix utf_sticky">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg col">
                        <div class="utf_site_nav_inner float-left">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                            <div id="navbarSupportedContent" class="collapse navbar-collapse navbar-responsive-collapse">
                                <ul class="nav navbar-nav">
                                    <li> <a href="<?php echo route('home'); ?>">Home</a> </li>
                                    <?php foreach (all_category() as $key => $all_category_item) { ?>
                                        <li> <a href="<?php echo route('category', [$all_category_item['id'], $all_category_item['slug']]); ?>">{{ $all_category_item['name'] }}</a> </li>
                                    <?php } ?>
                                    <li> <a href="<?php echo route('page', 'about_us'); ?>">About Us</a> </li>
                                    <li> <a href="<?php echo route('page', 'disclaimers'); ?>">Disclaimers</a> </li>
                                    <li> <a href="<?php echo route('page', 'privacy_policy'); ?>">Privacy Policy</a> </li>
                                    <li> <a href="<?php echo route('page', 'terms'); ?>">Terms</a> </li>
                                    <li> <a href="<?php echo route('page', 'contact_us'); ?>">Contact Us</a> </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <!-- <div class="utf_nav_search"> <span id="search"><i class="fa fa-search"></i></span> </div>
                    <div class="utf_search_block" style="display: none;">
                        <input type="text" class="form-control" placeholder="Type what you want and enter">
                        <span class="utf_search_close">&times;</span>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Menu wrapper end -->


        @yield('content')

        <!-- Footer Start -->
        <footer id="footer" class="footer">
            <div class="utf_footer_main">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget widget-categories">
                            <h3 class="widget-title">Pages</h3>
                            <ul>

                                <li>
                                    <i class="fa fa-angle-double-right"></i>
                                    <a href="<?php echo route('page', 'about_us'); ?>">
                                        <span class="catTitle">About Us</span>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-double-right"></i>
                                    <a href="<?php echo route('page', 'disclaimers'); ?>">
                                        <span class="catTitle">Disclaimers</span>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-double-right"></i>
                                    <a href="<?php echo route('page', 'privacy_policy'); ?>">
                                        <span class="catTitle">Privacy Policy</span>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-double-right"></i>
                                    <a href="<?php echo route('page', 'terms'); ?>">
                                        <span class="catTitle">Terms</span>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-double-right"></i>
                                    <a href="<?php echo route('page', 'contact_us'); ?>">
                                        <span class="catTitle">Contact Us</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget widget-categories">
                            <h3 class="widget-title">Categories</h3>
                            <ul>
                                <?php foreach (all_category() as $key => $all_category_item) { ?>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="<?php echo route('category', [$all_category_item['id'], $all_category_item['slug']]); ?>">
                                            <span class="catTitle">{{ $all_category_item['name'] }}</span>
                                            <!-- <span class="catCounter"> (05)</span> -->
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget">
                            <h3 class="widget-title">Random Post</h3>
                            <div class="utf_list_post_block">
                                <ul class="utf_list_post">
                                    <?php foreach (popular_article(3) as $key => $item) { ?>
                                        <li class="clearfix">
                                            <div class="utf_post_block_style post-float clearfix">
                                                <a href="<?php echo route('article', [$item['id'], $item['slug']]); ?>">
                                                    <div class="utf_post_thumb">
                                                        <img class="img-fluid" src="<?php echo  asset('uploads/article') . '/' . $item['image']; ?>" alt="" />
                                                    </div>
                                                </a>
                                                <div class="utf_post_content">
                                                    <h2 class="utf_post_title title-small">
                                                        <a href="<?php echo route('article', [$item['id'], $item['slug']]); ?>">
                                                            {{ substr($item['name'], 0, 80); }}
                                                        </a>
                                                    </h2>
                                                    <!-- <div class="utf_post_meta"> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> </div> -->
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 text-center">
                        <div class="utf_copyright_info"> <span>Copyright © <?php echo date('Y'); ?> All Rights Reserved.</span> </div>
                    </div>
                </div>
                <div id="back-to-top" class="back-to-top">
                    <button class="btn btn-primary" title="Back to Top"> <i class="fa fa-angle-up"></i> </button>
                </div>
            </div>
        </div>
        <!-- Copyright End -->
    </div>

    <!-- Javascript Files -->

    <script src="{{ asset('web_asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web_asset/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web_asset/js/jquery.colorbox.js') }}"></script>
    <script src="{{ asset('web_asset/js/smoothscroll.js') }}"></script>
    <script src="{{ asset('web_asset/js/custom_script.js') }}"></script>
    <script>
        /* Loading Js*/
        $(window).on('load', function() {
            setTimeout(function() {
                $(".preloader").delay(700).fadeOut(700).addClass('loaded');
            }, 800);
        });
    </script>
    <?php echo store_data()['footer_script']; ?>
</body>

</html>