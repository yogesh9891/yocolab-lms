@extends('layouts.app')
@section('title','Yocolab')
@section('content')
@section('before_body')
<link rel="stylesheet" type="text/css" href="{{asset('front_assets/js/bootstrap-clockpicker.min.css')}}">
@endsection
@php 
$rating =0;
$rating = App\Models\Feedback::where('teacher_id',$teacher->user_id)->avg('star');
$total_rating = App\Models\Feedback::where('teacher_id',$teacher->user_id)->count();
$rating = ceil($rating);

@endphp
<section class="inner_page_breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 offset-xl-3 text-center">
				<div class="breadcrumb_content">
					<h4 class="breadcrumb_title">{{$teacher->user->name}}</h4>
					@if($rating > 0)
					<p class="color-star">
						 @for($i=1;$i<=$rating;$i++)   
						<i class="fa fa-star"></i>
						@endfor
						
					</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Our Team Members -->
<section class="our-team">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="instructor_personal_infor">
					<div class="instructor_thumb text-center">
						@if($teacher->image)
						<img class="img-fluid" src="{{asset('storage/teacher/'.$teacher->image)}}" alt="3.png" width="100">
						@else
						<img class="img-fluid" src="images/team/3.png" alt="3.png">
						@endif
						@if($teacher->self == 1)
						<a  href= "{{url('/teacher/edit')}}" class="follow-unfollow-link follow btn-sm" ><i class="fa fa-pencil"></i> Edit</a>
						@else
						@auth
						@if($follow)
						<a class="follow-unfollow-link follow tntm-sm" href="{{url('user/follow-teacher/unfollow/'.str_slug($teacher->user->name).'/'.$teacher->teacher_id)}}"   ><i class="fa fa-minus"></i> Unfollow</a>
						@else
						<a class="follow-unfollow-link follow tntm-sm" href="{{url('user/follow-teacher/follow/'.str_slug($teacher->user->name).'/'.$teacher->teacher_id)}}"   ><i class="fa fa-plus"></i> Follow</a>
						@endif
						@endauth
						@guest
						<a class="follow-unfollow-link follow btn-sm" href="Javacript:void(0)" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i> Follow</a>
						@endguest
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-8 col-xl-9">
				<div class="row">
					<div class="col-lg-12">
						  @if(Session::has('success'))
						                            	<div class="alert alert-success">
														    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
														    <div class="icon hidden-xs">
														      <i class="fa fa-check"></i>
														    </div>
														    <strong>Congratulations!</strong>
														    <Br /> {{Session::get('success')}}
														  </div>
                						    @endif

                				@if ($errors->any())
									 <div class="alert alert-danger">
															    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
															    <div class="icon hidden-xs">
															      <i class="fa fa-ban"></i>
															    </div>
															    <strong>Error</strong>
															    <ul>
															      @foreach ($errors->all() as $error)
														                <li>{{ $error }}</li>
														            @endforeach
															   </ul>
															  </div>
								   
								@endif
						<div class="instructor_personal_infor">
							{{-- <h4>Hello! This is my story.</h4>
							<p>Hello! I am a Seattle/Tacoma, Washington area graphic designer with over 6 years of graphic design experience. I specialize in designing infographics, icons, brochures, and flyers.</p>
							<ul class="instructor_estimate">
								<li>Included in my estimate:</li>
								<li>Custom illustrations</li>
								<li>Stock images</li>
								<li>Any final files you need</li>
							</ul> --}}
							<p>{!! $teacher->about !!}</p>

						</div>
					</div>

					<div class="col-md-12 col-12">
						<div class="profile-new-box">
							<div class="row mt-4">
								<div class="col-12 col-md-4">
									<div class="boxes">
										<div class="icon-box">
											<i class="icon-user"></i>
										</div>
										<div class="co-text">
											<h3>{{$followers}}</h3>
											<h2>Total Followers</h2>
										</div>
									</div>
								</div>

								<div class="col-12 col-md-4">
									<div class="boxes">
										<div class="icon-box">
											<i class="icon-students"></i>
										</div>
										<div class="co-text">
											<h3>{{$students}}</h3>
											<h2>Total Students</h2>
										</div>
									</div>
								</div>

								<div class="col-12 col-md-4">
									<div class="boxes">
										<div class="icon-box">
											<i class="icon-presentation"></i>
										</div>
										<div class="co-text">
											<h3>{{count($teacher->course)}}</h3>
											<h2>Classes</h2>
										</div>
									</div>
								</div>

								<div class="col-12 col-md-4">
									<div class="boxes">
										<div class="icon-box">
											<i class="icon-review"></i>
										</div>
										<div class="co-text">
											<h3>{{$total_rating}}</h3>
											<h2>Reviews</h2>
										</div>
									</div>
								</div>

								<div class="col-12 col-md-4">
									<div class="boxes">
										<div class="icon-box">
											<i class="icon-language"></i>
										</div>
										<div class="co-text">
											<h3>{{$teacher->language}}</h3>
											<h2>Language</h2>
										</div>
									</div>
								</div>

								<div class="col-12 col-md-4">
									<div class="boxes">
										<div class="icon-box">
											<i class="icon-germany"></i>
										</div>
										<div class="co-text">
											<h3>{{$teacher->country}}</h3>
											<h2>Country</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-lg-4 col-xl-3">
				@if($teacher->self ==0)
                  <a href="Javacript:void(0)" class="btn btn-primary-custom btn-primary-custom-round  my-3 w-100"  data-toggle="modal" data-target="#request_class">Request a class</a>
                  @endif

				<div class="selected_filter_widget style2 mb30">
					<div class="siderbar_contact_widget">
						<h4>Profile </h4>
						<p>My Expertise</p>
						<i>{{$teacher->expert}}</i>
						<p>Qualification</p>
						<i>{{$teacher->qualification}}</i>
						<p>Experience</p>
						<i>{{$teacher->experience}}</i>
						@if($teacher->currency && $teacher->price)
							<p>Average Class Price</p>
							
						<i>{{ my_currency_convert($teacher->currency,$teacher->price)}}</i>
						@endif
						{{-- <i></i>
						<p>Skype</p>
						<i>alitfn</i>
						<p>Social Media</p>
						<ul class="scw_social_icon mb0">
							<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
						</ul> --}}
					</div>
				</div>
				{{-- <div class="selected_filter_widget style2">
					<div class="siderbar_contact_widget">
						<p>Total Followers</p>
						<i>{{$followers}}</i>
						<p>Total Students</p>
						<i>{{$students}}</i>
						<p>Classes</p>
						<i>{{count($teacher->course)}}</i>
						<p>Reviews</p>
						<i>{{$total_rating}}</i>
						<p>Language</p>
						<i>{{$teacher->language}}</i>
						<p>Country</p>
						<i>{{$teacher->country}}</i>
					</div>
				</div> --}}
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-12">
				
			
					@if(count($courses) > 0)
					<div class="col-lg-12">
						<h3 class="r_course_title">Related Classes</h3>
					</div>
			<div class="related-course-slider">
					@foreach($courses as $course)
					@php 

					$time2 = date('H:i',  strtotime($course->time) + $course->duration*3600);
													
					$date=date_create($course->date);
					$date =date_format($date,"Y-m-d");
					$dat = new DateTime($date.' '.$time2);
				
					$t = teacherDetail($course->user_id);

												
					$timezone = timezone($course);
														
					$c_date = $timezone->date;	
					$c_time = $timezone->time;
						

					@endphp
					{{-- <div class="row"> --}}
					{{-- <div class="col-md-6 col-lg-4  "> --}}
					
						@if(new DateTime('now') <= $dat )
						<div class="top_courses">
							<a href="{{url('class/'.$course->slug)}}"	>
								<div class="thumb">
									@if($course->image)
									<img class="img-whp" src="{{secure_asset('storage/course/'.$course->image)}}" alt="t1.jpg')}}">
									@else
									<iframe width="420" height="315"
									src="{{$course->url}}">
									</iframe>
									@endif
									<div class="overlay">
										
										<div class="class-rec-type">
											<span class="class-live">
												<i class="fa fa-circle"></i>{{$course->type}}
											</span>
											
										</div>
										
									</div>
								</div>
							</a>
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
									<h5><a href="{{url('class/'.$course->slug)}}"	>{{$course->title}}</a></h5>
									<div class="date-n-time-holder">
										
										<p>{{$c_date}}</p>
										<p class="time-display">{{$c_time}} </p>
								
									</div>
									
									{{-- 	<ul class="tc_review">
										<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
										<li class="list-inline-item"><a href="#">(})</a></li>
									</ul> --}}
								</div>
								<div class="tc_footer">
									<ul class="tc_meta float-left">
										{{-- <li class="list-inline-item"><a href="#"><i class="flaticon-profile"></i></a></li> --}}
										<li class="list-inline-item"><i class="flaticon-profile"> </i> {{studentEnrolled($course->id)}}</li>
										
									</ul>
									<div class="tc_price float-right">
											{!! userPriceText($course->id) !!}
									</div>
								</div>
							</div>
						</div>
						@else 
						
						@endif
						
					@endforeach
					</div>
					@endif
					</div>
				</div>
			{{-- </div>
		</div> --}}
	</div>
