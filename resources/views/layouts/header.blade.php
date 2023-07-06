<!-- Main Header Nav -->
	<header class="header-nav menu_style_home_one navbar-scrolltofixed stricky main-menu">
		<div class="container-fluid">
		    <!-- Ace Responsive Menu -->
		    <nav>
		        <!-- Menu Toggle btn-->
		        <div class="menu-toggle">
		            <img class="nav_logo_img img-fluid" src="{{asset('front_assets/images/header-logo.png')}}" alt="header-logo.png">
		            <button type="button" id="menu-btn">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		        </div>
		        <a href="{{ url('/')}}" class="navbar_brand float-left dn-smds">
		            <img class="logo1 img-fluid" src="{{asset('front_assets/images/yocolab-logo.png')}}" alt="header-logo.png">
		            <img class="logo2 img-fluid" src="{{asset('front_assets/images/yocolab-logo-2.png')}}" alt="header-logo2.png">
		        </a>
		        <!-- Responsive Menu Structure-->
		        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
		        <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
		          
		            <li class="last browse-course-first-list">
		                <a href="#!"><span class="title">Browse</span></a>
		                		@php  $categ = categories(); @endphp
	                	<ul class="browse-course-list">
	                		@foreach($categ as $category)
	                		<li class="course-cat"><a href="{{url('courses/')}}?cat={{$category->slug}}">{{$category->name}}</a>
	                			@if($category->subcategory)
	                			<ul class="cat-course-lists">
	                				@foreach($category->subcategory as $sub)
                					<li><a  href="{{url('courses/')}}?sub={{$sub->slug}}">{{$sub->name}}</a></li>
                					
                					@endforeach
	                			</ul>
	                			@endif
	                		</li>
	                		@endforeach
	                

	                	</ul>
		            </li>
		            <li><a href="{{url('courses')}}" class="browse-all-courses">All Classes</a></li>
		            <li><a href="{{url('instructors')}}" class="browse-all-courses">All Instructors</a></li>
		        </ul>
		        <ul class="sign_up_btn pull-right dn-smds mt10"  data-menu-style="horizontal">
		        	@auth
		        		@hasrole('teacher')
		        	 	<a href="{{route('create-course')}}" class="btn btn-primary-custom btn-primary-custom-round">Create Class</a>
		        	 	@else
		        	 	<a href="{{route('teacher-register')}}" class="btn btn-primary-custom btn-primary-custom-round">Become Instructor</a>
		        	 	@endif
		        	@endauth


		        	@auth
		                <li class="list-inline-item list_s drop-dwn">
		                	<a href="#" class="btn flaticon-user">
		                		<span class="dn-lg">My Account</span>
		                	</a>
		                	<ul class="sub-menu">
		                		<li class="user-name-list">Hi, <b>{{ Auth::user()->name }}</b></li>
		                		
			                    @hasrole('teacher')
			                    <li><a href="{{url('teacher/dashboard')}}">Dashboard</a></li>
			                   
			                    {{-- <li><a href="{{ url('teacher-register') }}">Teacher Registeration</a></li> --}}
			                    <li><a href="{{ url('teacher/profile') }}">My Profile</a></li>
			                    @else
			                    <li><a href="{{url('user/dashboard')}}">Dashboard</a></li>
			                    <li><a href="{{ url('user/profile') }}">My Profile</a></li>
			                    @endhasrole
			                    <li class="pt-3 pb-0">
			                    	 <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                        @csrf
                                        	<button  class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" type="submit">Log out</button>
                                    </form>
			                	</li>
		                	</ul>
			            </li>
		            <li class="list-inline-item list_s">
		            	<div class="cart_btn">
							<ul class="cart">
								<li>
									<a href="#!" class="btn noti_btn flaticon-alarm-1 " >@if(count(Auth::user()->unreadNotifications )>0)<span id="total_noti">{{count(Auth::user()->unreadNotifications)}}</span> @endif</a>
									<ul class="dropdown_content notification-list">
										@if(count(Auth::user()->unreadNotifications)>0)
			              			@foreach (Auth::user()->unreadNotifications as $n)
										<li class="list_content" style="animation-delay: 0.1s;">
											<div class="title"><a href="{{$n->data['actionURL']}}/{{$n->id}}">{!!$n->data['title'] !!}</a></div>
											<p>{{$n->data['message'] }}</p>
											<small style="color: #007bff">{{$n->updated_at->diffForHumans()}}</small>
											<span class="close_icon float-right close_notification"  id="{{$n->id}}"><i class="fa fa-plus"></i></span>
										</li>
										@endforeach
										<li class="list_content last-list fixed-view" style="animation-delay: 0.19s;">
											<a href="  @hasrole('teacher') {{url('teacher/dashboard')}} @else {{url('/user/dashboard')}}  @endhasrole" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">View All</a>
										</li>
										@else
										<li class="list_content">
											
											<h4><font color="red">No New Notification</font></h4>
											
										</li>
										<li class="list_content fixed-view" style="animation-delay: 0.19s;">
											<a href="  @hasrole('teacher') {{url('teacher/dashboard')}} @else {{url('/user/dashboard')}}  @endhasrole" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">View All</a>
										</li>
										@endif
									
									</ul>
									
								</li>
							</ul>
						</div>
		            </li>
		        	@else
		                <li class="list-inline-item list_s drop-dwn">
		                	<a href="#" class="btn flaticon-user" data-toggle="modal" data-target="#exampleModalCenter">
		                		<span class="dn-lg">Login/Register</span>
		                	</a>
		                </li>
		            @endauth
	                <li class="list-inline-item list_s">
	                	<div class="cart_btn">
							<ul class="cart">
								<li>
									
									<a href="#" class="btn cart_btn flaticon-like" id="total_cart"> @if(session('cart'))
										<span >
									@php echo $c = count(session('cart'));
									 $subtotal = 0; @endphp
									</span>
									 @endif</a>

									<ul class="dropdown_content"  id="res_cart_header">
										 @if(session('cart'))
										 	 @foreach(session('cart') as $id => $details)
      								      @php 
      								      		$c = App\Models\Course::find($id);
      								      		
      								      		$curr =  currency_convert($c);
      								      $subtotal += $details['price']- ($details['price']*$details['discount']/100 );   @endphp

										<li class="list_content">
											<a href="#">
												<img class="float-left" src="{{asset('storage/course/'.$details['image'])}}" alt="50x50" height="50" width="50">
												<p>{{$details['title']}}</p>
												<small>{!! $curr->html !!}</small>
												<a href="javascript:void(0)" onclick="removeItemCart({{$id}})"><span class="close_icon float-right"><i class="fa fa-plus"></i></span></a>
											</a>
										</li>
										@endforeach
										 @auth
										<li class="list_content">
											
										<a href="{{url('/user/my-bookmarks')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" >My Wishlist</a>
											
										@else
											
										@endauth
										</li>
										@else
											<li class="list_content">
										
											<p>
