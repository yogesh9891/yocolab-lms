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

                        <div class="my_course_content_container">
                            <div class="my_course_content mb30 pt-0">
                                <div class="my_course_content_header py-2">
                                    <div class="col-xl-4">
                                        <div class="instructor_search_result style2">
                                            <h4 class="mt10">My Upcoming Classes</h4>
                                        </div>
                                    </div>
                                {{--     <div class="col-xl-8">
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
                                @if(count($stu_courses) > 0)
                                <div class="my_course_content_list custom_my_course_content_list">
                                @foreach($stu_courses->sortBy('date') as $c)
                                <div class="custom_my_course_content_list_inner">

                                @if($c->course)
                                 @php 
                                       $t = teacherDetail($c->course->user_id);
                                                   
                                        $time2 = date('H:i',  strtotime($c->course->time) + $c->course->duration*3600);
                                                    
                                                            $date=date_create($c->course->date);
                                                            $date =date_format($date,"Y-m-d");
                                                            $dat = new DateTime($date.' '.$time2);

                                                    if(session('timezone'))
                                                    {

                                                            $timezone = timezone($c->course);
                                                        
                                                                $c_date1 = $timezone->date;  
                                                                $c_time1 = $timezone->time;
                                                                
                                                            
                                                        }
                                                    

                                  
                                       
                      
                                         $date=date_create($c->date);
                                         $cancel = 0 ; 
                                    @endphp
                                      @if(new DateTime('now') <= $dat )
                         
                                              
                                             <a class="mcc_view" href="{{url('/class/'.$c->course->slug)}}">
                                                <div class="mc_content_list">
                                                    <div class="thumb">
                                                        <div class="tag-holder">
                                                            @if($c->course->status ==0)
                                                                <div class="tag tag-completed">Teacher Cancelled</div>
                                                                @php $cancel = 1 ; @endphp
                                                            @else
                                                            @if($c->status =='done')
                                                                <div class="tag tag-upcoming">Upcoming</div>
                                                            @else
                                                                @php $cancel = 1 ; @endphp
                                                                <div class="tag tag-completed">Cancelled</div>
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
                                                            <p class="subtitle"><sapn>{{$c->teacher->name}}</span></p>
                                                            <h5 class="title">{{$c->course->title}}</h5>
                                                            <p>{!! substr($c->course->desciption,0, 100) !!}...</p>
                                                        </div>
                                                        <div class="mc_footer">
                                                            <div class="lft-section">
                                                                <ul class="mc_meta fn-414">
                                                                    <li class="list-inline-item"><span><i class="flaticon-profile"></i></span></li>
                                                                    <li class="list-inline-item"><span>{{studentEnrolled($c->course->id)}}</span></li>
                                                                </ul>
                                                            
                                                                <ul class="mc_cource_start_dt fn-414 mr-3">
                                                                    <li class="list-inline-item"><i class="flaticon-clock"></i></li>
                                                                    <li class="list-inline-item fn-414">{{$c_time1}}</li>
                                                                </ul>
                                                                <ul class="mc_cource_start_dt fn-414">
                                                                    <li class="list-inline-item"><i class="flaticon-calendar-1"></i></li>
                                                                    <li class="list-inline-item fn-414">{{$c_date1}}</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rght-section">
                                                                <ul class="mc_review fn-414">
                                                                    <li class="list-inline-item tc_price fn-414">
                                                                        <span>{!! userPriceText($c->course->id) !!}</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                                            <div class="modal cancel-class-modal" id="cancle_calss-{{$c->course->id}}" tabindex="-1" role="dialog" aria-hidden="true" >
                                                                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                                    <form action="{{url('user/cancel-course')}}" method="post"> 
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">cancel Course</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id" value="{{$c->course->id}}">
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
                                            @if($cancel==0)
                                                @if($c->course->price_type=='free')
                                                    <form action="{{url('user/cancel-course')}}" method="post" class="d-inline"> @csrf @method('post')
                                                        <input type="hidden" name="id" value="{{$c->course->id}}">
                                                        <button type ="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" data-toggle="tooltip"   onclick="return confirm('Are you sure to cancel this course?');">Cancel</button>
                                                    </form>
                                                @else
                                                    <a href="#!" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" data-toggle="modal" data-target="#cancle_calss-{{$c->course->id}}">Cancel</a>
                                                @endif
                                            @endif
                                
                                     
                                   
                                  
                                    @endif
                                    @endif
                                </div>
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
    
@endsection