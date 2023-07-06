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
                                            <h4 class="mt10"> All Classes</h4>
                                        </div>
                                    </div>
                                  
                                </div>

                                <div class="my_course_content_list custom_my_course_content_list">
                                @if(count($data['courses'] ) > 0 )
                                    @foreach($data['courses'] as $c)
                                    <div class="custom_my_course_content_list_inner">
                                        @php 
                                        if(session('timezone'))
                                            $timezone = timezone($c);
                                            $c_date = $timezone->date;
                                            $c_time = $timezone->time; $curr = currency_convert($c);  @endphp
                                        <a class="mcc_view" href="{{url('/class/'.$c->slug)}}">
                                            <div class="mc_content_list">
                                                <div class="thumb">
                                                    <div class="tag-holder">
                                                        @if($c->status ==1)
                                                            @if( $c->video_class && $c->video_class->status !='end')
                                                                @if($c->date >=date('Y-m-d'))
                                                                    <div class="tag tag-upcoming">Scheduled</div>
                                                                @else
                                                                    @php  $c->status = 0;   @endphp
                                                                    <div class="tag tag-cancelled">Completed</div>
                                                                @endif
                                                            @else
                                                                @php  $c->status = 0;   @endphp
                                                                <div class="tag tag-cancelled">Completed</div>
                                                            @endif
                                                        @else
                                                            <div class="tag tag-completed">Cancelled</div>
                                                        @endif
                                                    </div>
                                                    <img class="img-whp" src="{{asset('storage/course/'.$c->image)}}" alt="t1.jpg" >
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
                                                        <p class="subtitle"><span>{{$c->user?$c->user->name:''}}</span></p>
                                                        <h5 class="title">{{$c->title}}</h5>
                                                     <p>{!! substr($c->desciption,0,150) !!}</p>
                                                    </div>
                                                    <div class="mc_footer">
                                                        <div class="lft-section">
                                                            <ul class="mc_meta fn-414">
                                                                <li class="list-inline-item"><span>{{studentEnrolled($c->id)}}</span></li>
                                                                <li class="list-inline-item"><span><i class="flaticon-profile"></i></span></li>
                                                            </ul>
                                                            @php $date=date_create($c->date);   @endphp
                                                            <ul class="mc_cource_start_dt fn-414 mr-3">
                                                                <li class="list-inline-item"><i class="flaticon-clock"></i></li>
                                                                <li class="list-inline-item fn-414">{{$c_time}}</li>
                                                            </ul>
                                                            <ul class="mc_cource_start_dt fn-414">
                                                                <li class="list-inline-item"><i class="flaticon-calendar-1"></i></li>
                                                                <li class="list-inline-item fn-414">{{$c_date}}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="rght-section">
                                                            <ul class="mc_review fn-414">
                                                                <li class="list-inline-item tc_price fn-414">
                                                                    <span>{!!$curr->html !!}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        @if($c->status == 1 && $c->type=='Live')
                                        @if($c->price_type =='free')
                                        <form action="{{secure_url('teacher/cancel-course')}}" method="post" class="d-inline"> @csrf @method('post')
                                                                            <input type="hidden" name="id" value="{{$c->id}}">
                                                                            <button type ="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" data-toggle="tooltip"   onclick="return confirm('Are you sure to cancel this course?');">Cancel</button>
                                                                        </form>
                                                                        @else
                                        <a href="#!" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" data-toggle="modal" data-target="#cancle_calss-{{$c->slug}}">Cancel</a> 
                                        @endif
                                        @else
                                          <a href="{{url('/teacher/reschedule-course/'.$c->slug)}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-secure_url-border" >Reschedule</a>

                                        @endif
                                             <div class="modal cancel-class-modal" id="cancle_calss-{{$c->slug}}" tabindex="-1" role="dialog" aria-hidden="true" >
                                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                                <form action="{{secure_url('teacher/cancel-course')}}" method="post"> 
                                                                                @csrf
                                                                        <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                            <h5 class="modal-title">Are you sure you want to cancel the class?</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="id" value="{{$c->id}}">
                                                                             <h4>Cancellation before 24 hours of scheduled class:</h4><hr>
                                                                    <font color="red">10% </font> of the total earnings will be deducted as cancellation penalty. The amount will be deducted from your credit card which is connected to your account. For more information,<a href="{{url('/term-and-conditions')}}" class="text-primary" target="_blank"> refer</a> to the T&C.This is not applicable if there are no enrolled students.<br><br>

                                                                    <h4>Cancellation within 24 hours of scheduled class:</h4><hr>
                                                                    <font color="red">15% </font> of the total earnings will be deducted as cancellation penalty. The amount will be deducted from your credit card which is connected to your account. For more information, <a href="{{url('/term-and-conditions')}}" class="text-primary" target="_blank">refer</a> to the T&C.This is not applicable if there are no enrolled students.
                                                                    For more information, refer to<a href="{{url('/cancellation-policy')}}" class="text-primary" target="_blank"> refund and cancellation policy</a>
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
                                    </div>
                                    @endforeach
                                    <button class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-borde" wire:click="load({{$view}})"> Load more</button>
                                 @else
                                 <h2 class="no-classes ">No Classes Available</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                 </div>
            </div>