Classes you like appears here. <br><br>
Find your favourite classes and add them to your Wishlist.
</p>
										
										</li>

										@endif
									</ul>
								</li>
							</ul>
						</div>
	                </li>
	                <li class="list-inline-item list_s">
	                	<div class="search_overlay">
						 	<a id="search-button-listener" class="mk-search-trigger mk-fullscreen-trigger" href="#">
						    	<span id="search-button"><i class="flaticon-magnifying-glass"></i></span>
						 	</a>
						</div>
	                </li>
	            </ul><!-- Button trigger modal -->
		    </nav>
		</div>
	</header>
	<!-- Modal -->
	<!-- Modal -->

	


		{{-- Terms and conditions Modal Start --}}
	<div class="modal fade" id="payment_modal" tabindex="-1" aria-labelledby="tnc_modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tnc_modalLabel">Yocolab Payout Policy</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container">
        <div class="col-12 col-md-12">
   
<div style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Montserrat", sans-serifborder:none;border-bottom:solid #4F81BD 1.0pt;padding:0cm 0cm 4.0pt 0cm;'>
    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.0pt;margin-left:0cm;border:none;padding:0cm;font-size:35px;font-family:"Montserrat", sans-serif;color:#17365D;line-height:115%;'><span style="color:windowtext;border:none windowtext 1.0pt;padding:0cm;">Yocolab Payout Policy</span></p>
