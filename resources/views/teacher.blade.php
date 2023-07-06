@extends('layouts.app')
@section('title','Yocolab')
@section('content')
@section('before_body')
<link rel="stylesheet" type="text/css" href="{{asset('front_assets/js/bootstrap-clockpicker.min.css')}}">
@endsection


	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Instructors</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Instructors</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Courses List -->
	<section class="courses-list pb40">
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-xl-3">

					<div class="selected_filter_widget style3">
					  	<div id="accordion" class="panel-group">
						    <div class="panel">
						      	<div class="panel-heading">
						      			
							      	<h4 class="panel-title">
							        	<a href="#panelBodyAuthors" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Category</a>
							        </h4>
						      	</div>
						      	
							    <div id="panelBodyAuthors" class="panel-collapse collapse show">
							        <div class="panel-body">
										<div class="cl_skill_checkbox">
											<div class=" ui_kit_checkbox " style="overflow: hidden auto !important;max-height: 200px;">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input get_category_all" id="customCheckall" value="all"  @if(app('request')->input('cat') || app('request')->input('sub')) @else checked="" @endif>
													<label class="custom-control-label" for="customCheckall">All {{-- <span class="float-right">({{count($data)}})</span> --}}</label>
												</div>
												@foreach($category as  $item)
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input get_category_course" id="customCheck{{$item->id}}" value="{{$item->id}}" @if($item->slug == app('request')->input('cat')) checked=""    @endif>
													<label class="custom-control-label" for="customCheck{{$item->id}}">{{$item->name}} {{-- <span class="float-right">({{count($item->courses)}})</span> --}}</label>
												</div>
												@endforeach
												
											</div>
										</div>
							        </div>
							    </div>
						    </div>
						</div>
					</div>
				
				
				<div class="selected_filter_widget style3 mb30">
					  	<div id="accordion" class="panel-group">
						    <div class="panel">
						      	<div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a href="#panelBodySkills" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Country</a>
							        </h4>
						      	</div>
							    <div id="panelBodySkills" class="panel-collapse collapse show">
							        <div class="panel-body">
										<div class="ui_kit_checkbox" style="overflow: hidden auto !important;max-height: 200px;">
											@foreach($country as $key => $item)
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_country" id="customCheck000{{$key}}" value="{{$item->value}}">
												<label class="custom-control-label" for="customCheck000{{$key}}">{{$item->name}}</label>
											</div>
											@endforeach
											
										</div>
							        </div>
							    </div>
						    </div>
						</div>
					</div>

				
						<div class="selected_filter_widget style3 mb30">
					  	 <div id="accordion" class="panel-group">
						    <div class="panel">
						      	<div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a href="#panelBodyExperience" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Experience</a>
							        </h4>
						      	</div>
							    <div id="panelBodyExperience" class="panel-collapse collapse show">
							        <div class="panel-body">
							       
										<div class="ui_kit_checkbox"  style="overflow: hidden auto !important;max-height: 200px;">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience1" value="1+ Years">
												<label class="custom-control-label" for="customExperience1">1+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience2" value="2+ Years">
												<label class="custom-control-label" for="customExperience2">2+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience3" value="3+ Years">
												<label class="custom-control-label" for="customExperience3">3+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience4" value="4+ Years">
												<label class="custom-control-label" for="customExperience4">4+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience5" value="5+ Years">
												<label class="custom-control-label" for="customExperience5">5+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience6" value="6+ Years">
												<label class="custom-control-label" for="customExperience6">6+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience7" value="7+ Years">
												<label class="custom-control-label" for="customExperience7">7+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience8" value="8+ Years">
												<label class="custom-control-label" for="customExperience8">8+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience9" value="9+ Years">
												<label class="custom-control-label" for="customExperience9">9+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience10" value="10+ Years">
												<label class="custom-control-label" for="customExperience10">10+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience11" value="11+ Years">
												<label class="custom-control-label" for="customExperience11">11+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience12" value="12+ Years">
												<label class="custom-control-label" for="customExperience12">12+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience13" value="13+ Years">
												<label class="custom-control-label" for="customExperience13">13+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience14" value="14+ Years">
												<label class="custom-control-label" for="customExperience14">14+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience15" value="15+ Years">
												<label class="custom-control-label" for="customExperience15">15+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience16" value="16+ Years">
												<label class="custom-control-label" for="customExperience16">16+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience17" value="17+ Years">
												<label class="custom-control-label" for="customExperience17">17+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience18" value="18+ Years">
												<label class="custom-control-label" for="customExperience18">18+ Years </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience19" value="19+ Years">
												<label class="custom-control-label" for="customExperience19">19+ Years </label>
											</div><div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_experience" id="customExperience20" value="20+ Years">
												<label class="custom-control-label" for="customExperience20">20+ Years </label>
											</div>
											
										</div>
									
							        </div>
							    </div>
						    </div>
						</div>
					</div>
					<div class="selected_filter_widget style3 mb30">
					  	<div id="accordion" class="panel-group">
						    <div class="panel">
						      	<div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a href="#panelBodySkills" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Language</a>
							        </h4>
						      	</div>
							     <div id="panelBodySkills" class="panel-collapse collapse show">
							        <div class="panel-body">
										<div class="ui_kit_checkbox" style="overflow: hidden auto !important;max-height: 200px;">
											
										@foreach($language as $key => $value)
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customLanguage{{$key}}" value="{{$value->value}}">
												<label class="custom-control-label" for="customLanguage{{$key}}">{{$value->name}}</label>
											</div>
										@endforeach
										
										</div>
							        </div>
							    </div>
						    </div>
						</div>
					</div>
					<div class="selected_filter_widget p30 bgc-thm">
						<!-- <span class="float-left"><img class="mr20" src="{{asset('front_assets/images/resource/3.png')}}" alt="3.png"></span> -->
						<!-- <h4 class="mt15 fz20 fw500 color-white">Not sure?</h4> -->
						<br>
						<p class="color-white">Enjoy classes from our varied instructors on multiple topics. Find all your favorite topics and enhance your skill sets. </p>
					</div>
				</div>
				<div class="col-md-12 col-lg-8 col-xl-9 shadow_box" id="res_instructor">
					  @if(Session::has('success'))
						                            <div class="alert alert-success">
						                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						                                                <strong>{{ Session::get('success') }}</strong>
						                            </div>
                						    @endif
					<div class="row courses_list_heading">
						<div class="col-xl-4 p0">
							<div class="instructor_search_result style2">
								<p class="mt10 fz15"><span class="color-dark pr10"> </span>  <span class="color-dark pr10"></span>All Instructors</p>
							</div>
						</div>
						<div class="col-xl-8 p0">
							<div class="candidate_revew_select style2 text-right" >
								<ul class="mb0">
							{{-- 		<li class="list-inline-item">
										<select class="form-control " onchange="fetchType(this)" id="get_type">
											<option value="all">All</option>
											<option value="Live">Live</option>
											<option value="Recorded">Recorded</option>
										</select>
									</li> --}}
									<li class="list-inline-item">
										<div class="candidate_revew_search_box course fn-520">
											<form class="form-inline my-2 my-lg-0" action="{{url('/courses')}}">
										    	<input class="form-control mr-sm-2" type="search" placeholder="Search all instructors" aria-label="Search"  name="q" value="{{ app('request')->input('q') }}">
										    	<button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
										    </form>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					@if(count($data) > 0 )
					<div class="row courses_container">

					
						@foreach( $data as $teacher )
						@php  $teach_det = teacherDetail($teacher->user_id); @endphp
					
						<div class="col-lg-12 p0">
							<div class="courses_list_content">
									<a href="{{url('profile/'.str_slug($teach_det->user?$teach_det->user->name:'').'/'.$teacher->teacher_id)}}">
									<div class="top_courses list">
									<div class="thumb">
										{{-- @auth
															@if(!$my_course)
															<a class="whishlist-link" href="#!" id="addToCart" data-id="{{$course->id}}"></a>
															@endif
														@else
															<a class="whishlist-link" href="#!" data-toggle="modal" data-target="#exampleModalCenter"></a>
														@endauth --}}
										{{-- <a href="{{url('course/'.$course->id)}}" class="img-container"> --}}
															<img class="img-whp" src="{{asset('storage/teacher/'.$teacher->image)}}"  style="width: 320px !important" alt="t1.jpg">
														{{-- </a> --}}
										<div class="overlay">
											
											{{-- <span class="tc_preview_course" >Preview Course</span> --}}
										</div>
									</div>
									<div class="details">
										<div class="tc_content">
											<h5 style="min-height: 20px;">{{$teach_det->user?$teach_det->user->name:""}} {{-- <span class="tag">Best Seller</span> --}}</h5>
												
												@if($teach_det->rating > 0)
																<ul class="tc_review">
																	@for($i=1;$i<=$teach_det->rating;$i++)
																	<li class="list-inline-item">
																		<span>
																			<i class="fa fa-star"></i>
																		</span>
																	</li>
																	@endfor
																
																	<li class="list-inline-item">
																		{{-- <a href="#"> --}}
																		({{$teach_det->rating}})
																		{{-- </a> --}}
																	</li>
																</ul>
																@endif
												
											
											<p><b>{{$teacher->expert}} , {{$teacher->experience}} Experience</b></p>
											
												
											<p>{{substr($teacher->about,0,150).".."}}</p>
										</div>
										<div class="tc_footer">
												<ul class="tc_meta float-left fn-414">
																	<li class="list-inline-item">
																		{{-- <a href="#"> --}}
																			<i class="fa fa-list"></i>
																		{{-- </a> --}}
																	</li>
																	<li class="list-inline-item">
																		{{-- <a href="#"> --}}
																			{{$teacher->category->name}}
																		{{-- </a> --}}
																	</li>
																	<li class="list-inline-item">
																		<i class="flaticon-global"></i> 
																		{{-- <a href="#"> --}}
																			{{$teacher->language}},
																			{{$teacher->country}}
																		{{-- </a>  --}}
																	</li>
																		
															{{-- 		<li class="list-inline-item"><i class="flaticon-calendar-1">	</i>
																	
																	</li> --}}
																
															</ul>
												<div class="tc_price float-right fn-414">
															<a href="#!" class="btn btn-primary-custom btn-primary-custom-round "  onclick="requestClass(this)" data-id="{{$teacher->teacher_id}}" data-name="{{$teach_det->user->name}}"  data-price="{{$teacher->currency&&$teacher->price?'Average Class price :- '.my_currency_convert($teacher->currency,$teacher->price):''}}">Request Class</a>
											
												</div>
									
										</div>
									</div>
								</div>
							</div>
						</a>
					
					

						{{-- {{$data->links()}} --}}
						</div>
						@endforeach
					{!! $data->links('vendor.pagination.bootstrap-4') !!}
						
					</div>
					@else
					{{-- <h3 class="p-5 m-5"><font color="red">No Courses Found</font></h3> --}}
					<div class="candidate_revew_search_box course no-result-found">
						<form class="form-inline my-2 my-lg-0" action="{{url('/prefrence')}}" method="post">
							<h3> We observed there are no suitable classes @if(app('request')->input('q')) for {{ app('request')->input('q') }} @endif </h3>
							<p>We will be happy to look for @if(app('request')->input('q'))  {{ app('request')->input('q') }} @endif classes. Click submit and we will find a class for you at our earliest.</p>
							@csrf
							<div class="d-flex mt-2 w-50">
								<input class="form-control mr-sm-2 course-input" type="search" placeholder="" aria-label="Search"  name="q" value="{{ app('request')->input('q') }}">
					    		<button class="btn btn-primary-custom" type="submit" style="background-color: #fd6003">Submit</button>	
							</div>
					    	
					    </form>
					  {{--   <div class="img-shape">
					    	<img src="{{asset('front_assets/images/cant2.png')}}" class="img-fluid" alt="">
					    </div> --}}
					</div>
				    
				    <h3 class="mt-4 mb-5 text-center">View All Our Classes</h3>
					
					
					<div class="row courses_container">
						@foreach( $all_teacher->take(7) as $teacher )
						@php  $teach_det = teacherDetail($teacher->user_id); @endphp
					
						<div class="col-lg-12 p0">
							<div class="courses_list_content">
									<a href="{{url('teacher/'.str_slug($teach_det->user?$teach_det->user->name:'').'/'.$teacher->teacher_id)}}">
									<div class="top_courses list">
									<div class="thumb">
										{{-- @auth
															@if(!$my_course)
															<a class="whishlist-link" href="#!" id="addToCart" data-id="{{$course->id}}"></a>
															@endif
														@else
															<a class="whishlist-link" href="#!" data-toggle="modal" data-target="#exampleModalCenter"></a>
														@endauth --}}
										{{-- <a href="{{url('course/'.$course->id)}}" class="img-container"> --}}
															<img class="img-whp" src="{{asset('storage/tacher/'.$teacher->image)}}"  style="width: 320px !important" alt="t1.jpg">
														{{-- </a> --}}
										<div class="overlay">
											
											{{-- <span class="tc_preview_course" >Preview Course</span> --}}
										</div>
									</div>>
									<div class="details">
										<div class="tc_content">
											<p>{{$teacher->experience}} Experience
												@if($teach_det->rating > 0)
																<ul class="tc_review">
																	@for($i=1;$i<=$teach_det->rating;$i++)
																	<li class="list-inline-item">
																		<span>
																			<i class="fa fa-star"></i>
																		</span>
																	</li>
																	@endfor
																
																	<li class="list-inline-item">
																		{{-- <a href="#"> --}}
																		({{$teach_det->rating}})
																		{{-- </a> --}}
																	</li>
																</ul>
																@endif
												</p>
											{{-- 	<div class="tc_price float-right fn-414">
												<h5><span class="class-live">
													<i class="fa fa-circle" ></i>  {{$course->type}}
												</span></h5>
												
											</div> --}}
											<h5>{{$teach_det->user?$teach_det->user->name:""}} {{-- <span class="tag">Best Seller</span> --}}</h5>
											@if($teacher->category) <p>{{$teacher->category->name}}</p> @endif
											<p>{{substr($teacher->about,0,150).".."}}</p>
										</div>
										<div class="tc_footer">
												<ul class="tc_meta float-left fn-414">
																	<li class="list-inline-item">
																		{{-- <a href="#"> --}}
																			<i class="flaticon-profile"></i>
																		{{-- </a> --}}
																	</li>
																	<li class="list-inline-item">
																		{{-- <a href="#"> --}}
																			{{$teacher->expert}}
																		{{-- </a> --}}
																	</li>
																	<li class="list-inline-item">
																		<i class="flaticon-clock"></i> 
																		{{-- <a href="#"> --}}
																			{{$teacher->qualification}}
																		{{-- </a>  --}}
																	</li>
																		
																	<li class="list-inline-item"><i class="flaticon-calendar-1">	</i>
																		{{-- <a href="#"> --}}
																			{{$teacher->country}}
																		{{-- </a> --}}
																	</li>
																
															</ul>
												<div class="tc_price float-right fn-414">
													@if(auth()->user()->id == $teacher->user_id)
													@else
															<a href="#!" class="btn btn-primary-custom btn-primary-custom-round " onclick="requestClass(this)" data-id="{{$teacher->teacher_id}}" data-name="{{$teach_det->user?$teach_det->user->name:""}}"  data-price="{{$teacher->currency&&$teacher->price?my_currency_convert($teacher->currency,$teacher->price):''}}">Request Class</a>
													@endif
												</div>
									
										</div>
									</div>
								</div>
							</div>
						</a>
						</div>
						@endforeach

						{{-- {{$all_courses->links()}} --}}
						</div>

						@endif
				</div>
			</div>
		</div>
	</section>

	

