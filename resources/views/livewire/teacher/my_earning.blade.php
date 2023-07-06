   <div class="row">
                   <div class="col-lg-12">
                        <div class="my_course_content_container">
                            <div class="my_course_content mb30 pt-0">
                                <div class="my_course_content_header py-2">
                                    <div class="col-md-4">
                                        <div class="instructor_search_result style2">
                                            <h4 class="mt10">My Earnings</h4>
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="my_course_content_list">
                                  
                           
                                  @if(count($data['courses']) > 0)
                                    <div class="my_setting_content_details">
                                        <div class="cart_page_form style2 in-st mb-0">
                                            <form action="#">
                                                <div class="table-responsive custom-table-responsive text-left">
                                                <table class="table custom-table" id="myTable">
                                                <thead>
                                                <tr>
                                                
                                                    
                                                    <th scope="col">Name</th>
                                               
                                                                                                    
                                                    <th scope="col">
                                                        
                                                            Date & Time

                                                        

                                                    </th>
                                                    <th scope="col">Currency</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Student Enrolled</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Earning</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data['courses'] as $val)
                                                        @php $course = App\Models\Course::find($val->course_id);
                                                        $earning = 0;
                                                      
                                                        $timezone = timezone($course);
                                                        $c_date = $timezone->date;
                                                        $c_time = $timezone->time;
                                                        
                                                    
                                                       
                                                        @endphp 
                                                  
                                                        <tr>
                                                            <td>
                                                                {{$val->title}} </td>
                                                              
                                                           <td>
                                                              
                                                                <p>{{$c_date}}</p>
                                                                <p class="time-display">{{$c_time}} </p>
                                                             
                                                            </td>
                                                            <td>{{$val->currency}}</td>
                                                            <td>
                                                                  {{$val->price}}
                                                            </td>
                                                            <td>{{$val->students}}</td>
                                                             
                                                             <td> @if($val->status=='complete')

                                                                    <span class="badge badge-primary">Complete</span>
                                                                    @else
                                                                    
                                                                    <span class="badge badge-danger">{{$val->status}}</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{$val->total}}</td>
                                                            
                                                       </tr>
                                                       

                                                    {{-- <tr class="spacer"><td colspan="100"></td></tr> --}}
                                                
                                                
                                                   @endforeach
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                                 <button type="button" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-borde" wire:click="load({{$view}})"> Load more</button>
                                            
                                            </form>
                                        </div>
                                    </div>
                                    @else
                               <h2 class="no-classes ">No Earning Available</h2>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>