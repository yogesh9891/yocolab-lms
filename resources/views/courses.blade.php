@extends('layouts.app')
@section('title','Yocolab')
@section('content')



	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Classes</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Classes</li>
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

				<div class="col-lg-4 col-xl-3 courses-list-left">


					
				
                 	<div id="datepicker"></div>
               

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
							        	<a href="#panelBodyAuthors" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Sub Category</a>
							        </h4>
						      	</div>
							    <div id="panelBodyCategory" class="panel-collapse collapse show">
							        <div class="panel-body">
										<div class="ui_kit_checkbox" >
												<div  id="res_subcategory" style="overflow: hidden auto !important;max-height: 200px;">
										@foreach($subcategory as  $item)
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input get_subcategory_course " onclick="fetchSubcategory(this)" id="customCheck{{$item->id}}" value="{{$item->id}}" @if($item->slug == app('request')->input('sub')) checked=""    @endif>


													
													<label class="custom-control-label" for="customCheck{{$item->id}}">{{$item->name}} </label>
												</div>
												
												@endforeach
											</div>
										</div>
							        </div>
							    </div>
						    </div>
						</div>
					</div>
					{{--<div class="selected_filter_widget style3">
							<div id="accordion" class="panel-group">
								<div class="panel">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a href="#panelBodyAuthors" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Sub Category</a>
										</h4>
									</div>
									<div id="panelBodyAuthors" class="panel-collapse collapse show">
										<div class="panel-body">
											<div class="cl_skill_checkbox">
												<div class="content ui_kit_checkbox style2 text-left" id="res_subcategory">
													@foreach($subcategory as  $item)
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input get_subcategory_course " onclick="fetchSubcategory(this)" id="customCheck{{$item->id}}" value="{{$item->id}}" @if($item->slug == app('request')->input('sub')) checked=""    @endif>


														
														<label class="custom-control-label" for="customCheck11{{$item->id}}">{{$item->name}} </label>
													</div>
													
													@endforeach
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> --}}
					<div class="selected_filter_widget style3 mb30">
					  	<div id="accordion" class="panel-group">
						    <div class="panel">
						      	<div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a href="#panelBodyPrice" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Price</a>
							        </h4>
						      	</div>
							    <div id="panelBodyPrice" class="panel-collapse collapse show">
							        <div class="panel-body">
							        <div class="cl_skill_checkbox">
										<div class="ui_kit_checkbox style2 text-left">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_category_price" id="customCheck!" value="paid">
												<label class="custom-control-label" for="customCheck!">Paid </label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_category_price" id="customCheck001" value="free">
												<label class="custom-control-label" for="customCheck001">Free</label>
											</div>
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
							        	<a href="#panelBodySkills" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Skill level</a>
							        </h4>
						      	</div>
							    <div id="panelBodySkills" class="panel-collapse collapse show">
							        <div class="panel-body">
										<div class="ui_kit_checkbox">
											@foreach($level as $key =>$l)
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input get_category_level" id="customCheck000{{$key}}" value="{{$l->level}}">
												<label class="custom-control-label" for="customCheck000{{$key}}">{{$l->level}}{{--  <span class="float-right">{{$l->total}}</span> --}}</label>
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
										<a href="#panelBodySkills" class="accordion-toggle link fz20 mb15" data-toggle="collapse" data-parent="#accordion">Language</a>
									</h4>
								</div>
									<div id="panelBodySkills" class="panel-collapse collapse show">
									<div class="panel-body">
										<div class="ui_kit_checkbox">
											
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck82" value="English">
												<label class="custom-control-label" for="customCheck82">English{{-- <span class="float-right">(15)</span> --}}</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck83" value="Hindi">
												<label class="custom-control-label" for="customCheck83">Hindi {{-- <span class="float-right">(126)</span> --}}</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck84" value="Mandarin Chinese">
												<label class="custom-control-label" for="customCheck84">Mandarin Chinese {{-- <span class="float-right">(1,584)</span> --}}</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck85" value="Tamil">
												<label class="custom-control-label" for="customCheck85">Tamil {{-- <span class="float-right">(34)</span> --}}</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck86" value="French">
												<label class="custom-control-label" for="customCheck86">French{{-- <span class="float-right">(58)</span> --}}</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck87" value="Japanese">
												<label class="custom-control-label" for="customCheck87">Japanese{{-- <span class="float-right">(58)</span> --}}</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck88" value="Korean">
												<label class="custom-control-label" for="customCheck88">Korean{{-- <span class="float-right">(58)</span> --}}</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck90" value="Korean">
												<label class="custom-control-label" for="customCheck90">Thai{{-- <span class="float-right">(58)</span> --}}</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="assign_rating" class="custom-control-input get_language" id="customCheck89" value="Malay">
												<label class="custom-control-label" for="customCheck89">Malay{{-- <span class="float-right">(58)</span> --}}</label>
											</div>
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
				<div class="col-md-12 col-lg-8 col-xl-9 shadow_box" id="res_category_courses">
					  @if(Session::has('success'))
						                            <div class="alert alert-success">
						                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						                                                <strong>{{ Session::get('success') }}</strong>
						                            </div>
                						    @endif
					<div class="row courses_list_heading">
						<div class="col-xl-4 p0">
							<div class="instructor_search_result style2">
								<p class="mt10 fz15"><span class="color-dark pr10"> </span>  <span class="color-dark pr10"></span>All Classes</p>
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
										    	<input class="form-control mr-sm-2" type="search" placeholder="Search all classes" aria-label="Search"  name="q" value="{{ app('request')->input('q') }}">
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

						@foreach( $data->take(15) as $course )
								@php
								$time2 = date('H:i',  strtotime($course->time) + $course->duration*3600);
													
								$date=date_create($course->date);
								$date =date_format($date,"Y-m-d");
								$dat = new DateTime($date.' '.$time2);

								$t = teacherDetail($course->user_id);
													
								if(session('timezone'))
								{

									$timezone = timezone($course);
														
									$c_date = $timezone->date;	
									$c_time = $timezone->time;
								}
													
									  @endphp
							@if(new DateTime('now') <= $dat )
							 <div class="col-lg-12 p0">
										<a href="{{url('class/'.$course->slug)}}">
							<div class="courses_list_content ">
								<div class="top_courses list">
									<div class="thumb">
										{{-- @auth
															@if(!$my_course)
															<a class="whishlist-link" href="#!" id="addToCart" data-id="{{$course->id}}"></a>
															@endif
														@else
															<a class="whishlist-link" href="#!" data-toggle="modal" data-target="#exampleModalCenter"></a>
														@endauth --}}
										{{-- <a href="{{url('class/'.$course->slug)}}" class="img-container"> --}}
															<img class="img-whp" src="{{asset('storage/course/'.$course->image)}}"  style="width: 320px !important" alt="t1.jpg">
														{{-- </a> --}}
										<div class="overlay">
											
											{{-- <span class="tc_preview_course" >Preview Course</span> --}}
										</div>
									</div>
								
									<div class="details">
										<div class="tc_content">
											<p>{{$t->user->name}}
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
												<div class="tc_price float-right fn-414">
												<h5><span class="class-live">
													<i class="fa fa-circle" ></i>  {{$course->type}}
												</span></h5>
												
											</div>
											<h5>{{$course->title}} {{-- <span class="tag">Best Seller</span> --}}</h5>
											@if($course->category) <p>{{$course->category->name}}</p> @endif
											<p>{!! substr($course->desciption,0,150) !!}</p>
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
																			{{studentEnrolled($course->id)}}
																		{{-- </a> --}}
																	</li>
																	<li class="list-inline-item">
																		<i class="flaticon-clock"></i> 
																		{{-- <a href="#"> --}}
																			{{$c_time}}
																		{{-- </a>  --}}
																	</li>
																		
																	<li class="list-inline-item"><i class="flaticon-calendar-1">	</i>
																		{{-- <a href="#"> --}}
																			{{$c_date}}
																		{{-- </a> --}}
																	</li>
																
															</ul>
												<div class="tc_price float-right fn-414">
															{!! userPriceText($course->id) !!}
											
															</div>
									
										</div>
									</div>
								</div>
							</div>
								</a>

							</div>
							@endif
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
						@foreach( $all_courses->take(7) as $course )
									@php
									$time2 = date('H:i',  strtotime($course->time) + $course->duration*3600);
													
								$date1=date_create($course->date);
								$date1 =date_format($date1,"Y-m-d");
								$dat1 = new DateTime($date1.' '.$time2);
										$t = teacherDetail($course->user_id);
													
													if(session('timezone'))
													{

															$timezone = timezone($course);
														
																$c_date = $timezone->date;	
																$c_time = $timezone->time;
																
															
														}
													
									  @endphp
						 @if(new DateTime('now') <= $dat1 )
							<div class="col-lg-12 p0">
								<div class="courses_list_content">
										<a href="{{url('class/'.$course->slug)}}">
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
																<img class="img-whp" src="{{asset('storage/course/'.$course->image)}}"  style="width: 320px !important" alt="t1.jpg">
															{{-- </a> --}}
											<div class="overlay">
												
												{{-- <span class="tc_preview_course" >Preview Course</span> --}}
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
													<div class="tc_price float-right fn-414">
													<h5><span class="class-live">
														<i class="fa fa-circle" ></i>  {{$course->type}}
													</span></h5>
													
												</div>
												<h5>{{$course->title}} {{-- <span class="tag">Best Seller</span> --}}</h5>
												@if($course->category) <p>{{$course->category->name}}</p> @endif
												<p>{!! substr($course->desciption,0,150) !!}</p>
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
																				{{studentEnrolled($course->id)}}
																			{{-- </a> --}}
																		</li>
																		<li class="list-inline-item">
																			<i class="flaticon-clock"></i> 
																			{{-- <a href="#"> --}}
																				{{$c_time}}
																			{{-- </a>  --}}
																		</li>
																			
																		<li class="list-inline-item"><i class="flaticon-calendar-1">	</i>
																			{{-- <a href="#"> --}}
																				{{$c_date}}
																			{{-- </a> --}}
																		</li>
																	
																</ul>
													<div class="tc_price float-right fn-414">
														{!! userPriceText($course->id) !!}
												
													</div>
										
											</div>
										</div>
									</div>
								</div>
							</a>
							</div>
						@endif
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
<script type="text/javascript">
let filterDate = "";
$(function() {
    $('#datepicker').datepicker( {
       inline:true, minDate:0,dateFormat:'yy-mm-dd',
        onSelect: function(date) {
           filterDate = date
       		 filter();
        },
     
    });
});



