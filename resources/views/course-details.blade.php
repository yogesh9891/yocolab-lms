@extends('layouts.app')
@section('title','Yocolab')
@section('og')
<!-- Site Name, Title, and Description to be displayed -->
<meta property="og:site_name" content="Yocolab">
<meta property="og:title" content="{{$course->title}}">
<meta property="og:description" content="BY {{$course->user->name}} {!! substr($course->desciption,0,50).".." !!}">


<!-- Image to display -->
<!-- Replace   «example.com/image01.jpg» with your own -->
<meta property="og:image" content="{{secure_asset('storage/course/'.$course->image)}}">
<meta property="og:image" itemprop="image" content="{{secure_asset('storage/course/'.$course->image)}}" />
@php $ext = explode('.',$course->image)  @endphp
<!-- No need to change anything here -->
<meta property="og:type" content="website" />
<meta property="og:image:type" content="image/{{$ext[1]}}">

<!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">

<!-- Website to visit when clicked in fb or WhatsApp-->
<meta property="og:url" content="{{url('/course/'.$course->id)}}">
@endsection
@section('content')



	@php
		 $material = explode(';',$course->material_id) ;
		 $timer ='';
		 
		
			$curr = currency_convert($course);
			$timestamp = strtotime($course->date);
	
			$new_date = date("d-m-Y", $timestamp);
			$new_time = date("H:i:s", $timestamp);;
			

			if($course->video_class){

				$course->class_status =$course->video_class->status;

				}

			$t = teacherDetail($course->user_id);

	if(Auth::user()){

		
				// $timezone = timezone($course);
				
			
				$start_date = new DateTime($course->date);							
				$since_start = $start_date->diff(new DateTime('NOW'));
					
			
				$start_ses ='';
					if($since_start->days==0 && $since_start->invert==1){

					

					if($since_start->i <=4 && $since_start->h==0){
					
						$timer = 'on';	

						} 
				

				} else{

							
					
				if($since_start->days == 0) {
					$course->durat = $course->duration*60*60;
					$since_start->duartion = $since_start->h*60 + $since_start->i;

					if($since_start->duartion <= $course->durat){
						$timer = 'on';
					}
						
					}	
					

			} 
		
}

		
	if($timer){
			$start_ses ='';
						
						$a = explode(';', $course->video_class->student_id);
						if(array_search(Auth::user()->id,$a) >= 0)
						{
							$join_ses =$course->video_class->id;
						
												
						 }

						 if(Auth::user()->id==$course->video_class->user_id)
						 {

							$start_ses =$course->video_class->id;
							$since_start->i.' minutes<br>';
							$since_start->days.' days total<br>';
							 
						}
	}



							
 @endphp
<style>
	.cs_row_one .courses_big_thumb {max-height: 540px;overflow: hidden;}
