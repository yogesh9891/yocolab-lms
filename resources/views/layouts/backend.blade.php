<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="academy, college, coursera, courses, education, elearning, kindergarten, lms, lynda, online course, online education, school, training, udemy, university">
<meta name="description" content="Edumy - LMS Online Education Course & School HTML Template">
<meta name="CreativeLayers" content="ATFN">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- css file -->
<link rel="stylesheet" href="{{asset('front_assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('front_assets/css/style.css')}}">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('front_assets/css/responsive.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"  />


<!-- Title -->
<title>Yocolab</title>
<!-- Favicon -->
<link href="{{asset('front_assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="{{asset('front_assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" />
@yield('before_body')

</head>
<body>
<div class="wrapper">
    <div class="preloader"></div>


    	<!-- Main Header Nav -->
	<header class="header-nav menu_style_home_one dashbord_pages navbar-scrolltofixed stricky main-menu">
		<div class="container-fluid">
		    <!-- Ace Responsive Menu -->
		    <nav>
		        <!-- Menu Toggle btn-->
		        <div class="menu-toggle">
		            <img class="nav_logo_img img-fluid" src="{{asset('front_assets/images/yocolab-logo.png')}}" alt="header-logo.png" width="50%">
		            <button type="button" id="menu-btn">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		        </div>
		        <a href="#" class="navbar_brand float-left dn-smd">
		            <img class="logo1 img-fluid" src="{{asset('front_assets/images/yocolab-logo.png')}}" alt="header-logo.png" width="50%">
		            <img class="logo2 img-fluid" src="{{asset('front_assets/images/yocolab-logo.png')}}" alt="header-logo.png" width="50%">
		          
		        </a>
		        <!-- Responsive Menu Structure-->
		        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
		       
		        <ul class="header_user_notif pull-right dn-smd">
	                
	                <li class="user_setting">
						<div class="dropdown">
	                		<a class="btn dropdown-toggle" href="#" data-toggle="dropdown"><img class="rounded-circle" src="{{asset('front_assets/images/team/e1.png')}}" alt="e1.png"></a>
						    <div class="dropdown-menu">
						    	<div class="user_set_header">
						    		<img class="float-left" src="{{asset('front_assets/images/team/e1.png')}}" alt="e1.png">
	
							    	 <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                        @csrf
                                        		<button  class="btn btn-primary" type="submit">Log out</button>
                                    </form>
						    	</div>
						    	<div class="user_setting_content">
									

							
						    	</div>
						    </div>
						</div>
			        </li>
	            </ul>
		    </nav>
		</div>
	</header>

	<!-- Main Header Nav For Mobile -->
	<div id="page" class="stylehome1 h0">
		<div class="mobile-menu">
	        <ul class="header_user_notif dashbord_pages_mobile_version pull-right">
                <li class="user_notif">
					<div class="dropdown">
					    <a class="notification_icon" href="#" data-toggle="dropdown"><span class="flaticon-email"></span></a>
					    <div class="dropdown-menu notification_dropdown_content">
							<div class="so_heading">
								<p>Notifications</p>
							</div>
							<div class="so_content" data-simplebar="init">
								<ul>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
								</ul>
							</div>
							<a class="view_all_noti text-thm" href="#">View all alerts</a>
					    </div>
					</div>
                </li>
                <li class="user_notif">
					<div class="dropdown">
					    <a class="notification_icon" href="#" data-toggle="dropdown"><span class="flaticon-alarm"></span></a>
					    <div class="dropdown-menu notification_dropdown_content">
							<div class="so_heading">
								<p>Notifications</p>
							</div>
							<div class="so_content" data-simplebar="init">
								<ul>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
									<li>
										<h5>Status Update</h5>
										<p>This is an automated server response message. All systems are online.</p>
									</li>
								</ul>
							</div>
							<a class="view_all_noti text-thm" href="#">View all alerts</a>
					    </div>
					</div>
                </li>
                <li class="user_setting">
					<div class="dropdown">
                		<a class="btn dropdown-toggle" href="#" data-toggle="dropdown"><img class="rounded-circle" src="images/team/e1.png" alt="e1.png"></a>
					    <div class="dropdown-menu">
					    	<div class="user_set_header">
					    		<img class="float-left" src="images/team/e1.png" alt="e1.png">
						    	<p>Kim Hunter <br><span class="address"><a href="https://grandetest.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="09626064617c677d6c7b496e64686065276a6664">[email&#160;protected]</a></span></p>
					    	</div>
					    	<div class="user_setting_content">
								<a class="dropdown-item active" href="#">My Profile</a>
								<a class="dropdown-item" href="#">Messages</a>
								<a class="dropdown-item" href="#">Purchase history</a>
								<a class="dropdown-item" href="#">Help</a>
								<a class="dropdown-item" href="#">Log out</a>
					    	</div>
					    </div>
					</div>
		        </li>
            </ul>
			<div class="header stylehome1 dashbord_mobile_logo dashbord_pages">
				<div class="main_logo_home2">
		            <img class="nav_logo_img img-fluid float-left mt20" src="images/header-logo.png" alt="header-logo.png">
		            <span>edumy</span>
				</div>
				<ul class="menu_bar_home2">
					<li class="list-inline-item"></li>
					<li class="list-inline-item"><a href="#menu"><span></span></a></li>
				</ul>
			</div>
		</div><!-- /.mobile-menu -->
		
	</div>
         @include('layouts.sidebar')

            @yield('content')

     



</div>


<a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>
<!-- Wrapper End -->
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="{{asset('front_assets/js/jquery-3.3.1.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" ></script>
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
<!-- Custom script for all pages --> 
<script type="text/javascript" src="{{asset('front_assets/js/script.js')}}"></script>


<script type="text/javascript">
	$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
 @yield('afterScript')
</body>

</html>
