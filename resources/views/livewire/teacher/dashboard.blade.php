<div class="row">
                    <!-- <div class="col-12">
                        <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                            <h4 class="title float-left">Dashboard</h4>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div> -->
                    {{-- Dash Board Widgets Start --}}

                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                        <div class="ff_one">
                            <div class="icon"><span class="flaticon-speech-bubble"></span></div>
                            <div class="detais">
                                <p> Students </p>
                                <div class="timer">{{$data['students'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                        <div class="ff_one style2">
                            <div class="icon"><span class="flaticon-rating"></span></div>
                            <div class="detais">
                                <p>Reviews</p>
                                <div class="timer">
                                    @php 
                                   
                                     echo    $rating = App\Models\Feedback::where('teacher_id',Auth::user()->id)->count();
                                     
                                     @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                        <div class="ff_one style3">
                            <div class="icon"><span class="flaticon-online-learning"></span></div>
                            <div class="detais">
                                <p>Classes</p>
                                <div class="timer">{{$data['students'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                        <div class="ff_one style4">
                            <div class="icon"><span class="flaticon-like"></span></div>
                            <div class="detais">
                                <p>Materials</p>
                                <div class="timer">{{$data['students'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="application_statics">
                            <h4>Upcoming Classes</h4>
                            <div class="c_container">
                                @if(count($data['recent_courses'] ) > 0 )
                                <table class="table table-responsive">
                                    <tbody class="table_body">
                                        @foreach($data['recent_courses']  as $c)
                                        @php 
                                            $timezone = timezone($c);
                                            $c_date = $timezone->date;
                                            $c_time = $timezone->time;
                                            
                                      
                                        $curr = currency_convert($c);
                                        @endphp
                                        <tr>
                                            <th scope="row">
                                                <img src="{{asset('storage/course/'.$c->image)}}" alt="cart1.png" class="table-course-image">
                                                            </th>
                                                            <td>{{$c->title}} <br><font color="#fd6100">{{$c_date}} <br>{{$c_time}} </font></td>
                                                            
                                                            <td class="cart_total">{!! $curr->html !!}</td>
                                                            <td class="text-thm tdu"> <a class="mcc_view" href="{{url('/course/'.$c->id)}}">View</a></td>
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                </table>
                                <a href="{{url('/teacher/my-courses')}}" class="btn btn-sm btn-warning">View More</a>
                                 @else
                                <h2 class="no-classes ">No Classes Available</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="recent_job_activity">
                            <h4 class="title">Notifications</h4>

                            @foreach (Auth::user()->Notifications as $n)
                                <div class="grid">
                                    <ul>
                                        <li><div class="title"><a href="{{$n->data['actionURL']}}/{{$n->id}}">{!!$n->data['title'] !!}</a></div></li>
                                        <li><p>{{$n->data['message'] }}</p></li>
                                        <li><small style="color: #007bff">{{$n->created_at->diffForHumans()}}</small></li>
                                    </ul>
                                </div>
                                @endforeach
                         
                        </div>
                    </div>
                    {{-- Dashb Board Widget End --}}

                    {{-- Course Repeater Start --}}

                    
                    {{-- Course Repeater End --}}

                   
                </div>

    