</style>
	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb csv2">
		<div class="container">
			<div class="row">
				<div class="col-xl-9">
					<div class="breadcrumb_content">
						<div class="cs_row_one csv2">
							<div class="cs_ins_container">
								<div class="cs_instructor">
									<ul class="cs_instrct_list float-left mb0 mr-4 d-flex align-items-center">
										<div class="d-flex align-items-center mr-4">
											<li class="list-inline-item mr-3"><img class="thumb" src="{{asset('storage/teacher/'.$course->teacher->image)}}" alt="4.png"></li>
											<li class="list-inline-item "><a class="color-white" href="{{url('profile/'.str_slug($t->user->name).'/'.$t->teacher_id)}}">{{$t->user->name}}</a>
											<br>
											@auth
											@if(Auth::id() != $course->user->id)
												@if($follow)
													<a class="color-white" href="{{url('user/follow-teacher/unfollow/'.str_slug($t->user->name).'/'.$t->teacher_id)}}"  ><strong><u>Unfollow</u></strong></a>
													@else
													<a class="color-white" href="{{url('user/follow-teacher/follow/'.str_slug($t->user->name).'/'.$t->teacher_id)}}"  ><strong><u>Follow</u></strong></a>
													@endif
												@endif
											@endauth
										
											</li>
										</div>
										
										<div>
											
										@if($t->rating > 0)
                                            @for($i=1;$i<=$t->rating;$i++)
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											@endfor
                                                <li class="list-inline-item"><a href="#">({{$t->rating}})</a></li>
                                        @endif
										@php
                                            $pdate=date_create($course->updated_at);
                                            $up_date = date_format($pdate,"d-m-Y H:i:s");
                                        @endphp
										</div>
										<!-- <li class="list-inline-item"><a class="color-white" href="#">Last updated {{$up_date}}</a></li> -->
									</ul>
									<ul class="cs_watch_list mb0 mt-0 ml-4">
									
									@auth
										@if(Auth::user()->id  != $course->user_id)
											<li class="list-inline-item"><a class="color-white" href="#!" onclick="addToWishlist(this)" data-id="{{$course->id}}"><span class="flaticon-like"></span></a></li>
											<li class="list-inline-item"><a class="color-white" href="#!"  onclick="addToWishlist(this)" data-id="{{$course->id}}">Add to Wishlist</a></li>
										@endif
									@else
										
									
											<a  href="#!" class="color-white" href="Javacript:void(0)" data-toggle="modal" data-target="#exampleModalCenter"><span class="flaticon-like"></span></a></li>
												<li class="list-inline-item"><a class="color-white" href="#">Add to Wishlist</a></li>
												
									
									@endauth
										
										

										<li class="list-inline-item"><a class="color-white" href="#"  data-toggle="modal" data-target="#shareModal"><span class="flaticon-share"> Share</span></a></li>

                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            
									</ul>
								</div>
							
								<h3 class="cs_title color-white">{{$course->title}}</h3>
								
								<ul class="cs_review_enroll">
									<li class="list-inline-item"><a class="color-white" href="#"><span class="flaticon-profile"></span> {{studentEnrolled($course->id)}} students enrolled</a></li>
									{{-- <li class="list-inline-item"><a class="color-white" href="#"><span class="flaticon-comment"></span> 25 Review</a></li> --}}
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Team Members -->
	<section class="course-single2 pb40">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-8 col-xl-9">
					<div class="row">
						<div class="col-lg-12">
							<div class="courses_single_container">
								<div class="cs_row_one">
									<div class="cs_ins_container">

										    @if(Session::has('success'))
						                            	<div class="alert alert-success">
														    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
														    <div class="icon hidden-xs">
														      <i class="fa fa-check"></i>
														    </div>
														    <strong>Congratulations!</strong>
														    <Br /> {!!Session::get('success')!!}
														  </div>
                						    @endif

                						      @if(Session::has('error'))
						                            	 <div class="alert alert-danger">
															    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
															    <div class="icon hidden-xs">
															      <i class="fa fa-ban"></i>
															    </div>
															    <strong>Error</strong>
															    <Br /> {{Session::get('error')}}
															  </div>
                						    @endif

										<div class="courses_big_thumb big-img-thumb">
											@if($course->preview)
											<video width="900" height="500" controls>
												  <source src="{{asset('storage/video/'.$course->preview)}}" type="video/mp4">
												 
												  Your browser does not support the video tag.
												</video>
											@elseif($course->url)
											<div class="thumb">
												<iframe class="iframe_video" src="{{$course->url}}" frameborder="0" allowfullscreen></iframe>
											</div>
											@else
											<div class="thm">
												
											<img src="{{asset('storage/course/'.$course->image)}}">
											</div>
											@endif
											
										</div>
									</div>
								</div>
								<div class="cs_rwo_tabs csv2">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
										    <a class="nav-link active" id="Overview-tab" data-toggle="tab" href="#Overview" role="tab" aria-controls="Overview" aria-selected="true">Overview</a>

										</li>
										@auth
										@if($course->material_id)
										@if(Auth::id() == $course->user_id)
										<li class="nav-item">
										    <a class="nav-link" id="course-tab" data-toggle="tab" href="#course" role="tab" aria-controls="course" aria-selected="false"> Content</a>
										</li>
										@endif
										@endauth
										@endif
										{{-- <li class="nav-item">
										    <a class="nav-link" id="instructor-tab" data-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="false">instructor</a>
										</li> --}}
										<!-- 
										<li class="nav-item">
										    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Review</a>
										</li> -->
									</ul>
									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="Overview" role="tabpanel" aria-labelledby="Overview-tab">
											<div class="cs_row_two csv2">
												<div class="cs_overview">
													<h4 class="title">Overview</h4>
													<h4 class="subtitle">Class Description</h4>
													<p class="mb30">{!! $course->desciption !!}</p>
													<h4 class="subtitle">What you'll learn</h4>
													@php $learns = explode(';',$course->learn) ; @endphp
													<ul class="cs_course_syslebus">
															@foreach($learns as $item)
														<li><i class="fa fa-check"></i><p>{{$item}}</p></li>
														@endforeach
														
													</ul>
													
													<h4 class="subtitle">Requirements</h4>
															@php $requirements = explode(';',$course->requirement) ; @endphp
													<ul class="list_requiremetn">
														@foreach($requirements as $item)
														<li><i class="fa fa-circle"></i><p>{{$item}}</p></li>
														@endforeach
											
													</ul>
												</div>
											</div>
															        
										</div>
											@if(Auth::id() == $course->user_id)
											@if($course->material_id)
										<div class="tab-pane fade" id="course" role="tabpanel" aria-labelledby="review-tab">
											<div class="cs_row_three csv2">
												<div class="course_content">
													<div class="cc_headers">
														<h4 class="title">Class Content</h4>
														<ul class="course_schdule float-right">
															<li class="list-inline-item"><a href="#">{{count($material)}} downloadable content</a></li>
															<!-- <li class="list-inline-item"><a href="#">10:56:11</a></li> -->
														</ul>
													</div>
													<br>
													<div class="details">
													  	<div id="accordion" class="panel-group cc_tab">
														    <div class="panel">
														      	<!-- <div class="panel-heading">
															      	<h4 class="panel-title">
															        	<a href="#panelBodyCourseStart" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion">Getting Started</a>
															        </h4>
														      	</div> -->
															    <div id="panelBodyCourseStart" class="panel-collapse collapse show">
															        <div class="panel-body">
															        	
															        	<ul class="cs_list mb0">
															        		@foreach($material as $item )
															        		@php $a = App\Models\Studymaterial::find($item)  ; @endphp
															        		@if($a)
															        		<li><a href="{{asset('storage/material/'.$a->file)}}" download>{{$a->title}}<span class="cs_preiew">
															        		<span class="fa fa-download"></span></span></a></li>
															        		@endif
															        		@endforeach
															        		
															        	</ul>
															        </div>
															    </div>
														    </div>
														</div>
													</div>
													

												</div>
											</div>
										</div>
										@endif
										@endif
									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
							
			<div class="col-lg-4 col-xl-3">
			
                {{--  Check Course live Show Timer --}}
                    @if($course->status ==1)
						@if($course->class_status =='start')
							
							<div class="timer-wrapper">
								<div class="cd100"></div>
							</div>
						@endif	
					@endif
				{{--  End Check Course live Show Timer --}}
                <div class="instructor_pricing_widget csv2">
                @if($course->status ==1)
                    <div class="price">{!! $curr->html !!}</div>
                    @auth
                        {{--  User is Student/Another Teacher --}}
                        @if(Auth::user()->id != $course->user_id)
                            {{-- Check cClass is full  --}}
                            @if($course->type == 'Live')
                                @if($course->date<date('Y-m-d'))
                                    <button class="btn btn-danger">Date is passed</button>
                                @else

                                @if($stu_enrolled < $course->students)
                                    @if($curr->status==1)
                                        <a href="{{url('/cart/'.$course->slug)}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100"  >Enroll Now</a>
                                    @else
                                        <a href="{{url('/cart/'.$course->slug)}}"  class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100"  >Enroll Now</a>
                                    @endif
                                @else
                                    <a  class="btn btn-danger" >Class Is Full</a><br>
									<a href="{{url('courses?cat='.$course->category->slug)}}" style="color: #0368ff;">View More Similar Classes</a>
                            @endif
                        @endif
                            {{-- End Check cClass is full  --}}
					@else
                        @if($curr->status==1)
                            <a href="{{url('/cart/'.$course->slug)}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100">Enroll Now</a>
                        @else
                            <a href="{{url('/cart/'.$course->slug)}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100">Enroll Now</a>
                        @endif
                    @endif
                @else
                {{--  User is Teacher --}}
                    @if($course->type == 'Live')
                        @if($course->date<date('Y-m-d'))
                            	<button class="btn btn-danger" class="pointer-events: none;">Class Over</button>
                            	  
                        @else
                        {{-- Check 15 Min before class --}}
                        @if($course->class_status != 'end')
                            @if($start_ses)
                                @if($course->class_status == '')
                                    <a  class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" >In Porgress</a><br>
                                @endif
                                {{-- Vonage Api Url  --}}
                                @if($curr->status==1)
                                    <a href="{{url('/classroom/'.$course->slug)}}" @if(checkMObileDevice()) onclick="return confirm('Are you sure to open in mobile.?')"   @endif class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100" target="_blank" >Start Class</a>
                                @else
                                {{-- Zoom Api Url --}}
                                    <a href="{{url('/live/'.$course->slug)}}" @if(checkMObileDevice()) onclick="return confirm('Are you sure to open in mobile.?')"   @endif  class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100" target="_blank" >Start Class</a>
                                @endif
                         	   <a href="{{url('whiteboard')}}"class="btn btn-white_booard w-100 mt-3"  target="_blank">Open WhiteBoard</a>
                            @else
                                <a  class="btn btn-danger w-100" style="cursor: no-drop !important" title="Class can only be started 5 min prior to start time">Start Class</a>
                                
                        @endif
                            <a href="{{url('teacher/edit-course/'.$course->slug)}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100" >Edit Class</a>
                    @else
                        <a  class="btn btn-danger" >Class Over</a><br>
 						<a href="{{url('teacher/reschedule-course/'.$course->slug)}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100"  >Reschedule Class</a>
                    @endif
                @endif
            @endif
            {{-- End Date is Passed  --}}
        @endif
    	@else {{-- Auth Else--}}

						{{-- Check cClass is full  --}}
					
						@if($course->type == 'Live')
								@if($course->date<date('Y-m-d'))
									<button class="btn btn-danger">Date is passed</button>
								@else
										@if($stu_enrolled < $course->students)
										

												@if($curr->status==1)
													<a href="Javacript:void(0)" data-toggle="modal" data-target="#exampleModalCenter"class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-block mb-3 w-100" >Enroll Now</a>
												@else
												
													<a href="Javacript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-block mb-3 w-100" >Enroll Now</a>
												@endif

										@else

										<a  class="btn btn-danger" >Class Is Full</a><br>
										<a href="{{url('courses?cat='.$course->category->slug)}}" style="color: #0368ff;">View More Similar Classes</a>

										@endif
								@endif
						@else

					
										

												@if($curr->status==1)
													<a href="Javacript:void(0)" data-toggle="modal" data-target="#exampleModalCenter"class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-block mb-3 w-100"  >Enroll Now</a>
												@else
												
													<a href="Javacript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-block mb-3 w-100" >Enroll Now</a>
												@endif

										
						@endif
						{{-- End Check cClass is full  --}}

						@endauth

						
						
				@else
				<p class="btn btn-danger"> Class Cancelled</p>
				 <a href="{{url('teacher/reschedule-course/'.$course->slug)}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mt-3 w-100"  >Reschedule Class</a>
				@endif
					</div>
				
					<div class="feature_course_widget csv1">
						<ul class="list-group">
							<h4 class="title">Class Details</h4>
							{{-- <li class="d-flex justify-content-between align-items-center">
						    	Subject <span class="float-right">Computer Fundamentals</span>
							</li> --}}
							@php 	$timezone = timezone($course);
									
									$c_date = $timezone->date;
										$c_time = $timezone->time;
								 @endphp
							<li class="d-flex justify-content-between align-items-center">
						    	Students <span class="float-right">{{$stu_enrolled}}</span>
							</li>

							@if($course->type=='Live')
							<li class="d-flex justify-content-between align-items-center">
						    	Classroom Size <span class="float-right">{{$course->students}}</span>
							</li>
							<li class="d-flex justify-content-between align-items-center">
						    	Date <span class="float-right">
						    		{{$c_date}}</span>
						    	
							</li>
						
							<li class="d-flex justify-content-between align-items-center">
						    	Time <span class="float-right">{{$c_time}}</span>
							</li>
							@endif
						
				
						
							<li class="d-flex justify-content-between align-items-center">

						    	Duration <span class="float-right">{{$course->duration}}Hrs</span>
							</li>
							<li class="d-flex justify-content-between align-items-center">
						    	Language <span class="float-right">{{$course->language}}</span>
							</li>
						</ul>
					</div>
			
					<div class="blog_tag_widget csv1">
						<h4 class="title">Tags</h4>
						@php $tags = explode(',',$course->tags) ; @endphp
						<ul class="tag_list">
							@foreach($tags as $item)
							<li class="list-inline-item"><a href="#">{{$item}}</a></li>
							@endforeach
							
						</ul>
					</div>

							@auth
					@if(Auth::user()->id == $course->user_id && $course->status==1)
						 @if($course->class_status == 'start')
					 <div  style="text-align:center;margin-bottom:15px;">
					 	@if($course->price_type=='paid')
                    <a href="Javacript:void(0)" style="color: #0368ff;" class=" mb-3"  data-toggle="modal" data-target="#cancle_calss-1">Can't make it? Click here to cancel</a>
                    @else

                     <form action="{{url('teacher/cancel-course')}}" method="post" class="d-inline"> @csrf @method('post')
                                                                            <input type="hidden" name="id" value="{{$course->id}}">
                                                                            <button type ="submit" style="    color: #0368ff; border: none; background: none;cursor: pointer;"   onclick="return confirm('Are you sure to cancel this course?');">Can't make it? Click here to cancel</button>
                                                                        </form>
                    @endif
                    </div>
                    @endif
                    @endif
                    @endauth
				</div>
			</div>
			<div class="row">
				@if(count($teacher_course) >0)
					<div class="row">
						<div class="col-lg-12">
							<h3 class="r_course_title">Related Classes 	</h3>
						</div>
						@foreach($teacher_course as $c)
							@php
								$t = teacherDetail($c->user_id);
								$timezone = timezone($c);
								$c_date1 = $timezone->date;	
								$c_time1 = $timezone->time;
							@endphp
						
							<div class="col-lg-6 col-xl-4">
								<div class="top_courses">
										
										<a href="{{url('class/'.$c->slug)}}">
											<div class="thumb">
												@if($c->image)
													<img class="img-whp" src="{{asset('storage/course/'.$c->image)}}  " alt="t1.jpg')}}">
												@else
													<iframe width="420" height="315" src="{{$c->url}}"></iframe>
												@endif
												<div class="overlay">
													<div class="class-rec-type">
														<span class="class-live"><i class="fa fa-circle"></i>{{$c->type}}</span>
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
														
													<h5>{{$c->title}}</h5>
													<div class="date-n-time-holder">
														
														<p>{{$c_date1}}</p>
														<p class="time-display">{{$c_time1}} </p> 
													
													
													</div>
												</div>
												<div class="tc_footer">
													<ul class="tc_meta float-left">
														<li class="list-inline-item"><i class="flaticon-profile"> </i> {{studentEnrolled($c->id)}}</li>
													</ul>
													<div class="tc_price float-right">
													{!!userPriceText($c->id)!!}
													</div>
												</div>
											</div>
										</a>
									</div>
							</div>
						
						@endforeach			
					</div>
				@endif
			</div>
		</div>
	</section>

