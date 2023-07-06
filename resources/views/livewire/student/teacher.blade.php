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
                                 
                                </div>

                                <div class="my_course_content_list">
                        
                                  @if(count($data['teachers']) > 0)
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
                                                    @foreach($data['teachers'] as $t) 
                                                  
                                                        <tr>
                                                            <td>
                                                                <a href="{{url('profile/'.$t->teacher->id)}}"><img src="{{asset('storage/teacher/'.$t->teacher_details->image)}}" alt="cart1.png" width="100px"></a>
                                                            </td>
                                                            <td>
                                                                <a class="cart_title" href="{{url('profile/'.$t->teacher->id)}}">{{$t->teacher->name}}</a>
                                                            </td>
                                                            <td>
                                                                {{$t->teacher_details->language}} <br>{{$t->teacher_details->country}}
                                                            </td>
                                                            @php 

                                                                $tid = $t->teacher_id;
                                                            $course =\App\Models\Course::where('user_id',$tid)->count(); @endphp
                                                            <td>{{$course}}</td>
                                                            <td> <a class="btn btn-danger btn-sm" href="{{url('user/follow-teacher/unfollow/'.$t->teacher_id)}}"  > unfollow</a>
                                                            </td>
                                                            
                                                       </tr>
                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                
                                                
                                                   @endforeach
                                                
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                                          </form>
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