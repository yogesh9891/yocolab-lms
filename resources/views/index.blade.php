@extends('layouts.app')
@section('title','Yocolab')
@section('content')


	<!-- 2nd Home Slider -->
	<div class="home1-mainslider">
		<div class="container-fluid p0">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-banner-wrapper">
						<video autoplay="" id="myVideo" loop="" muted="">
							<source src="{{secure_asset('front_assets/images/yoco-intro-video.mp4')}}" type="video/mp4">
						</video>
					
					</div><!-- /.main-banner-wrapper -->
				</div>
			</div>
		</div>
	</div>

	<!-- School Category Courses -->
	<section id="our-courses" class="our-courses pt90 pt650-992">

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<a href="#our-courses">
				    	<div class="mouse_scroll">
			        		<div class="icon"><span class="flaticon-download-arrow"></span></div>
				    	</div>
				    </a>
				</div>
			</div>
		</div>
	<section class="popular-courses bgc-thm2">
			<div class="container style2">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0 color-white">Our Talented Instructors</h3>
						<p class="color-white">Follow experienced, knowledgeable and charismatic instructors across diverse geographies.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="popular_course_slider">
						@foreach($teachers as $item)
						
						<div class="item">
							<div class="top_courses home2 mb0">
								<a href="{{url('/profile/'.str_slug($item->user->name).'/'.$item->teacher_id)}}">
									<div class="thumb">
										<img loading="lazy" class="img-whp" src="{{secure_asset('storage/teacher/'.$item->image)}}" alt="t1.jpg'">
										<div class="overlay">
											
										
											<span class="tc_preview_course">View Profile</span>
										</div>
									</div>
									<div class="details">
										<div class="tc_content">
											<p>{{$item->expert}}</p>
											<h5>
												@if($item->user)
												{{$item->user->name}}
												@endif
											</h5>
											<p>{{$item->experience}} of Experience</p>
										</div>
										<div class="tc_footer">
											<ul class="tc_meta float-left">
												<li class="list-inline-item"><i class="flaticon-profile"></i></li>
												<li class="list-inline-item">{{teaherStudents($item->user_id)}}</a></li>
											{{-- 	<li class="list-inline-item"><i class="flaticon-comment"></i></li>
												<li class="list-inline-item">25</li> --}}
											</ul>
											<div class="tc_price float-right">{{$item->country}}</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
						
					</div>
				</div>
			</div>
		</div>
	</section>
		<div class="container pt-5">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0">Our Top Categories </h3>
						<p>The most commonly searched categories.</p>
					</div>
				</div>
			</div>
			<div class="row">
			@foreach($category as $cat)
			<div class="col-sm-6 col-lg-3">
				@php if($cat->image)  {$image = 'storage//img/category/'.$cat->image ;} else{ $image = 'front_assets/images/courses/1.jpg' ;}    @endphp
						<a href="{{url('courses/')}}?cat={{$cat->slug}}"><div class="img_hvr_box" style="background-image: url({{secure_asset($image)}});">
						<div class="overlay">
							<div class="details">
								<h5>{{$cat->name}}</h5>
								{{-- <p>Over {{category_courses($cat->id)}} Classes</p> --}}
							</div>
						</div>
					</div>
				</a>
				</div>
		
			@endforeach
			
				<!-- <div class="col-lg-6 offset-lg-3">
					<div class="courses_all_btn text-center">
						<a class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" href="#">View All Courses</a>
					</div>
				</div> -->
			</div>
		</div>
	</section>

	<!-- Top Courses -->
	<section id="top-courses" class="top-courses pb30">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0"> Our Upcoming Classes</h3>
						<p> Classes from Instructors all over the world.</p>
					</div>
				</div>
			</div>
			<div class="row">
			 	<div class="col-lg-12">
			 		<div id="options" class="alpha-pag full">
						<div class="option-isotop">
							<ul id="filter" class="option-set" data-option-key="filter">
								<li class="list-inline-item"><a href="#all" data-option-value="*" class="selected">All</a></li>
								@foreach($category as $item)
								<li class="list-inline-item"><a href="#{{$item->slug}}" data-option-value=".{{$item->slug}} " >{{$item->name}}</a></li>
								@endforeach
								
							</ul>
						</div>
					</div><!-- FILTER BUTTONS -->
			 		<div class="emply-text-sec iso-sec">
			 			<div class="row" id="masonry_abc">
			 				@if(count($courses) > 0)
			 				@php $p=1;  @endphp
							 @foreach($courses as $index =>$course)

								@php
										$t = teacherDetail($course->user_id);
													
												$time2 = date('H:i',  strtotime($course->time) + $course->duration*3600);
												$date=date_create($course->date);
												$date =date_format($date,"Y-m-d");
												$dat = new DateTime($date.' '.$time2);
													$timezone = timezone($course);
														
																$c_date1 = $timezone->date;	
																$c_time1 = $timezone->time;
										
									  @endphp
					
			 				@if((new DateTime('now') <= $dat ) && ($p <=8))
			 				@php $p++;  @endphp
			 				<div class="col-md-6 col-lg-4 col-xl-3   @if($course->category) {{$course->category->slug}} {{categorySlug($course->id)}} @endif">
			 					<div class="top_courses">
			 							@auth
				 							@if(!userCourse($course->id))
				 							<a class="whishlist-link" href="#!"  data-id="{{$course->id}}" onclick="addToWishlist(this)"></a>
				 							@endif
			 							@else
			 							<a class="whishlist-link" href="#!" data-toggle="modal" data-target="#exampleModalCenter"></a>
			 							@endauth
			 						
			 						<a href="{{url('class/'.$course->slug)}}" class="d-block h-100">
			 							<div class="thumb">
			 								@if($course->image)
			 									<img loading="lazy" class="img-whp" src="{{secure_asset('storage/course/'.$course->image)}}" alt="t1.jpg">
											@else
												<iframe width="420" height="315" src="{{$course->url}}"></iframe>
											@endif
											<div class="overlay">
												<div class="class-rec-type">
													<span class="class-live"><i class="fa fa-circle"></i>{{$course->type}}</span>
												</div>
												{{-- <a class="tc_preview_course" href="{{url('course/'.$course->id)}}">Preview Course</a> --}}
											</div>
										</div>
										<div class="details">
											<div class="tc_content">
												<p> {{$t->user->name}}
													@if($t->rating > 0)
													<ul class="tc_review">
														@for($i=1;$i<=$t->rating;$i++)
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														@endfor
														<li class="list-inline-item">({{$t->rating}})</li>
													</ul>
													@else
													<ul class="tc_review">
														@for($i=1;$i<=5;$i++)
														<li class="list-inline-item"><i class="fa fa-star text-secondary"></i></li>
														@endfor
														<li class="list-inline-item">(0)</li>
													</ul>
													@endif
												</p>
												<h5>{{$course->title}}</h5>
												<div class="date-n-time-holder">
													@if($course->type == 'Live')
													<p>{{$c_date1}}</p>
													<p class="time-display">{{$c_time1}} </p>
													@else
													<p>{{date("d M Y", strtotime($course->created_at))}}</p>
													<p class="time-display">{{$course->duration}} hrs </p>
													@endif
												</div>
											</div>
											<div class="tc_footer">
												<ul class="tc_meta float-left">
													<li class="list-inline-item"><i class="flaticon-profile"> </i> {{studentEnrolled($course->id)}}</li>
												</ul>
												<div class="tc_price float-right">
												
													{!! userPriceText($course->id) !!}
													
												</div>
											</div>
										</div>
									</a>
								</div>
			 				</div>
			 				@endif
			 				@endforeach
			 				@else
			 				<div class="col-md-12 col-lg-12 col-xl-12 text-center py-5 my-5  ">
			 					<h1 style="opacity: 0.5 !important; font-size:18px">No Classes Available</h1>
			 			</div>
			 				@endif
			 			</div>
			 			<div class="col-md-12 col-lg-12 col-xl-12 text-center py-5 my-5  hide-sec">
			 					<h1 style="opacity: 0.5 !important; font-size:18px">No Classes Available</h1>
			 			</div>
			 		</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Home Page Static Left Sliders Section -->
	<section class="home-sliders-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-sm-12 d-flex align-items-center info-content-block">
					<div class="info-block-wrapper">
						<div class="info-block">
							<h2>Learn Anything </h2>
							<p>There are no barriers, no boundaries when it comes to learning. Pick your favorite topic, add new skills and be creative.</p>
							<a href="{{url('/courses')}}" class="btn btn-primary-custom btn-primary-custom-border">Browse Classes</a>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-sm-12 slider-content-block">
					<div id="slider-1" class="carousel slide" data-ride="carousel" data-interval="2000">
						<div class="info-block-wrapper d-none" >
							<div class="info-block">
								<h2>Be An Instructor</h2>
								<p>You can make a difference. Teaching is one of the most direct ways to make an impact. Become a Guru.</p>
								@auth

								@hasrole('teacher')
								<a href="{{url('teacher/create-course')}}" class="btn btn-primary-custom btn-primary-custom-border">Browse Classes</a>
								@else
								<a href="{{url('/teacher/teacher-register')}}" class="btn btn-primary-custom  btn-primary-custom-border">Browse saddaClasses</a>
								@endhasrole

								@else

								<a href="#!"  data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Browse Classes</a>

								@endauth
							</div>
						</div>
						<ol class="carousel-indicators">
							<li data-target="#slider-1" data-slide-to="0" class="active" aria-hidden="true"></li>
							<li data-target="#slider-1" data-slide-to="1" aria-hidden="true"></li>
							<li data-target="#slider-1" data-slide-to="2" aria-hidden="true"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-1.jpg')}}" class="d-block w-100" alt="Slide 1">
							</div>
							<div class="carousel-item">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-2.jpg')}}" class="d-block w-100" alt="Slide 2">
							</div>
							<div class="carousel-item">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-3.jpg')}}" class="d-block w-100" alt="Slide 3">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="divider_home1 bg-img2 " data-stellar-background-ratio="0.3" style="padding: 70px 0">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 text-center">
                <img loading="lazy" src="{{ asset('images/Yoco-01.png') }}">	