@endsection
@section('afterScript')

<div class="loader"><img src="{{ asset('front_assets/images/load.gif') }}" alt=""></div>


<div class="modal fade" id="request_class" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{url('request-class')}}" method="post" enctype="multipart/form-data"> 
                                                            @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header flex-wrap">
                                                            	<div>
                                                                <h4 >Request a Class for <span id="teacher_name"></span></h4>
                                                                <h5 > <span id="teacher_price"></span></h5>
                                                            		

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
                                                                		<input type="hidden" name="teacher_id"  id="teacher_id">
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
                                                               	<p id="follow_html">
                                                               		Please follow the instructor to get notified about this class in future.<br>
                                                               		
                                                               	
                                                               	</p>
                                                               </div>
                                                            <div class="modal-footer">
                                                              
                                                                <button type="submit" class="btn btn-primary-custom btn-primary-custom-round">Submit</button>
                                                               
                                                            </div>
                                                        </div>
                                                    </form>
  </div>
</div>


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



	function requestClass(e) {
	let teacher_id = $(e).attr('data-id');
	let teacher_name = $(e).attr('data-name');
	let teacher_price = $(e).attr('data-price');

	$('#teacher_price').text(teacher_price)
console.log(e);
	$('#teacher_name').text(teacher_name)
	if(teacher_price){

	}
	$('#teacher_id').val(teacher_id)

      $.ajax({
        type  : 'get',
         url   : '/get-follow_html/'+teacher_id,
         success:function(res){
         if(res.success){
           	 $('#follow_html').html(res.html);
              }
                    }
                });
		$('#request_class').modal('show');
	}
    $(document).ready(function(){


    
    // Hover states on the static widgets
	
		// iNLINE dATEPICKER FOR fILTER sECTION eND

     // $( "#datepicker" ).datepicker();
    	   let total_category = [];
    	   let total_level = [];

    	            //Get All Products By Category Wise
        $('.get_category_course .get_category_all').on('click',function(){
            let cat_id = $(this).val();

            // let price = $('.get_category_price:checked').val();


                  $('input.get_category_all').not(this).prop('checked', false);
            let category = []
					$(".get_category_course:checked").each(function ()
					{
					    category.push(parseInt($(this).val()));
					});
               
        	 let language = [];
					$(".get_language:checked").each(function ()
					{
					    language.push($(this).val());
					});

			 let country = [];
					$(".get_country:checked").each(function ()
					{
					    country.push($(this).val());
					});

			let experience = [];
					$(".get_experience:checked").each(function ()
					{
					    experience.push($(this).val());
					});

			 // let type = $('#get_type').val();

       
            let chk = $(this).prop("checked");
         $('.loader').show();
         
                $.ajax({
                    type  : 'post',
                    url   : '/get-instructor',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                      data  : {cat_id :category,chk:1,language:language,experience:experience,country:country},
                    success:function(res){
                        if(res.success){
                            $('#res_instructor').html(res.teacher);
                       
                        }
                    }
                });
        
           
        });

          	

          $('.get_country').on('click',function(){
          	   let chk = $(this).prop("checked");
          	      $('input.get_category_all').not(this).prop('checked', false);
            let category = []
					$(".get_category_course:checked").each(function ()
					{
					    category.push(parseInt($(this).val()));
					});
               
        	 let language = [];
					$(".get_language:checked").each(function ()
					{
					    language.push($(this).val());
					});

			 let country = [];
					$(".get_country:checked").each(function ()
					{
					    country.push($(this).val());
					});

			let experience = [];
					$(".get_experience:checked").each(function ()
					{
					    experience.push($(this).val());
					});
         
         $('.loader').show();
          
                  $.ajax({
                    type  : 'post',
                    url   : '/get-instructor',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                      data  : {cat_id :category,chk:1,language:language,experience:experience,country:country},
                    success:function(res){
                        if(res.success){
                            $('#res_instructor').html(res.teacher);
                       
                        }
                    }
                });
        
           
        });

$('.get_experience').on('click',function(){

              $('input.get_category_all').not(this).prop('checked', false);
            let category = []
					$(".get_category_course:checked").each(function ()
					{
					    category.push(parseInt($(this).val()));
					});
               
        	 let language = [];
					$(".get_language:checked").each(function ()
					{
					    language.push($(this).val());
					});

			 let country = [];
					$(".get_country:checked").each(function ()
					{
					    country.push($(this).val());
					});

			let experience = [];
					$(".get_experience:checked").each(function ()
					{
					    experience.push($(this).val());
					});
       
            let chk = $(this).prop("checked");
         $('.loader').show();
           // $('input.get_category_price').not(this).prop('checked', false);
                  $.ajax({
                    type  : 'post',
                    url   : '/get-instructor',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                      data  : {cat_id :category,chk:1,language:language,experience:experience,country:country},
                    success:function(res){
                        if(res.success){
                            $('#res_instructor').html(res.teacher);
                       
                        }
                    }
                });
        
           
 });

 

$('.get_language').on('click',function(){

             $('input.get_category_all').not(this).prop('checked', false);
            let category = []
					$(".get_category_course:checked").each(function ()
					{
					    category.push(parseInt($(this).val()));
					});
               
        	 let language = [];
					$(".get_language:checked").each(function ()
					{
					    language.push($(this).val());
					});

			 let country = [];
					$(".get_country:checked").each(function ()
					{
					    country.push($(this).val());
					});

			let experience = [];
					$(".get_experience:checked").each(function ()
					{
					    experience.push($(this).val());
					});
       
            let chk = $(this).prop("checked");
         $('.loader').show();
           // $('input.get_category_price').not(this).prop('checked', false);
                  $.ajax({
                    type  : 'post',
                    url   : '/get-instructor',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                      data  : {cat_id :category,chk:1,language:language,experience:experience,country:country},
                    success:function(res){
                        if(res.success){
                            $('#res_instructor').html(res.teacher);
                       
                        }
                    }
                });
 });
        });


function filter (){


            let price = $('.get_category_price:checked').val();
 			
 			let type = $('#get_type').val();
               
            let category = [];
					$(".get_category_course:checked").each(function ()
					{
					    category.push(parseInt($(this).val()));
					});
			 let level = [];
					$(".get_category_level:checked").each(function ()
					{
					    level.push($(this).val());
					});

			 let language = [];
					$(".get_language:checked").each(function ()
					{
					    language.push($(this).val());
					});

			 let subcategory = []
					$(".get_subcategory_course:checked").each(function ()
					{
					    subcategory.push(parseInt($(this).val()));
					});

					if(subcategory.length > 0){
						category = subcategory;
					}
       
            let chk = $(this).prop("checked");
         $('.loader').show();
           // $('input.get_category_price').not(this).prop('checked', false);
                $.ajax({
                    type  : 'post',
                    url   : '/get-instructor',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                      data  : {cat_id :category,chk:1,language:language,experience:experience,country:country},
                    success:function(res){
                        if(res.success){
                            $('#res_instructor').html(res.teacher);
                       
                        }
                    }
                });
        

}

   </script>
@endsection