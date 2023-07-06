@extends('layouts.app')
@section('title','Yocolab')
@section('content')

<!-- Our Dashbord Sidebar -->
<div class="custom-dashboard-wrapper">
					@include('student.nav')


	 <div class="content-wrapper">
            <div class="content">
                <div class="row">
                   <div class="col-lg-12">
                   	     @if(Session::has('flash_message'))
                                                <div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <strong>{{ Session::get('flash_message') }}</strong>
                                                </div>
                                               @endif
                        <div class="my_course_content_container">
                            <div class="my_course_content mb30 pt-0">
                                <div class="my_course_content_header py-2">
                                    <div class="col-xl-4">
                                        <div class="instructor_search_result style2">
                                            <h4 class="mt10">Order History</h4>
                                        </div>
                                    </div>
                                   {{--  <div class="col-xl-8">
                                        <div class="candidate_revew_select style2 text-right">
                                            <ul class="mb0">
                                                <li class="list-inline-item">
                                                    <select class="selectpicker show-tick">
                                                        <option>Newly published</option>
                                                        <option>Recent</option>
                                                        <option>Old Review</option>
                                                    </select>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="candidate_revew_search_box course fn-520">
                                                        <form class="form-inline my-2 my-lg-0">
                                                            <input class="form-control mr-sm-2" type="search" placeholder="Search our instructors" aria-label="Search">
                                                            <button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </div>
                                @if(count($stu_courses) > 0 )
                                <div class="my_course_content_list custom_my_course_content_list">
                                @foreach($stu_courses as $c)
                                    @if($c->course)
                                    @php $cancel = 0 ;   $t = teacherDetail($c->course->user_id);
                                                    
                                                    if(session('timezone'))
                                                    {

                                                            $timezone = timezone($c->course);
                                                        
                                                                $c_date = $timezone->date;  
                                                                $c_time = $timezone->time;
                                                                
                                                            
                                                      }  
                                        
                                            @endphp 
                                    <div class="custom_my_course_content_list_inner">
                                        <a class="mcc_view" href="{{url('/class/'.$c->course->slug)}}">
                                        <div class="mc_content_list">
                                            <div class="thumb">
                                                <div class="tag-holder">
                                                    @if($c->course->status ==0)
                                                    @php $cancel = 1 ; @endphp
                                                    <div class="tag tag-completed">Teacher Cancelled</div>

                                                    @else

                                                        @if($c->course->video_class && $c->course->video_class->status !='end')
                                                         @if($c->course->date >=date('Y-m-d'))
                                                                @if($c->status =='done')
                                                                  <div class="tag tag-upcoming">Upcoming</div>
                                                                @else
                                                                  <div class="tag tag-completed">Cancelled</div>
                                                                @endif
                                                        @else
                                                        @php $cancel = 1 ; @endphp
                                                        <div class="tag tag-cancelled">Completed</div>
                                                        @endif
                                                        @else
                                                            @if($c->status =='done')
                                                                  <div class="tag tag-cancelled">Completed</div>
                                                                @else
                                                                  @php $cancel = 1 ; @endphp
                                                                  <div class="tag tag-completed">Cancelled</div>
                                                                @endif
                                                    @endif
                                                        @endif
                                                </div>
                                                <img class="img-whp" src="{{asset('storage/course/'.$c->course->image)}}" alt="t1.jpg" >
                                                <div class="overlay">
                                                    <ul class="mb0">
                                                        <li class="list-inline-item">
                                                            <span class="mcc_view">View</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <div class="mc_content">
                                                    <p class="subtitle"><span>{{$t->user->name}}</span></p>
                                                    <h5 class="title">{{$c->course->title}}</h5>
                                                    <p>{!! substr($c->course->desciption,0, 100) !!}...</p>
                                                </div>
                                                <div class="mc_footer">
                                                    <div class="lft-section">
                                                        <ul class="mc_meta fn-414">
                                                            <li class="list-inline-item"><i class="flaticon-profile"></i></li>
                                                            <li class="list-inline-item">{{studentEnrolled($c->course->id)}}</li>
                                                            <li class="list-inline-item"><i class="flaticon-clock"></i></li>
                                                            <li class="list-inline-item"> {{$c_time}}</li>
                                                            <li class="list-inline-item"><i class="flaticon-calendar-1"></i></li>
                                                            <li class="list-inline-item">   
                                                             {{$c_date}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rght-section">
                                                        <ul class="mc_review fn-414">
                                                            <li class="list-inline-item tc_price fn-414"><span>
                                                           {!!userPriceText($c->course->id)!!}
                                                            </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                                    <div class="modal cancel-class-modal" id="cancle_calss-{{$c->course->id}}" tabindex="-1" role="dialog" aria-hidden="true" course={{$c->course->id}}>
                                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                            <form action="{{url('user/cancel-course')}}" method="post"> 
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Cancel  Course</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                            <input type="hidden" name="id" value="{{$c->course->id}}"/>
                                                                            <h4>Cancellation before 24 hours of scheduled class:</h4><hr>
                                                                            <font color="red">6% </font> transaction fee will be deducted from the amount due to the cost incurred by the payment gateway for the original transaction, the remaining amount will be <b>refunded.</b><br><br>

                                                                            <h4>Cancellation within 24 hours of scheduled class:</h4><hr>
                                                                            <font color="red">NO Refund </font>will be provided to the student. <br>

                                                                            For more details, please <a href="{{url('/terms-and-conditions')}}" class="text-primary"> refer</a> to the Terms & Conditions
                                                                             
                                                                            
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
                                        @if($cancel==0 && $c->course->type=='Live' && $c->stats=='done')
                                            <a href="#!" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" data-toggle="modal" data-target="#cancle_calss-{{$c->course->id}}">Cancel</a>
                                        @endif
                                    </div>
                                 @endif
                                @endforeach


                                </div>
                                 @else
                            <h2 class="no-classes ">No Classes Available</h2>
                                @endif

                                {{$stu_courses->links()}}
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
		
	<!-- Our Dashbord -->
{{-- 
									<div class="my_course_content_list">
										@foreach($stu_courses as $c)
                                     @if($c->course->type =='Live')
										<div class="mc_content_list">
											<div class="thumb">
												<img  src="{{asset('storage/course/'.$c->course->image)}}" alt="t1.jpg" width="200px">
										<div class="overlay">
													<ul class="mb0">
														<li class="list-inline-item">
															<a class="mcc_edit" href="#">Edit</a>
														</li>
														<li class="list-inline-item">
															<a class="mcc_view" href="#">View</a>
														</li>
													</ul>
												</div> 
											</div>
											<div class="details">
												<div class="mc_content">
													<p class="subtitle"><a href="{{url('profile/'.$c->teacher_id)}}">{{$c->teacher->name}}</a></p>
													<h5 class="title"><a href="{{url('/course/'.$c->course_id)}}">{{$c->course->title}} </a>
                                                    
                                                    <span><small class="tag">Upcoming</small></span>
                                                	</h5>
													<p>{{substr($c->course->desciption,0, 100)}}...</p>
												</div>
												<div class="mc_footer">
													<ul class="mc_meta fn-414">
														<li class="list-inline-item"><a href="#"><i class="flaticon-profile"></i></a></li>
														<li class="list-inline-item"><a href="#">1548</a></li>
														<li class="list-inline-item"><a href="#"><i class="flaticon-comment"></i></a></li>
														<li class="list-inline-item"><a href="#">25</a></li>
													</ul>
													<ul class="mc_review fn-414">
							


 														@php $date=date_create($c->course->date);   @endphp
 														<li class="list-inline-item"><a href="#">{{date_format($date,"d,M Y")}}</a></li>
														<li class="list-inline-item tc_price fn-414"><a href="#">
															@if($c->course->price)
															{{$c->course->price -(($c->course->price*$c->course->discount)/100)}} <del>${{$c->course->price}}</del>
																@else
																Free
																@endif

															</a></li>
													</ul>
												</div>
											</div>
										</div>
                                    	@endif
										@endforeach
									
									</div>
								</div> --}}
	
@endsection