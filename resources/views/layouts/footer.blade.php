	<!-- Our Footer -->
	<section class="footer_one">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-6  col-md-3 col-lg-2">
					<div class="footer_company_widget">
						<h4>Get To Know Us</h4>
						<ul class="list-unstyled">
							<li><a href="{{url('/about-us')}}">About Us</a></li>
							{{-- <li><a href="{{url('/blogs')}}">Blog</a></li> --}}
							{{-- <li><a href="#">Become An Instructor</a></li> --}}
						</ul>
					</div>
				</div>
				<div class="col-sm-6  col-md-3 col-lg-2">
					<div class="footer_program_widget">
						<h4>Learn With Us</h4>
						<ul class="list-unstyled">
							<li><a href="{{url('/student/how-it-works')}}">How it works</a></li>
							<li><a href="{{url('/student/faqs')}}">Student FAQ</a></li>
						{{-- 	<li><a href="#">Georgia</a></li>
							<li><a href="#">Self-Driving Car</a></li> --}}
						</ul>
					</div>
				</div>
				<div class="col-sm-6  col-md-3 col-lg-3">
					<div class="footer_support_widget">
						<h4>Teach With Us</h4>
						<ul class="list-unstyled">
							<li><a href="{{url('/teacher/how-it-works')}}">How it works</a></li>
							<li><a href="{{url('/steps-to-create-class')}}">5 steps to create a class</a></li>
							<li><a href="{{url('/teacher/faqs')}}">Instructor FAQ</a></li>
							{{-- <li><a href="{{url('/become-instructor')}}">Become an Instructor</a></li> --}}
							<li><a href="{{url('/become-an-instructor')}}">Become An Instructor</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6  col-md-3 col-lg-5">
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
						<img class="img-fluid" src="{{asset('front_assets/images/yocolab-logo.png')}}" alt="header-logo.png">
					</div>
				</div>
				<div class="col-sm-8 col-md-5 col-lg-6 col-xl-6 pb25 pt25 brdr_left_right">
					<div class="footer_menu_widget">
						<ul>
							<li class="list-inline-item"><a href="{{url('/')}}">Home</a></li>
							<li class="list-inline-item"><a href="{{url('privacy')}}">Privacy</a></li>
							<li class="list-inline-item"><a href="{{url('terms-and-conditions')}}">Terms</a></li>
							<li class="list-inline-item"><a href="{{url('/blogs')}}">Blogs</a></li>
							
						</ul>
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

		<div class="sign_up_modal modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      	</div>
		      
					<ul class="sign_up_tab nav nav-tabs" id="myTab" role="tablist">
				  	<li class="nav-item">
				    	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
				  	</li>
				</ul>
				
				<div class="tab-content" id="myTabContent">
				  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="login_form">
							<form action="{{url('login')}}" method="post">
								@csrf
								@method('post')
								<div class="heading">
									<h3 class="text-center">Login to your account</h3>
									<!-- <p class="text-center">Don't have an account? <a class="text-thm" href="#">Sign Up!</a></p> -->
									<font color="red"  class="text-center" id="loginError"></font>
								</div>
								 <div class="form-group">
							    	<input type="email" class="form-control" id="loginEmail" placeholder="Email Address" required="" aria-label="loginEmail">
								</div>
								<div class="form-group">
							    	<input type="password" class="form-control" id="loginPassword" placeholder="Password" required="" aria-label="loginPassword">
								</div>
								<div class="form-group custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="exampleCheck1">
									<label class="custom-control-label" for="exampleCheck1">Remember me</label>
									<a class="tdu btn-fpswd float-right" href="{{url('password/reset')}}">Forgot Password?</a>
								</div>
								<button type="submit" class="btn btn-log btn-block btn-thm2" id="loginBtn">Login</button>
								<hr>
								<div class="row mt20">
								 <div class="col-lg">
										<a href="{{ url('auth/facebook') }}"  class="btn btn-block color-white bgc-fb"><i class="fa fa-facebook float-left mt10"></i> Facebook</a>
									</div> 
									<div class="col-lg">
										<a href="{{ url('auth/google') }}" class="btn btn-block color-white bgc-gogle"><i class="fa fa-google float-left mt10"></i> Google</a>
									</div>
								</div>
							</form>
						</div>
				  	</div>
				  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="sign_up_form" style="max-width: 700px;">
							<div class="heading">
								<h3 class="text-center">Create New Account</h3>
								<!-- <p class="text-center">Have an account? <a class="text-thm" href="#">Login</a></p> -->
								<font color="red"  class="text-center" id="registerError"></font>
							</div>
							<form action="{{url('register')}}" method="post" id="registerForm">
								<div class="form-row">
									<div class="form-group mb-0 col-lg-6 col-md-6 col-sm-12">
								    	<input type="text" class="form-control" id="registerName" placeholder=" First Name" required="" name="fname" aria-label="registerName" >
									</div>
									<div class="form-group mb-0 col-lg-6 col-md-6 col-sm-12">
								    	<input type="text" class="form-control"  placeholder=" Last Name" required="" name="lname" id="LastName" aria-label="LastName">
									</div>
									 <div class="form-group mb-0 col-lg-6 col-md-6 col-sm-12">
								    	<input type="email" class="form-control" id="registerEmail" placeholder="Email Address" required="" name="email" aria-label="registerEmail">
									</div>
									 <div class="form-group mb-0 col-lg-6 col-md-6 col-sm-12">
								    	<input type="text" class="form-control" id="registerPhone" placeholder="Phone Number" name="phone" aria-label="registerPhone" >
									</div>
									<div class="form-group mb-0 col-lg-6 col-md-6 col-sm-12">
								    	<input type="password" class="form-control" id="registerPassword" placeholder="Password" required="" name="password" aria-label="registerPassword">
									</div>
									<div class="form-group mb-0 col-lg-6 col-md-6 col-sm-12">
								    	<input type="password" class="form-control" id="registerPassword2" placeholder="Confirm Password" required=" "name="cpassword" aria-label="registerPassword2">
									</div>
								</div>
								<div class="form-group">
								 
	                          	{{--  <button class="g-recaptcha" 
								        data-sitekey="6Leh3IIaAAAAAFDD4oZNHycdgXgxMyZaOjONo2Do" 
								        data-callback='onClick' 
								        data-action='submit'>Submit</button> --}}
								{{-- 
								        <div class="g-recaptcha" 
								           data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}">
								</div>
								 --}}
                                {!! app('captcha')->display() !!}
                              
                            </div>
								<div class="form-group custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="toi">
			                		<label class="custom-control-label" for="toi"></label>
									Agree to <span data-toggle="modal" data-target="#tnc_modal" class="tnc-txt-link">terms and conditions</span>
								</div>
								<button type="submit" class="btn btn-log btn-block btn-thm2" id="registerBtn">Register</button>
								<hr>
								<div class="row mt20">
									 <div class="col-lg">
										<a href="{{ url('auth/facebook') }}" class="btn btn-block color-white bgc-fb"><i class="fa fa-facebook float-left mt10"></i> Facebook</a>
									</div> 
									<div class="col-lg">
										<a href="{{ url('auth/google') }}" class="btn btn-block color-white bgc-gogle"><i class="fa fa-google float-left mt10"></i> Google</a>
									</div>
								</div>
							</form>
						</div>
				  	</div>
				</div>
	    	</div>
	  	</div>
	</div>
    
    	{{-- Terms and conditions Modal Start --}}
	<div class="modal fade" id="tnc_modal" tabindex="-1" aria-labelledby="tnc_modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tnc_modalLabel">Terms & Conditions</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-12">
