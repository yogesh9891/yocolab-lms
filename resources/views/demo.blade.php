<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('og')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- css file -->
        <link rel="stylesheet" href="{{asset('front_assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('front_assets/css/style.css')}}">

        <!-- Responsive stylesheet -->
        <link rel="stylesheet" href="{{asset('front_assets/css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('front_assets/css/custom.css')}}">
     
        
        <script type="text/javascript" src="{{asset('front_assets/js/jquery-3.3.1.js')}}"></script>
     
        <!-- Title -->

        <title>Yocolab - Online Classes For Everything</title>
        <!-- Favicon -->
        <link href="{{asset('front_assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
        <link href="{{asset('front_assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" />
        @yield('before_body')
    
    </head>
    <body>
        <div ng-app="">
        </div>
        <div class="wrapper">
            <div class="preloader"></div>

<section class="mobile-page">
    <div class="page-banner">
        <div class="container">
            <h2><img src="{{asset('front_assets/images/yocolab-logo.png')}}" alt="logo" class="banner-img"> IS LIVE!</h2>
        </div>
    </div>
    <div class="banner-about">
        <div class="container">
            <div class="banner-about-content">
                <h2>We are building the world’s largest Instructor-Student community!</h2>
                <p>Enjoy our live classes on your favourite laptop/desktop.
                </p>
            </div>
        </div>
    </div>
    <div class="banner-service">
        <div class="container">
            <h2 class="banner-service-heading">We Facilitate</h2>
            <div class="banner-box">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="banner-box-inner box-1">
                            <p>The most advance way of connecting, making the teaching and learning more of a real-life experience, with human touch.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="banner-box-inner box-2">
                            <p>Offering you a wide range of search options, covering from professionals and academic to interest, hobbies and passions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="soon-text">
        <div class="container">
            <p>Our Mobile Applications are coming soon. We will notify you, stay tuned</p>
        </div>
    </div>
</section>

    <!-- Our Footer -->
    <section class="footer_one">
        <div class="container">
            <div class="row">
               
                <div class="col-sm-12  col-md-3 col-lg-5">
                    <div class="footer_contact_widget">
                        <h4>Contact</h4>
                        <ul class="list-unstyled">
                        <li>We are happy to hear from you. For any queries, reach out to us.</li>
                        <li>Report Issues/Concerns :  <a href="mailto:report@yocolab.com">report@yocolab.com</a> </li>
                        <li>Payment Related Concerns :   <a href="mailto:payment@yocolab.com">payment@yocolab.com</a> </li>
                        <li>Any other matter :  <a href="mailto:contact@yocolab.com">contact@yocolab.com</a></li>
                    
                    </div>
                </div>
                {{-- <div class="col-sm-6 col-md-6 col-md-3 col-lg-3">
                    <div class="footer_apps_widget">
                        <h4>Mobile</h4>
                        <div class="app_grid">
                            <button class="apple_btn btn-dark">
                                <span class="icon">
                                    <span class="flaticon-apple"></span>
                                </span>
                                <span class="title">App Store</span>
                                <span class="subtitle">Available now on the</span>
                            </button>
                            <button class="play_store_btn btn-dark">
                                <span class="icon">
                                    <span class="flaticon-google-play"></span>
                                </span>
                                <span class="title">Google Play</span>
                                <span class="subtitle">Get in on</span>
                            </button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Our Footer Middle Area -->
    <section class="footer_middle_area p0">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3 col-xl-2 pb15 pt15">
                    <div class="logo-widget home1">
                        <img class="img-fluid" src="{{asset('front_assets/images/yocolab-logo.png')}}" alt="header-logo.png" width="200">
                    </div>
                </div>
               
                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-4 pb15 pt15">
                    <div class="footer_social_widget mt15">
                        <ul>
                            <li class="list-inline-item"><a href="https://www.facebook.com/yocolabsg" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="https://twitter.com/yocolabsg" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.instagram.com/yocolabsg/?hl=en" target="_blank"><i class="fa fa-instagram"></i></a></li>
                             <li class="list-inline-item"><a href="https://www.linkedin.com/company/yocolab" target="_blank"><i class="fa fa-linkedin"></i></a></li>

                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Footer Bottom Area -->
    <section class="footer_bottom_area pt25 pb25">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                 <div class="copyright-widget text-center">
                        <p>Copyright Yocolab © 2021. All Rights Reserved. Developed by <a href="https://ebslon.com/" style="color: #fd6308;" target="_blank">Ebslon Infotech.</a></p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>
        <a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
    </div>
    <!-- Wrapper End -->
    <script type="text/javascript" src="{{asset('front_assets/js/jquery-migrate-3.0.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/jquery.mmenu.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/ace-responsive-menu.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/isotop.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/snackbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/simplebar.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/parallax.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/scrollto.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/jquery-scrolltofixed-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/jquery.counterup.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/wow.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/progressbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/slider.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/timepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script type="text/javascript" src="{{asset('front_assets/js/wickedpicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/file-upload.js')}}"></script>
    <!-- Custom script for all pages -->
    <script type="text/javascript" src="{{asset('front_assets/js/script.js')}}"></script>
    </body>
</html>
