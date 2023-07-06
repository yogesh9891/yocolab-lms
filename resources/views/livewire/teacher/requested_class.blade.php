
                <div class="row">
                   <div class="col-lg-12">
                        <div class="my_course_content_container">
                            <div class="my_course_content mb30 pt-0">
                                <div class="my_course_content_header py-2">
                                    <div class="col-md-4">
                                        <div class="instructor_search_result style2">
                                            <h4 class="mt10">Requested Class</h4>
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="my_course_content_list">
                                  
                           
                                  @if(count($data['request_class']) > 0) 
                                    <div class="my_setting_content_details">
                                        <div class="cart_page_form style2 in-st">
                                            <form action="#">

                                                <div class="table-responsive custom-table-responsive text-left">
                                                <table class="table custom-table">
                                                <thead>
                                                <tr>
                                                
                                                    
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Prefer</th>
                                               
                                                                                                    
                                                    <th scope="col"></th>
                                                    <th scope="col">Request</th>
                                                    <th scope="col">Action</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                 @foreach($data['request_class'] as $f)
                                                
                                                        <tr>
                                                          
                                                            <td>{{$f->name}}</td>
                                                            <td>{{$f->date}}</td>
                                                            <td>{{$f->time}}</td>
                                                            <td>{{$f->description}}</td>
                                                            <td><a href="{{url('/teacher/create-course')}}" class="btn btn-primary-custom btn-primary-custom-round">Create Class</a></td>
                                                            
                                                       </tr>
                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                @endforeach
                                                   
                                                
                                                
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                           
                                                <button class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-borde" wire:click="load({{$view}})"> Load more</button>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                               <h2 class="no-classes ">No Request Available</h2>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>