<div style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serifborder:none;border-bottom:solid #4F81BD 1.0pt;padding:0cm 0cm 4.0pt 0cm;'>
    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.0pt;margin-left:0cm;border:none;padding:0cm;font-size:35px;font-family:"Montserrat", sans-serif;color:#17365D;line-height:115%;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">Terms and Conditions</span></p>
</div>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>Welcome to Yocolab. We thank you for visiting our website.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>When you use our services, you&apos;re agreeing to our terms. So please take a few minutes to read over the below mentioned Terms and Conditions before using our website (</span><a href="{{url('/')}}"><span style="font-size:18px;line-height:115%;">www.yocolab.com</span></a><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>).</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><strong><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif'>IF YOU DO NOT AGREE WITH ANY TERM OR PROVISION OF THESE TERMS AND CONDITIONS, PLEASE EXIT THIS SITE IMMEDIATELY. PLEASE BE ADVISED THAT YOUR CONTINUED USE OF THIS SITE OR THE PRODUCTS OR INFORMATION PROVIDED THEREBY SHALL INDICATE YOUR CONSENT AND AGREEMENT TO THESE TERMS AND CONDITIONS.</span></strong></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>These Terms and Conditions of Service and Use of our (the &ldquo;Terms and Conditions&ldquo;) are hereby made effective or &ldquo;we&rdquo; or &ldquo;us&rdquo; or &ldquo;our&ldquo;), and, without waiving or otherwise releasing any right or obligation under any prior terms and conditions of the use of Yocolab, hereby amend and restate any such prior terms and conditions.</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>In consideration of each member or user&rsquo;s (each, a &ldquo;customer&rdquo; or &ldquo;you&ldquo;) access to and use of the Site, we require every members and user to act with integrity, to our rules for&nbsp;</span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>the Site</span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>, and to abide by these Terms and Conditions and each other rule, regulation or other policy of Yocolab.</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION 1 - ACCEPTENCE OF TERMS</span></h1>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>By clicking &ldquo;I AGREE&rdquo; and/or using or accessing our services and this website, you hereby agree,&nbsp;</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>(a) that you have received, read and understood these Terms and Conditions, and that these Terms and Conditions create a valid and binding agreement, enforceable against you in accordance with the terms hereof,</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>&nbsp;</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>(b) to be bound by these Terms and Conditions, any terms, conditions or other rules, regulations or policies of Yocolab, as each may be amended or supplemented from time to time in our sole discretion without notice, and&nbsp;</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>&nbsp;</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>(c) that your use of our digital services and our website shall comply with all applicable federal, state and local laws, rules or regulations, and that you are solely responsible for your compliance with, familiarity with and understanding of any such laws, rules or regulations applicable to your use of the Site.&nbsp;If you do not agree with any portion of these Terms and Conditions, you are prohibited from using or accessing our services.</span></p>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 2- &nbsp;PROPRIETARY RIGHTS</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'><br>&nbsp;As between you and us, we own, solely and exclusively, all rights, title and interest in and to the Site, all the content (including, for example, audio, photographs, illustrations, graphics, other visuals, video and copy), software, code, data, and the look and feel, design and organization of the Site, and all materials and content related to our programs even if the materials or content are not accessed through the Site. Your use of the Site does not grant to you ownership of any content, software, code, data or materials you may access on the Site.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION</span> 3 - GUIDLINES FOR INSTRUCTORS</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>An Instructor warrants that;<br>&nbsp;(a)he/she has the necessary qualifications and/or experience to conduct classes in the subjects specified by the Instructor on the Yocolab website;<br>&nbsp;(c) his/her profile and subject information provided on the Yocolab website is up to date, accurate and truthful; and<br>&nbsp;(d)he/she has the legal right to work on a self-employed basis.</span></p>
<ol style="list-style-type: decimal;margin-left:8px;">
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>An Instructor is responsible for the prices quoted for his services on the Yocolab website.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>Instructor takes full responsibility for all information that he/she provides on the Yocolab website and must indemnify Yocolab in relation to any liability incurred by Yocolab as a result of such information.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>An Instructor shall indemnify Yocolab for all claims and liabilities arising out of any use by the Instructor of the Yocolab website, including any associated costs and expenses incurred, whether direct or indirect.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>An Instructor must contact a Student through the Yocolab website. Any other means of communication is prohibited.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>An Instructor must not be in any way be abusive about a Student on the Yocolab website or any other place.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>An Instructor must ensure that he completes full duration of the scheduled class. In case of any complaints/concerns by students related to early termination of the class, Yocolab reserves the right to withhold Instructor payouts and charge cancellation penalty to the instructor.&nbsp;</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>An Instructor is not an employee of Yocolab and accepts full responsibility for all Income Tax, National Insurance and other liabilities arising from use of the Yocolab.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>All information provided by an Instructor on the Yocolab website must be accurate and kept up-to-date. This includes a correct name, address, telephone number and qualification/experience details. Details entered by the Instructor on the Yocolab will be publicly visible and may also appear in search engine results.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>Use of the Yocolab website is entirely at Instructor&apos;s own risk. An Instructor must exercise complete caution when using the Yocolab website and entering into any agreements to provide online classes to students.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>An Instructor will be paid for his classes via Yocolab website. Any other means of payments is prohibited.</span></li>
</ol>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION</span> 4 - GUIDELINES FOR STUDENTS</h1>
<ol style="list-style-type: decimal;margin-left:8px;">
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>A Student who is under 18 years of age must have consent from a parent or a guardian to register on Yocolab website. It is the responsibility of that parent/guardian to check the credentials of the Instructor. Yocolab is not responsible for any disputes regarding parental consent or any problems that a Student or a parent/guardian has experienced with an Instructor.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>A Student must contact an Instructor through the Yocolab Website. Any other means of communication is prohibited.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>A Student agrees not to use Yocolab to advertise, promote or search for tuition services for their own company, nor may an agency acting for a company register to promote their services or opportunities.&nbsp;</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>A Student cannot act as an agent to promote the services or opportunities of a company.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>A Student must not publish any abusive comments about an Instructor or another Student on the Yocolab website or any other place. This includes defamatory or derogatory comments.</span></li>
    <li><span style='line-height:115%;font-family:"Montserrat", sans-serif;font-family:"Montserrat", sans-serif;font-size:13.5pt;'>A Student must use his/her own judgment about the services of Instructors detailed on the Website. Students are responsible for checking the credentials, expertise, references and qualifications of any Instructor with whom they confirm their purchase.</span></li>