</div>
 
    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;margin-top:0cm;margin-bottom:12.0pt;background:white;'><strong><u><span style='font-family:"Open Sans",sans-serif;color:#4E5565;'>Commissions</span></u></strong></p>
    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;margin-top:0cm;margin-bottom:12.0pt;background:white;'><span style='font-family:"Open Sans",sans-serif;color:#4E5565;'>Yocolab takes a percentage of the class fee for maintaining the platform and help instructors to promote their classes. Yocolab does this by running multiple marketing campaigns on various platforms.&nbsp;</span></p>
    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;margin-top:0cm;margin-bottom:12.0pt;background:white;'><span style='font-family:"Open Sans",sans-serif;color:#4E5565;'>For every class, Instructor will receive 75% of the total class fees and Yocolab will retain a 25% platform fee.&nbsp;</span></p>
    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;margin-top:0cm;margin-bottom:12.0pt;background:white;'><span style='font-family:"Open Sans",sans-serif;color:#4E5565;'>&nbsp;</span></p>
    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;margin-top:0cm;margin-bottom:12.0pt;background:white;'><strong><u><span style='font-family:"Open Sans",sans-serif;color:#4E5565;'>Payouts</span></u></strong></p>
    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;margin-top:0cm;margin-bottom:12.0pt;background:white;'><span style='font-family:"Open Sans",sans-serif;color:#4E5565;'>Yocolab makes the payout process hassle-free. Yocolab partners with multiple payment gateways such as Stripe to facilitate payouts. Bank details for Instructors will be collected and securely stored &nbsp;by Stripe gateway. This is the pre-requisite for creating your first class. This will be a one time activity.&nbsp;</span></p>
    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;margin-top:0cm;margin-bottom:12.0pt;background:white;'><span style='font-family:"Open Sans",sans-serif;color:#4E5565;'>Payouts will be initiated once the class is successfully completed by the Instructor. &nbsp;These payouts will be directly credited within 10 days to the Instructor bank account on a per class basis.&nbsp;</span></p>
    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Montserrat", sans-serif;margin:0cm;margin-top:0cm;margin-bottom:12.0pt;background:white;'><span style='font-family:"Open Sans",sans-serif;color:#4E5565;'>In case of any complaints/concerns raised by the students in a particular class, Yocolab reserves the rights to hold Instructor&rsquo;s payout until the complaints/concerns has been resolved.&nbsp;</span></p>

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

	<!-- Modal Search Button Bacground Overlay -->
    <div class="search_overlay dn-768">
		<div class="mk-fullscreen-search-overlay" id="mk-search-overlay">
		    <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button"><i class="fa fa-times"></i></a>
		    <div id="mk-fullscreen-search-wrapper">
		      <form method="get" id="mk-fullscreen-searchform" action="{{url('/courses')}}">
		        <input type="text" name="q" value="" placeholder="Search courses..." id="mk-fullscreen-search-input" autofocus aria-label="Search3">
		        <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit"></i>
		      </form>
		    </div>
		</div>
	</div>

	<!-- Main Header Nav For Mobile -->
	<div id="page" class="stylehome1 h0">
		<div class="mobile-menu">
			<div class="header stylehome1">
				<div class="main_logo_home2">
		            <img class="nav_logo_img img-fluid float-left" src="{{asset('front_assets/images/yocolab-logo.png')}}" alt="header-logo.png">
		            {{-- <a href="{{url('courses')}}" class="browse-all-courses mobile-all-classes">All Classes</a> --}}
				</div>
				 <ul class="menu_bar_home2">
					<li class="list-inline-item">
	                	<div class="search_overlay">
						  <a id="search-button-listener2" class="mk-search-trigger mk-fullscreen-trigger" href="#">
						    <div id="search-button2"><i class="flaticon-magnifying-glass"></i></div>
						  </a>
							<div class="mk-fullscreen-search-overlay" id="mk-search-overlay2">
							    <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button2"><i class="fa fa-times"></i></a>
							    <div id="mk-fullscreen-search-wrapper2">
							      <form method="get" id="mk-fullscreen-searchform2">
							        <input type="text" value="" placeholder="Search courses..." id="mk-fullscreen-search-input2" aria-label="Search">
							        <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit"></i>
							      </form>
							    </div>
							</div>
						</div>
					</li>
					 <li class="list-inline-item"><a href="#menu"><span></span></a></li> 
				</ul> 
			</div>
		</div><!-- /.mobile-menu -->
		<nav id="menu" class="stylehome1">
			<ul>
				<li><a href="{{ url('/')}}">Home</a>
	                <!-- Level Two-->
	                <!-- <ul>
	                    <li><a href="index-2.html">Home 1</a></li>
	                    <li><a href="index2.html">Home 2</a></li>
	                    <li><a href="index3.html">Home 3</a></li>
	                    <li><a href="index4.html">Home 4</a></li>
	                    <li><a href="index5.html">Home 5</a></li>
	                    <li><a href="index6.html">Home - University</a></li>
	                    <li><a href="index7.html">Home College</a></li>
	                    <li><a href="index8.html">Home Kindergarten</a></li>
	                </ul> -->
	            </li>
	            <li class="last browse-course-first-list">
		                <a href="#!"><span class="title">Browse</span></a>
		                @php  $categ = categories(); @endphp
	                	<ul class="browse-course-list">
	                
	                
	                		@foreach($categ as $category)
	                		<li class="course-cat"><a href="{{url('courses/')}}?cat={{$category->slug}}">{{$category->name}}</a>
	                			@if($category->subcategory)
	                			<ul class="cat-course-lists">
	                				@foreach($category->subcategory as $sub)
                					<li><a  href="{{url('courses/')}}?sub={{$sub->slug}}">{{$sub->name}}</a></li>
                					
                					@endforeach
	                			</ul>
	                			@endif
	                		</li>
	                		@endforeach
	                	</ul>
	                		</li>
	                	<li><a href="{{url('courses')}}"><span class="title">All Classes</span></a></li>

	                	<li>
	                		@auth
	                		<a href="#"><span class="flaticon-user"></span>Hi, {{ucfirst(auth()->user()->name)}}</a>
	                		@else
	                		<a href="#" data-toggle="modal" data-target="#exampleModalCenter" id="loginToggle"><span class="flaticon-user"></span> Login/Register</a>
	                		@endauth
	                	</li>	
	            {{-- <li><span>Browse</span>
	                <ul>
	                    <li><a href="page-shop-cart.html">Cart</a></li>
	                    <li><a href="page-shop-checkout.html">Checkout</a></li>
                    </ul>
	            </li> --}}
	            {{-- <li><span>Courses</span>
	              
                	<ul>
	                    <li><a href="page-course-v2.html">Courses</a></li>
	                    <li><a href="page-course-single-v2.html">Single</a></li>
	                    <li><a href="page-instructors-single.html">Instructor Single</a></li>
                	</ul>
	            </li> --}}
	            <!-- <li>
	                <a href="#"><span class="title">Events</span></a>
	                <ul>
	                    <li><a href="page-event.html">Event List</a></li>
	                    <li><a href="page-event-single.html">Event Single</a></li>
	                </ul>
	            </li> -->
	            <!-- <li>
	                <a href="#"><span class="title">Pages</span></a>
	                <ul>
			            <li>
			                <a href="#"><span class="title">Shop Pages</span></a>
			                <ul>
			                    <li><a href="page-shop.html">Shop</a></li>
			                    <li><a href="page-shop-single.html">Shop Single</a></li>
			                    <li><a href="page-shop-cart.html">Cart</a></li>
			                    <li><a href="page-shop-checkout.html">Checkout</a></li>
			                    <li><a href="page-shop-order.html">Order</a></li>
			                </ul>
			            </li>
			            <li>
			                <a href="#"><span class="title">User Admin</span></a>
			                <ul>
			                    <li><a href="page-dashboard.html">Dashboard</a></li>
			                    <li><a href="page-my-courses.html">My Courses</a></li>
			                    <li><a href="page-my-order.html">My Order</a></li>
			                    <li><a href="page-my-message.html">My Message</a></li>
			                    <li><a href="page-my-review.html">My Review</a></li>
			                    <li><a href="page-my-bookmarks.html">My Bookmarks</a></li>
			                    <li><a href="page-my-listing.html">My Listing</a></li>
			                    <li><a href="page-my-setting.html">My Setting</a></li>
	                        </ul>
			            </li>
	                    <li><a href="page-about.html">About Us</a></li>
	                    <li><a href="page-gallery.html">Gallery</a></li>
	                    <li><a href="page-faq.html">Faq</a></li>
	                    <li><a href="page-login.html">LogIn</a></li>
	                    <li><a href="page-register.html">Register</a></li>
	                    <li><a href="page-pricing.html">Membership</a></li>
	                    <li><a href="page-error.html">404 Page</a></li>
	                    <li><a href="page-terms.html">Terms and Conditions</a></li>
	                    <li><a href="page-become-instructor.html">Become an Instructor</a></li>
	                    <li><a href="page-ui-element.html">UI Elements</a></li>
	                </ul>
	            </li>
	            <li>
	                <a href="#"><span class="title">Blog</span></a>
	                <ul>
	                    <li><a href="page-blog-v1.html">Blog List 1</a></li>
	                    <li><a href="page-blog-grid.html">Blog List 2</a></li>
	                    <li><a href="page-blog-list.html">Blog List 3</a></li>
	                    <li><a href="page-blog-single.html">Single Post</a></li>
	                </ul>
	            </li> -->
	            {{-- <li><a href="page-contact.html"><span class="title">Contact</span></a></li> --}}

	                	</ul>
		            
				
				{{-- <li><a href="page-register.html"><span class="flaticon-edit"></span> Register</a></li> --}}
			
		</nav>
	</div>

	<div class="modal  hide fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message </h5>
        
      </div>
      <div class="modal-body">
       <h4>Please Check your email for verfication mail.</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
       
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Share Url</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12">
      		  <input type="text" value="{{url()->full()}}" id="myInput" class="form-control" aria-label="myInput">
      		 </div>
      		 <p class="text-success ml-2" id="copied"></p>
<!-- The button used to copy the text -->
		<div class="col-md-12">
			<button onclick="copyText()" class="btn btn-success">Copy text</button>
		</div>
	</div>
      </div>
      
    </div>
  </div>
</div>