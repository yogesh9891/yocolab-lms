  <div class="row">
                   <div class="col-lg-12">
                      @if(Session::has('success'))
                                                        <div class="alert alert-success">
                                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                                            <div class="icon hidden-xs">
                                                              <i class="fa fa-check"></i>
                                                            </div>
                                                            <strong>Success</strong>
                                                            <Br /> {{Session::get('success')}}
                                                          </div>
                                            @endif
                        <div class="my_course_content_container">
                            <div class="my_course_content mb30 pt-0">
                                <div class="my_course_content_header py-2">
                                    <div class="col-xl-4">
                                        <div class="instructor_search_result style2">
                                            <h4 class="mt10">My Wishlist</h4>
                                        </div>
                                    </div>
                      
                                </div>
                                
                                <div class="my_course_content_list">
                              @if(count($data['stu_courses'])>0)
                                @foreach($data['stu_courses'] as $c)

                                @if($c)
                                    @php 
                                        $tu =   \App\Models\User::where(['id' => $c->course->user_id])->first(); 
                                        $rating =0;
                                        $rating = App\Models\Feedback::where('teacher_id',$c->course->user_id)->avg('star');
                                        $rating = round($rating);
                                              
                                                $timezone = timezone($c->course);
                                                    $c_date1 = $timezone->date; 
                                                    $c_time1 = $timezone->time;
                                                   
                                           
                                        $my_course1 ='';
                                          $stu_enroll = \App\Models\StudentCourse::where('course_id',$c->id)->where('status','done')->count();

                                          if(Auth::user()){

                                          $my_course1 = \App\Models\StudentCourse::where('course_id',$c->id)->where('user_id',Auth::user()->id)->where('status','done')->first();
                                        }
                                      
                                    @endphp

                                    
                                   
                                    <div class="mc_content_list">
                                        <div class="thumb">
                                            {{-- <div class="tag-holder">
                                                <div class="tag tag-upcoming">Upcoming</div>
                                            </div> --}}
                                            <img class="img-whp" src="{{asset('storage/course/'.$c->course->image)}}" alt="t1.jpg" >
                                            <div class="overlay">
                                                <ul class="mb0">
                                                   {{--  <li class="list-inline-item">
                                                        <a class="mcc_edit" href="#">Edit</a>
                                                    </li> --}}
                                                    <li class="list-inline-item">
                                                        <a class="mcc_view" href="{{url('/course/'.$c->course_id)}}">View</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="mc_content">
                                                <p class="subtitle"><a href="{{url('profile/'.$tu->id)}}">{{$tu->name}}</a></p>
                                                <h5 class="title"><a href="{{url('/course/'.$c->course_id)}}">{{$c->course->title}}</a></h5>
                                                <p>{{substr($c->course->desciption,0, 100)}}...</p>
                                            </div>
                                            <div class="mc_footer">
                                                <div class="lft-section">
                                                    <ul class="mc_meta fn-414">
                                                        <li class="list-inline-item"><a href="#"><i class="flaticon-profile"></i></a></li>
                                                        <li class="list-inline-item"><a href="#">{{$stu_enroll}}</a></li>
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
                                                        <li class="list-inline-item tc_price fn-414"><a href="#">
                                                           @php $curr = currency_convert($c);   @endphp
                                                          
                                                            {!! $curr->html !!}
                                                           
                                                                </a></li>
                                                    </ul>
                                                </div>
                                                <form action="{{url('/remove_cart_item')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$c->course_id}}">
                                                    <button type="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Remove</button>
                                              </form>
                                               
                                                </div>
                                            </div>
                                        </div>
                                    
                                    @endif
                                    @endforeach
                                    @else
                                    <h2 class="no-classes ">No Bookmarks Classes</h2>
                                    @endif
                             
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>