</ol>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:18.0pt;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION</span> 5 - GUIDELINE FOR USERS AND MEMBERS</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>Members must not use the Yocolab website for illegal, unlawful or prohibited purposes. This includes sending or posting junk e-mail or spam, publishing misleading, defamatory, indecent, obscene or advertising material, or send viruses and worms.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>Members must not impersonate any other person or entity or to use a false name or a name that they have no authority to use.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>Members must not post material to the Yocolab website in which the copyright or intellectual property is or may be the property of another person or body.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 6 - LIMITED LICENSE</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'><br>&nbsp;You may access and view the content on the Site on your computer or other internet compatible device, and make single copies or prints of the content on the Site for your personal, non-commercial use only. To the extent you need to download software or documentation to use the products or services on the Site, we grant you a limited, non-assignable, non-transferable, revocable license to use such materials solely to utilize such products or services. Such license will terminate when you no longer use the products or services.&nbsp;</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION</span> 7 - REGISTRATION INFORMATION&nbsp;</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>You may be required to provide information about yourself in order to register for and/or use certain Services. You agree that any such information shall be accurate. You may also be asked to choose a user name and password. You are entirely responsible for maintaining the security of your user name and password and agree not to disclose such to any third party.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION</span> 8 - PROHIBITED USE</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>You agree that You will not use, and will not permit any end user to use, the Services to: (i) modify, disassemble, decompile, prepare derivative works of, reverse engineer or otherwise attempt to gain access to the source code of the Services; (ii) knowingly or negligently use the Services in a way that abuses, interferes with, or disrupts Yocolab&rsquo;s networks, Your accounts, or the Services; (iii) engage in activity that is illegal, fraudulent, false, or misleading, (iv) transmit through the Services any material that may infringe the intellectual property or other rights of third parties; (v) build or benchmark a competitive product or service, or copy any features, functions or graphics of the Services; or (vi) use the Services to communicate any message or material that is harassing, libelous, threatening, obscene, indecent, would violate the intellectual property rights of any party or is otherwise unlawful, that would give rise to civil liability, or that constitutes or encourages conduct that could constitute a criminal offense, under any applicable law or regulation;&nbsp;(vii) upload or transmit any software, Content or code that does or is intended to harm, disable, destroy or adversely affect performance of the Services in any way or which does or is intended to harm or extract information or data from other hardware, software or networks of Yocolab or other users of Services; (viii) engage in any activity or use the Services in any manner that could damage, disable, overburden, impair or otherwise interfere with or disrupt the Services, or any servers or networks connected to the Services or Yocolab&apos;s security systems. (ix) use the Services in violation of any Yocolab policy or in a manner that violates applicable law, including but not limited to anti-spam, export control, privacy, and anti-terrorism laws and regulations and laws requiring the consent of subjects of audio and video recordings, and You agree that You are solely responsible for compliance with all such laws and regulations.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION</span> 9 - LIMITATIONS ON USE</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>You may not reproduce, resell, or distribute the Services or any reports or data generated by the Services for any purpose unless you have been specifically permitted to do so under a separate agreement with Yocolab. You may not offer or enable any third parties to use the Services purchased by You, display on any website or otherwise publish the Services or any Content obtained from a Service (other than Content created by You) or otherwise generate income from the Services or use the Services for the development, production or marketing of a service or product substantially similar to the Services.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION</span> 10 &ndash; RECORDING CONSENT</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>You agree that we may record all or any part of any live online classes and sessions (including voice chat communications and videos) for quality control and other purposes. You agree that we own all transcripts and recordings of such sessions, and you hereby irrevocably assign to us all rights in all such transcripts and recordings. If you do not want your videos to be recorded by Yocolab, it will be your responsibility to keep your videos/audio turned off during the session. Yocolab may use such videos to be advertised again on the platform and may give access to other students on the Site. In addition, these videos will be available by default for all students who were part of this particular class and can be accessible at any time on Yocolab.&nbsp;</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION</span> 11 &ndash; USER CONTENT</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>You represent and warrant that:</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>(1)you own all rights in and to your User Content and Name and/or Likeness and/or have obtained appropriate rights and permissions from any and all other persons and/or entities who own, manage or otherwise claim any rights with respect to such User Content and Name and/or Likeness, such that you have all necessary licenses, rights, consents and permissions to publish the User Content and Name and/or Likeness and to grant the rights granted herein, including permission from all person(s) appearing and/or performing in your User Content;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>(2) the Licensed Parties&rsquo; use of your User Content and Name and/or Likeness as described herein will not violate the rights of any third party, or any law, rule or regulation, including but not limited to consumer protection, copyright, trademark, patent, trade secret, privacy, publicity, moral, proprietary or other rights and laws;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>(3)the User Content and Name is not confidential, libelous, defamatory, obscene, pornographic, abusive, indecent, threatening, harassing, hateful, or offensive or otherwise unlawful; and</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>You hereby fully release, discharge and agree to hold the Licensed Parties, and any person or entity acting on their behalf, harmless from any liability related in any way to the Licensed Parties&rsquo; use of your User Content and your Name and/or Likeness.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>Certain features of our website (including but not limited to creating video, audio clip or tutorial) may allow you to publish or send content that can be viewed by others (&ldquo;User Content&rdquo;). You agree that Yocolab is not liable for User Content that is provided by others. Yocolab has no duty to pre-screen User Generated Content. You agree and acknowledge that Yocolab has no control over and assumes no responsibility for the User Content and by using the Yocolab Platform, you expressly relieve Yocolab from any and all liability arising from the User Content.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 12 -&nbsp;</span></span> <span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>EXTERNAL LINKS&nbsp;</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'><br>&nbsp;You may be able to link from the Site to third party websites and third party websites may link to the Site (&quot;Linked Sites&quot;). You acknowledge and agree that we have no responsibility for the content, products, services, advertising or other materials which may be provided by or through Linked Sites, even if they are owned or run by our affiliates. Links to Linked Sites do not constitute an endorsement or sponsorship by us of such websites or the information, content, products, services, advertising, code or other materials presented on or through such websites. Any reliance on the contents of a third party website is done at your own risk and you assume all responsibilities and consequences resulting from such reliance.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 13 - INDEMNIFICATION<br>&nbsp;</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>You agree to defend, indemnify and hold Yocolab and it&rsquo;s directors, officers, employees and agents harmless from any and all claims, liabilities, costs and expenses, including reasonable attorneys&apos; fees, arising in any way from any content or other material you place on the Site or submit to us, or your breach or violation of the law or of these Terms and Conditions. Yocolab reserves the right, at our own expense, to assume the exclusive defense and control of any matter otherwise subject to indemnification by you, and in such case, you agree to cooperate with our defense of such claim.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 14 - USING OUR SERVICES</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'><br>&nbsp;(a) Our Student Enrollment Agreement Terms and Conditions set forth additional terms applicable to certain services you may purchase on the Site.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>(b) To ensure smooth virtual sessions, you may require multiple compatible devices, high speed internet access. You are solely responsible for all computer hardware and other equipment and all fees for services (such as internet service and wireless services) required for access and use of our online classes. You may regularly need to update our applications to use our services. You acknowledge and agree that such system requirements, which may be changed from time to time, are your responsibility and are to be procured at your own cost.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'>SECTION 15 - REFUNDS &amp; CANCELLATIONS</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>Yocolab has defined policies for refunds and cancellations for our instructors and students. Cancellations without prior notice will trigger penalties. It also depends on a cancellation done 24 hours prior to the scheduled start class or within 24 hours of scheduled start class. For more details, please refer to our <u><span style="color:#0070C0;"><a href="{{url('/cancellation-policy')}}" style="color: #fd6003">Refunds &amp; Cancellation Policy</a></span>.</u>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 16 - DISCLAIMER OF WARRANTIES</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'><br>&nbsp;(a) THE SITE, INCLUDING BUT NOT LIMITED TO ALL SERVICES, PRODUCTS, CONTENT, FUNCTIONS AND MATERIALS CONTAINED OR AVAILABLE ON THE SITE, IS PROVIDED &quot;AS IS,&quot; &quot;AS AVAILABLE&quot;, WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO ANY WARRANTY REGARDING UPTIME OR UNINTERRUPTED ACCESS, AVAILABILITY, ACCURACY, OR USEFULNESS, AND ANY WARRANTIES OF TITLE, NON-INFRINGEMENT, MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE. WE HEREBY DISCLAIM ANY AND ALL SUCH WARRANTIES, EXPRESS AND IMPLIED. WE ALSO ASSUME NO RESPONSIBILITY, AND WILL NOT BE LIABLE FOR, ANY DAMAGES TO, OR VIRUSES THAT MAY INFECT, YOUR COMPUTER EQUIPMENT, MOBILE DEVICE, OR OTHER PROPERTY ON ACCOUNT OF YOUR ACCESS TO OR USE OF THE SITE OR YOUR DOWNLOADING OF ANY MATERIALS FROM THE SITE. IF YOU ARE DISSATISFIED WITH THE SITE, YOUR SOLE REMEDY IS TO DISCONTINUE USING THE SITE.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>(b) WE DO NOT: (I) GUARANTEE THE ACCURACY, COMPLETENESS, OR USEFULNESS OF ANY THIRD PARTY CONTENT ON THE SITE OR ANY VERIFICATION SERVICES DONE ON OUR INSTRUCTORS OR INSTRUCTORS, OR (II) ADOPT, ENDORSE OR ACCEPT RESPONSIBILITY FOR THE ACCURACY OR RELIABILITY OF ANY OPINION, ADVICE, OR STATEMENT MADE BY ANY INSTRUCTOR OR INSTRUCTOR OR ANY PARTY THAT APPEARS ON THE SITE. UNDER NO CIRCUMSTANCES WILL WE BE RESPONSIBLE OR LIABLE FOR ANY LOSS OR DAMAGE RESULTING FROM YOUR RELIANCE ON INFORMATION OR OTHER CONTENT POSTED ON OR AVAILABLE FROM THE SITE.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 17 - LIMITATION OF LIABILITY<br>&nbsp;</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>IN NO EVENT, INCLUDING BUT NOT LIMITED TO NEGLIGENCE, WILL WE OR ANY OF OUR DIRECTORS, OFFICERS, EMPLOYEES, AGENTS OR CONTENT OR SERVICE PROVIDERS (INCLUDING INSTRUCTORS AND INSTRUCTORS) (COLLECTIVELY, THE &quot;PROTECTED ENTITIES&quot;) BE LIABLE FOR ANY INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL, EXEMPLARY OR PUNITIVE DAMAGES ARISING FROM, OR DIRECTLY OR INDIRECTLY RELATED TO, THE USE OF, OR THE INABILITY TO USE, THE SITE OR THE CONTENT, MATERIALS, PRODUCTS, SERVICES, AND FUNCTIONS RELATED TO THE SITE, YOUR PROVISION OF INFORMATION VIA THE SITE, LOST BUSINESS OR LOST SALES, EVEN IF SUCH PROTECTED ENTITY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. SOME JURISDICTIONS DO NOT ALLOW THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES SO SOME OF THE ABOVE LIMITATIONS MAY NOT APPLY TO CERTAIN USERS TO THE EXTENT REQUIRED BY APPLICABLE LAW.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 18 - TERMINATION</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'><br>&nbsp;We may terminate, change, suspend or discontinue any aspect of the Site or the Site&apos;s products or services at any time. We may restrict, suspend or terminate your access to the Site and/or its products or services if we believe you are in breach of these Terms and Conditions or applicable law, you are a repeat infringer of intellectual property rights, or for any other reason without notice or liability.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 19 - MODIFICATIONS</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'><br>&nbsp;We reserve the right, at our sole discretion, to modify any portion of these Terms and Conditions at any time. Changes in these Terms and Conditions will be effective when posted. Your continued use of the Site and/or the products or services offered on or through the Site after any changes to these Terms and Conditions are posted will be considered acceptance of those changes.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-family:"Montserrat", sans-serif;color:black;font-weight:bold;'><span style='font-size:24px;line-height:115%;font-family:"Montserrat", sans-serif'>SECTION 20 - COMMUNICATION</span></span><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'><br>&nbsp;If you provide us your email address, you agree and consent to receive email messages from us. These emails may be transactional or relationship communications relating to the products or services we offer, such as administrative notices and service announcements or changes, or emails containing commercial offers, promotions or special offers from us.&nbsp;</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION 21 - WAIVERS</span></h1>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>Our failure to act with respect to a breach of these Terms and Conditions by you or others does not waive our right to act with respect to that breach or subsequent similar or other breaches.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'>SECTION 22 - FORCE MAJEURE</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;color:black;'>Neither party hereto shall be responsible for delays or failures in performance resulting from acts beyond its reasonable control and without its fault or negligence. Such excusable delays or failures may be caused by, among other things, strikes, lock-out, riots, rebellions, accidental explosions, floods, storms, acts of God and similar occurrences.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'>SECTION 23 - GOVERNING LAW AND JURISDICTION</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>These Terms and Conditions will be governed by and construed in accordance with Singapore law, and the courts of Singapore will have non-exclusive jurisdiction to adjudicate any dispute arising under or in relation to these terms of sale.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>Any claim, action, lawsuit or proceeding arising out of or related to this website and the services and products provided, shall be instituted exclusively in the federal courts of the Singapore and the user hereof irrevocably submits to the exclusive jurisdiction of such courts in any claim, action, lawsuit or proceeding, and waives any objection based on improper venue.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'>SECTION 24 &ndash; COMMISSIONS</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>Yocolab reserves full rights to charge commission for each class posted by the instructor. More details on commissions are available <u><a style="color:#0070C0;" href="{{url('payout-policy')}}">here.</a></u> Yocolab will manage, maintain &amp; support the platform with help of these commissions. Yocolab reserves full rights to charge transaction fee to its students for every session registered by students. &nbsp;</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">SECTION 25 -COPYRIGHT</span></h1>
<p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;line-height:115%;vertical-align:baseline;'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;border:none windowtext 1.0pt;padding:0cm;'>Copyright &copy; 2020 &ldquo;Yocolab&rdquo;. All rights reserved. All materials presented on this site are copyrighted and owned by us, or other individuals or entities as designated. Any republication, retransmission, reproduction, downloading, storing or distribution of all or part of any materials found on this site is expressly prohibited.</span></p>
<h1 style='margin-top:24.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:24px;font-family:"Montserrat", sans-serifcolor:black;'>SECTION 25 - CONTACT</h1>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serif'><span style='font-size:18px;line-height:115%;font-family:"Montserrat", sans-serif;'>For more information regarding our Terms and Conditions, please send us an email at: contact@yocolab.com</span></p>
</div>
</div>
</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					{{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
				</div>
			</div>
		</div>
	</div>
	{{-- Terms and conditions Modal End --}}