<!-- 					<div class="divider-one">
						<p class="color-white">STARTING ONLINE LEARNING</p>
						<h1 class="color-white text-uppercase">Enhance your skIlls wIth best OnlIne Classes</h1>
						<a class="btn btn-transparent divider-btn" href="{{url('/courses')}}">Get Started Now</a>
					</div> -->
				</div>
			</div>
		</div>
	</section>

	<!-- Home Page Static right Sliders Section -->
	<section class="home-sliders-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-8 col-sm-12 slider-content-block">
					<div id="slider-1" class="carousel slide" data-ride="carousel" data-interval="2000">
						<div class="info-block-wrapper d-none">
							<div class="info-block">
								<h2>Be An Instructor</h2>
								<p>You can make a difference. Teaching is one of the most direct ways to make an impact. Become a Guru.</p>
								<a href="{{url('/courses')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Browse Classes</a>
							</div>
						</div>
						<ol class="carousel-indicators">
							<li data-target="#slider-1" data-slide-to="0" class="active" aria-hidden="true"></li>
							<li data-target="#slider-1" data-slide-to="1" aria-hidden="true"></li>
							<li data-target="#slider-1" data-slide-to="2" aria-hidden="true"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-4.jpg')}}" class="d-block w-100" alt="Slide 1">
							</div>
							<div class="carousel-item">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-5.jpg')}}" class="d-block w-100" alt="Slide 2">
							</div>
							<div class="carousel-item">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-6.jpg')}}" class="d-block w-100" alt="Slide 3">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-12 d-flex align-items-center info-content-block">
					<div class="info-block-wrapper right">
						<div class="info-block">
							<h2>Learn Anytime</h2>
							<p>Classes round-the-clock. Learn as per your convenience, revel in the pleasure of learning. </p>
							<a href="{{url('/courses')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Browse Classes</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Divider -->
	<section class="divider_home1  parallax" data-stellar-background-ratio="0.3" style="background-image:url('{{secure_asset('front_assets/images/learn.jpg')}}')">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="divider-one">
						<p class="color-white">STARTING ONLINE LEARNING</p>
						<h1 class="color-white text-uppercase">Enhance your skIlls wIth best OnlIne Classes</h1>
						<a class="btn btn-transparent divider-btn" href="{{url('/courses')}}">Get Started Now</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Home Page Static Left Sliders Section -->
	<section class="home-sliders-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-sm-12 d-flex align-items-center info-content-block">
					<div class="info-block-wrapper">
						<div class="info-block">
							<h2>Be An Instructor</h2>
							<p>You can make a difference. Teaching is one of the most direct ways to make an impact. Become a Guru.</p>
							@auth
		        		@hasrole('teacher')
		        	 	<a href="{{route('create-course')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Create Class</a>
		        	 	@else
		        	 	<a href="{{route('teacher-register')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Become Instructor</a>
		        	 	@endif
		        	 	@else
							<a href="#!" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Become Instructor</a>
		        	@endauth
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-sm-12 slider-content-block">
					<div id="slider-1" class="carousel slide" data-ride="carousel" data-interval="2000">
						<div class="info-block-wrapper d-none">
							<div class="info-block">
								<h2>Be An Instructor</h2>
								<p>You can make a difference. Teaching is one of the most direct ways to make an impact. Become a Guru..</p>
								<a href="#!" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Browse Classes</a>
							</div>
						</div>
						<ol class="carousel-indicators">
							<li data-target="#slider-1" data-slide-to="0" class="active" aria-hidden="true"></li>
							<li data-target="#slider-1" data-slide-to="1" aria-hidden="true"></li>
							<li data-target="#slider-1" data-slide-to="2" aria-hidden="true"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-7.jpg')}}" class="d-block w-100" alt="Slide 1">
							</div>
							<div class="carousel-item">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-8.jpg')}}" class="d-block w-100" alt="Slide 2">
							</div>
							<div class="carousel-item">
								<img loading="lazy" src="{{secure_asset('front_assets/images/home-sliders/slider-9.jpg')}}" class="d-block w-100" alt="Slide 3">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Testimonials -->
	<!-- <section id="our-testimonials" class="our-testimonials">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0">What People Say</h3>
						<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="testimonialsec">
						<ul class="tes-nav">
							<li>
								<img loading="lazy" class="img-fluid" src="{{secure_asset('front_assets/images/testimonial/1.jpg')}}" alt="1.jpg')}}"/>
							</li>
							<li>
								<img loading="lazy" class="img-fluid" src="{{secure_asset('front_assets/images/testimonial/2.jpg')}}" alt="2.jpg')}}"/>
							</li>
							<li>
								<img loading="lazy" class="img-fluid" src="{{secure_asset('front_assets/images/testimonial/3.jpg')}}" alt="3.jpg')}}"/>
							</li>
							<li>
								<img loading="lazy" class="img-fluid" src="{{secure_asset('front_assets/images/testimonial/4.jpg')}}" alt="4.jpg')}}"/>
							</li>
						</ul>
						<ul class="tes-for">
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h5>Ali Tufan</h5>
										<span class="small text-thm">Client</span>
										<p>Customization is very easy with this theme. Clean and quality design and full support for any kind of request! Great theme!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h5>Ali Tufan</h5>
										<span class="small text-thm">Client</span>
										<p>Customization is very easy with this theme. Clean and quality design and full support for any kind of request! Great theme!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h5>Ali Tufan</h5>
										<span class="small text-thm">Client</span>
										<p>Customization is very easy with this theme. Clean and quality design and full support for any kind of request! Great theme!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h5>Ali Tufan</h5>
										<span class="small text-thm">Client</span>
										<p>Customization is very easy with this theme. Clean and quality design and full support for any kind of request! Great theme!</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section> -->

	<!-- Our Blog -->
	<!-- <section class="our-blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0">Latest News And Events</h3>
						<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-xl-6">
					<div class="blog_slider_home1">
						<div class="item">
							<div class="blog_post one">
								<div class="thumb">
									<div class="post_title">Events</div>
									<img loading="lazy" class="img-fluid w100" src="{{secure_asset('front_assets/images/blog/1.jpg')}}" alt="1.jpg')}}">
									<a class="post_date" href="#"><span>28 <br> March</span></a>
								</div>
								<div class="details">
									<div class="post_meta">
										<ul>
											<li class="list-inline-item"><a href="#"><i class="flaticon-calendar"></i> 8:00 am - 5:00 pm</a></li>
											<li class="list-inline-item"><a href="#"><i class="flaticon-placeholder"></i> Vancouver, Canada</a></li>
										</ul>
									</div>
									<h4>Elegant Light Box Paper Cut Dioramas New Design Conference</h4>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="blog_post one">
								<div class="thumb">
									<div class="post_title">Events</div>
									<img loading="lazy" class="img-fluid w100" src="{{secure_asset('front_assets/images/blog/1a.jpg')}}" alt="1a.jpg')}}">
									<a class="post_date" href="#"><span>28 <br> March</span></a>
								</div>
								<div class="details">
									<div class="post_meta">
										<ul>
											<li class="list-inline-item"><a href="#"><i class="flaticon-calendar"></i> 8:00 am - 5:00 pm</a></li>
											<li class="list-inline-item"><a href="#"><i class="flaticon-placeholder"></i> Vancouver, Canada</a></li>
										</ul>
									</div>
									<h4>Elegant Light Box Paper Cut Dioramas New Design Conference</h4>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="blog_post one">
								<div class="thumb">
									<div class="post_title">Events</div>
									<img loading="lazy" class="img-fluid w100" src="{{secure_asset('front_assets/images/blog/1b.jpg')}}" alt="1b.jpg')}}">
									<a class="post_date" href="#"><span>28 <br> March</span></a>
								</div>
								<div class="details">
									<div class="post_meta">
										<ul>
											<li class="list-inline-item"><a href="#"><i class="flaticon-calendar"></i> 8:00 am - 5:00 pm</a></li>
											<li class="list-inline-item"><a href="#"><i class="flaticon-placeholder"></i> Vancouver, Canada</a></li>
										</ul>
									</div>
									<h4>Elegant Light Box Paper Cut Dioramas New Design Conference</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-3">
					<div class="blog_post">
						<div class="thumb">
							<img loading="lazy" class="img-fluid w100" src="{{secure_asset('front_assets/images/blog/2.jpg')}}" alt="2.jpg')}}">
							<a class="post_date" href="#">July 21, 2019</a>
						</div>
						<div class="details">
							<h5>Marketing</h5>
							<h4>A Solution Built for Teachers</h4>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-3">
					<div class="blog_post">
						<div class="thumb">
							<img loading="lazy" class="img-fluid w100" src="{{secure_asset('front_assets/images/blog/3.jpg')}}" alt="3.jpg')}}">
							<a class="post_date" href="#">July 21, 2019</a>
						</div>
						<div class="details">
							<h5>Business</h5>
							<h4>An Overworked Newspaper Editor</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt50">
				<div class="col-lg-12">
					<div class="read_more_home text-center">
						<h4>Like what you see? <a href="#">See more posts<span class="flaticon-right-arrow pl10"></span></a></h4>
					</div>
				</div>
			</div>
		</div>
	</section> -->

	<!-- Our Talented Instructors Courses -->
{{-- 	<section class="popular-courses bgc-thm2">
		<div class="container-fluid style2">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0 color-white">Our Talented Instructors</h3>
						<p class="color-white">Follow experienced, knowledgeable and charismatic instructors across diverse geographies.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="popular_course_slider">
						@foreach($teachers as $item)
						
						<div class="item">
							<div class="top_courses home2 mb0">
								<a href="{{url('/profile/'.str_slug($item->user->name).'/'.$item->teacher_id)}}">
									<div class="thumb">
										<img loading="lazy" class="img-whp" src="{{secure_asset('storage/teacher/'.$item->image)}}" alt="t1.jpg'">
										<div class="overlay">
											
										
											<span class="tc_preview_course">View Profile</span>
										</div>
									</div>
									<div class="details">
										<div class="tc_content">
											<p>{{$item->expert}}</p>
											<h5>
												@if($item->user)
												{{$item->user->name}}
												@endif
											</h5>
											<p>{{$item->experience}} of Experience</p>
										</div>
										<div class="tc_footer">
											<ul class="tc_meta float-left">
												<li class="list-inline-item"><i class="flaticon-profile"></i></li>
												<li class="list-inline-item">{{teaherStudents($item->user_id)}}</a></li>
										
											</ul>
											<div class="tc_price float-right">{{$item->country}}</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
						
					</div>
				</div>
			</div>
		</div>
	</section> --}}
		
	<!-- Popular Job Categories -->
	<section class="home1-divider2 parallax" data-stellar-background-ratio="0.3">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-lg-7">
					<div class="app_grid">
						<h1 class="mt0">Download & Enjoy</h1>
						<p>Our Mobile Applications are coming soon. We will notify you,<br> stay tuned</p>
						<button class="apple_btn btn-transparent">
							<span class="icon">
								<span class="flaticon-apple"></span>
							</span>
							<span class="title">Coming Soon On</span>
							<span class="subtitle">App Store</span>
						</button>
						<button class="play_store_btn btn-transparent">
							<span class="icon">
								<span class="flaticon-google-play"></span>
							</span>
							<span class="title">Coming Soon On</span>
							<span class="subtitle">Google Play</span>
						</button>
					</div>
				</div>
				<div class="col-md-5 col-lg-5">
					<div class="phone_img">
						<img loading="lazy" class="img-fluid" src="{{secure_asset('front_assets/images/resource/phone_home.png')}}" alt="phone_home.png">
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