@endsection

@section('afterScript')


<script type="text/javascript" src="{{asset('front_assets/js/flipclock.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front_assets/js/countdowntime.js')}}"></script>


     <div class="modal cancel-class-modal" id="cancle_calss-1" tabindex="-1" role="dialog" aria-hidden="true" >
                                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                        <form action="{{url('teacher/cancel-course')}}" method="post"> 
                                                            @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure you want to cancel the class?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="{{$course->id}}">
                                                                <h4>Cancellation before 24 hours of scheduled class:</h4><hr>
																	<font color="red">10% </font> of the total earnings will be deducted as cancellation penalty. The amount will be deducted from your credit card which is connected to your account. For more information,<a href="{{url('/term-and-conditions')}}" class="text-primary"  target="_blank"> refer</a> to the T&C.This is not applicable if there are no enrolled students.<br><br>

																	<h4>Cancellation within 24 hours of scheduled class:</h4><hr>
																	<font color="red">15% </font> of the total earnings will be deducted as cancellation penalty. The amount will be deducted from your credit card which is connected to your account. For more information, <a href="{{url('/terms-and-conditions')}}"  target="_blank" class="text-primary">refer</a> to the T&C.This is not applicable if there are no enrolled students.
																	For more information, refer to<a  target="_blank" href="{{url('/cancellation-policy')}}" class="text-primary"> refund and cancellation policy</a>
																	</p>
                                                                <p>Do you want to proceed with the cancellation?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                                                <button type="submit" class="btn btn-danger btn-ok btn-primary-custom-round">Yes</button>
                                                               
                                                            </div>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>