let q ='{{ app('request')->input('q') }}';

	function fetchType(e) {
		let  type= $(e).val();
		

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

                     
					   let price = $('.get_category_price:checked').val();
                         $.ajax({

                    type  : 'post',
                    url   : '/get-category-course',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    data  : {cat_id :category,chk:1,level:level,price:price,type:type,q:q,date:filterDate},
                    success:function(res){
                        if(res.success){
                            $('#res_category_courses').html(res.course);
                            if(res.sub){

                            $('#res_subcategory').html(res.sub);
                            }
                 // $('.loader').hide();
                        }
                    }
                });

	}
		function fetchSubcategory(e) {
    	

    		   let subcat_id = $(e).val();

            let price = $('.get_category_price:checked').val();
           
 			let type = $('#get_type').val();


                  $('input.get_category_all').not(this).prop('checked', false);
            let subcategory = []
					$(".get_subcategory_course:checked").each(function ()
					{
					    subcategory.push(parseInt($(this).val()));
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
       
            let chk = $(this).prop("checked");
         $('.loader').show();
         
                $.ajax({
                    type  : 'post',
                    url   : '/get-category-course',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                      data  : {subcat_id :subcategory,chk:1,level:level,type:type,q:q,date:filterDate},
                    success:function(res){
                        if(res.success){
                            $('#res_category_courses').html(res.course);
                             if(res.sub){
                            	
                            $('#res_subcategory').html(res.sub);
                            }
                 // $('.loader').hide();
                        }
                    }
                });
    	}
</script>

<script >
    $(document).ready(function(){


    
    // Hover states on the static widgets
	
		// iNLINE dATEPICKER FOR fILTER sECTION eND

     // $( "#datepicker" ).datepicker();
    	   let total_category = [];
    	   let total_level = [];

    	            //Get All Products By Category Wise
        $('.get_category_course').on('click',function(){
            let cat_id = $(this).val();

            let price = $('.get_category_price:checked').val();


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

			 let level = [];
					$(".get_category_level:checked").each(function ()
					{
					    level.push($(this).val());
					});

			 let type = $('#get_type').val();

       
            let chk = $(this).prop("checked");
         $('.loader').show();
         
                $.ajax({
                    type  : 'post',
                    url   : '/get-category-course',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                      data  : {cat_id :category,chk:1,level:level,language:language,price:price,sub:1,type:type,q:q,date:filterDate},
                    success:function(res){
                        if(res.success){
                            $('#res_category_courses').html(res.course);
                             if(res.sub){
                            	
                            $('#res_subcategory').html(res.sub);
                            }
                 // $('.loader').hide();
                        }
                    }
                });
        
           
        });

          	

          $('.get_category_price').on('click',function(){
          	   let chk = $(this).prop("checked");
          	   if(chk){

         		   var price = $(this).val();
          	   }
               console.log(price);
            let category = [];
					$(".get_category_course:checked").each(function ()
					{
					    category.push(parseInt($(this).val()));
					});
			 let language = [];
					$(".get_language:checked").each(function ()
					{
					    language.push($(this).val());
					});
			 let level = [];
					$(".get_category_level:checked").each(function ()
					{
					    level.push($(this).val());
					});

					   let subcategory = []
					$(".get_subcategory_course:checked").each(function ()
					{
					    subcategory.push(parseInt($(this).val()));
					});

					if(subcategory.length > 0){
						category = subcategory;
					}

      
 			let type = $('#get_type').val();
         
         $('.loader').show();
           $('input.get_category_price').not(this).prop('checked', false);
                $.ajax({
                    type  : 'post',
                    url   : '/get-category-course',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    data  : {cat_id :category,chk:chk,level:level,language:language,price:price,type:type,q:q,date:filterDate},
                    success:function(res){
                        if(res.success){
                            $('#res_category_courses').html(res.course);
                            if(res.sub){
                            	
                            $('#res_subcategory').html(res.sub);
                            }
                 // $('.loader').hide();
                        }
                    }
                });
        
           
        });

$('.get_category_level').on('click',function(){

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
                    url   : '/get-category-course',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    data  : {cat_id :category,chk:1,level:level,language:language,price:price,type:type,q:q ,date:filterDate},
                    success:function(res){
                        if(res.success){
                            $('#res_category_courses').html(res.course);
                            if(res.sub){

                            $('#res_subcategory').html(res.sub);
                            }
                 // $('.loader').hide();
                        }
                    }
                });
        
           
 });

 

$('.get_language').on('click',function(){

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
                    url   : '/get-category-course',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    data  : {cat_id :category,chk:1,level:level,language:language,price:price,type:type,q:q, date:filterDate},
                    success:function(res){
                        if(res.success){
                            $('#res_category_courses').html(res.course);
                            if(res.sub){

                            $('#res_subcategory').html(res.sub);
                            }
                 // $('.loader').hide();
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
                    url   : '/get-category-course',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    data  : {cat_id :category,chk:1,level:level,language:language,price:price,type:type,q:q, date:filterDate},
                    success:function(res){
                        if(res.success){
                            $('#res_category_courses').html(res.course);
                            if(res.sub){

                            $('#res_subcategory').html(res.sub);
                            }
                 // $('.loader').hide();
                        }
                    }
                });
        

}

   </script>
@endsection