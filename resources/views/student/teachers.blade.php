@extends('layouts.app')
@section('title','Yocolab')
@section('content')

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
                                            <h4 class="mt10">Followed Instructors</h4>
                                        </div>
                                    </div>
                                  {{--   <div class="col-xl-8">
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

                                <div class="my_course_content_list">
                        
                                  @if(count($teachers) > 0)
                                    <div class="my_setting_content_details">
                                        <div class="cart_page_form style2 in-st">
                                            <form action="#">

                                                <div class="table-responsive custom-table-responsive text-left">
                                                <table class="table custom-table img-table">
                                                <thead>
                                                <tr>
                                                
                                                    
                                                    <th scope="col">Teacher Image</th>
                                               
                                                                                                    
                                                    <th scope="col">
                                                        
                                                           Teacher name

                                                        

                                                    </th>
                                                    <th scope="col">Info</th>
                                                    <th scope="col">Course</th>
                                                    <th scope="col">Action</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($teachers as $teacher)
                                                    @php 
                                                    
                                                       $t = teacherDetail($teacher->teacher_id);
                                                      @endphp  

                                                    @if($t)
                                                        <tr>
                                                            <td>
                                                                <a href="{{url('profile/'.$t->user->name.'/'.$t->teacher_id)}}"><img src="{{asset('storage/teacher/'.$t->image)}}" alt="cart1.png" width="100px"></a>
                                                            </td>
                                                            <td>
                                                                <a class="cart_title" href="{{url('profile/'.$t->user->name.'/'.$t->teacher_id)}}">{{$t->user->name}}</a>
                                                            </td>
                                                            <td>
                                                                {{$t->language}} <br>{{$t->country}}
                                                            </td>
                                                            @php 

                                                               
                                                            $course =\App\Models\Course::where('user_id',$teacher->teacher_id)->count(); @endphp
                                                            <td>{{$course}}</td>
                                                            <td> <a class="btn btn-danger btn-sm" href="{{url('user/follow-teacher/unfollow/'.str_slug($t->user->name).'/'.$t->teacher_id)}}"  > unfollow</a>
                                                            </td>
                                                            
                                                       </tr>
                                                       
                                                       @endif
                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                
                                                
                                                   @endforeach
                                                
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                                <!-- <table class="table table-responsive">
                                                    <thead>
                                                        <tr class="carttable_row">
                                                            <th class="cartm_title">Teacher Image</th>
                                                            <th class="cartm_title">Teacher name</th>
                                                            <th class="cartm_title">Info</th>
                                                            <th class="cartm_title">Course</th>
                                                             <th class="cartm_title">Action</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table_body">
                                                        @foreach($teachers as $t)
                                                        <tr>
                                                            <td>
                                                                <a href="{{url('profile/'.$t->teacher->id)}}"><img src="{{asset('storage/teacher/'.$t->teacher_details->image)}}" alt="cart1.png" width="100px"></a>
                                                                  
                                                            </td>
                                                            <td><a class="cart_title" href="{{url('profile/'.$t->teacher->id)}}">{{$t->teacher->name}}</a></td>
                                                            <td>{{$t->teacher_details->language}} <br>{{$t->teacher_details->country}}</td>
                                                            @php 

                                                                $tid = $t->teacher_id;
                                                            $course =\App\Models\Course::where('user_id',$tid)->count(); @endphp
                                                            <td>{{$course}}</td>
                                                            <td><a class="btn btn-danger btn-sm" href="{{url('user/follow-teacher/unfollow/'.$t->teacher_id)}}"  > unfollow</a></td>
                                                            {{-- <td class="cart_total">$259.00</td> --}}
                                                            {{-- <td class="text-thm tdu">Receipt</td> --}}
                                                        </tr>
                                                        @endforeach
                                                       
                                                    </tbody>
                                                </table>
 -->                                            </form>
                                        </div>
                                    </div>
                                    @else
                                 <h2 class="no-classes ">You Are Not Following Any Instructor</h2>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>

@endsection