<script>
console.log('{{session('timezone')}}');
let timezone  = '{{session('timezone')}}';
let cutoffString = '{{$course->date}}'; // in utc
let utcCutoff = moment.utc(cutoffString, 'YYYY-MM-DD HH:mm:ss');
let displayCutoff = utcCutoff.clone().tz(timezone);


var now =  moment(moment.utc().format('YYYY-MM-DD hh:mm:ssa Z'), "YYYY-MM-DD hh:mm:ssa Z");; //todays date
var end =  moment(displayCutoff.format('YYYY-MM-DD hh:mm:ssa Z'), "YYYY-MM-DD hh:mm:ssa Z");; //todays date // another date
var duration = moment.duration(end.diff(now));
var years = end.year();
var months = end.month()+1;
var days = end.date();
var hours = end.hour();
var minutes = end.minute();
var seconds = end.second();
console.log(end)
console.log(years,months,days,hours,minutes,seconds)
  

	@if($course->type == 'Live')
	let date = '{{$new_date}}';
	let res = date.split('-');
	let time = '{{$new_time}}';
	let res1 = time.split(':');
	

		

@endif


 let timeUp = false;
setInterval(() => {
    if (now.date() == end.date()) {
    	console.log('day')
        if (now.hour() == end.hour()) {
        		console.log('hour')
            if (now.minute() == end.minute() - 5) {
        				console.log('minute')
                if (now.second() == 0) {
        				console.log('second')
                    window.location.reload()
                }
            }
        }
    }
  
 

 now =  moment(moment.utc().format('YYYY-MM-DD hh:mm:ssa Z'), "YYYY-MM-DD hh:mm:ssa Z");



      if (now > end) {    
              let d =	$('.cd100').countdown100({
				
				endtimeYear: 0,
				endtimeMonth: 0,
				endtimeDate:0,
				endtimeHours: 0,
				endtimeMinutes:0,
				endtimeSeconds:0,
				timeZone: "{{session('timezone')}}" 
			
			});
    
            }else {    
    
		let d =	$('.cd100').countdown100({
				
				endtimeYear:years,
				endtimeMonth:months,
				endtimeDate:days,
				endtimeHours: hours,
				endtimeMinutes:minutes,
				endtimeSeconds:seconds,
			
			
			});
            } 

}, 1000)


	
     



	
		</script>
@endsection