</section>

<div class="modal fade" id="request_class" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{url('request-class')}}" method="post" enctype="multipart/form-data"> 
                                                            @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header flex-wrap">
                                                            	<div>
                                                            		
                                                                <h4 >Request a Class for {{$teacher->user->name}} </h4>
                                                                @if($teacher->currency && $teacher->price)<h5>Average Class Price :- {{ my_currency_convert($teacher->currency,$teacher->price)}} </h5>@endif
                                                            	</div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                            	
                                                                <div class="row">
                                                                	<div class="col-md-6 form-group">
                                                                		<label>Name</label>
                                                                		<input type="text" name="name" class="form-control" required="">
                                                                		<input type="hidden" name="teacher_id"  value="{{$teacher->teacher_id}}">
                                                                	</div>
                                                                	<div class="col-md-6 form-group">
                                                                		<label>Email</label>


                                                                		<input type="eamil" name="email" class="form-control" required="">
                                                                	</div>
                                                            	<div class="col-md-6 form-group">
                                                                		<label>Prefered class date</label>
                                                                		<input type="text" data-toggle="datepicker" name="date" class="form-control" required="">
                                                                	</div>
                                                                	<div class="col-md-6 form-group duration-time-holder clockpicker">
                                                                		<label> Prefered class time</label>


                                                                		<input type="text" class="form-control" name="time" required="">
                                                                	</div>

                                                                <div class="col-md-12 form-group">
                                                                		<label>What do you want to learn?</label>
                                                            		<textarea rows="5" class="form-control" name="description"> </textarea>
                                                            	</div>
                                                                </div>
                                                            </div>
                                                               <div class="col-md-12 form-group">
                                                               	<p>
                                                               		Please follow the instructor to get notified about this class in future.<br>
                                                               		@auth
                                                               		@if($teacher->self != 1)
																		@if($follow)
																		<a class="btn btn-primary-custom btn-primary-custom-round" href="{{url('user/follow-teacher/unfollow/'.str_slug($teacher->user->name).'/'.$teacher->teacher_id)}}"   > Unfollow</a>
																		@else
																		<a class="btn btn-primary-custom btn-primary-custom-round" href="{{url('user/follow-teacher/follow/'.str_slug($teacher->user->name).'/'.$teacher->teacher_id)}}"   > Follow</a>
																		@endif
																	@endif
																	@else
																		<a class="btn btn-primary-custom btn-primary-custom-round" href="Javacript:void(0)" data-toggle="modal" data-target="#exampleModalCenter"> Follow</a>
																	@endauth
                                                               	</p>
                                                               </div>
                                                            <div class="modal-footer">
                                                              
                                                                <button type="submit" class="btn btn-primary-custom btn-primary-custom-round">Submit</button>
                                                               
                                                            </div>
                                                        </div>
                                                    </form>
  </div>
</div>

@endsection
@section('afterScript')
<script type="text/javascript" src="{{asset('front_assets/js/bootstrap-clockpicker.min.js')}}"></script>
<script type="text/javascript">
	$('.timepicker').wickedpicker();
	$('[data-toggle="datepicker"]').datepicker({
	      minDate:0,
	      dateFormat: 'dd/mm/yy' ,
	  // autoPick:true,
	});
$('.clockpicker').clockpicker({ autoclose: true, 'default': 'now'})
	.find('input').change(function(){
		console.log(this.value);
	});

</script>
@endsection
